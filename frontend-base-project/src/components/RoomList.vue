<template>
    <div>
        <h2>Room Management</h2>
        <router-link to="/rooms/create">Create Room</router-link>
        <table>
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Floor Number</th>
                    <th>Capacity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="room in rooms" :key="room.id">
                    <td>{{ room.room_number }}</td>
                    <td>{{ room.floor_number }}</td>
                    <td>{{ room.capacity }}</td>
                    <td>{{ room.status }}</td>
                    <td>
                        <label>Assign Guest</label>
                        <select
                            v-model="selectedGuests[room.id]"
                            @change="assignRoom(room.id)"
                        >
                            <option value="">Select Guest</option>
                            <option
                                v-for="guest in guests"
                                :key="guest.id"
                                :value="guest.id"
                            >
                                {{ guest.full_name }}
                            </option>
                        </select>
                        <button @click="setRoomReady(room.id)">
                            Set as Ready
                        </button>
                        <button @click="editRoom(room)">Edit</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import RoomService from "../services/RoomService";
import GuestService from "../services/GuestService";

export default defineComponent({
    name: "RoomManagement",
    setup() {
        const rooms = ref([]);
        const guests = ref([]);
        const selectedGuests = ref<{ [key: number]: number | null }>({});
        const router = useRouter();

        const fetchRooms = async () => {
            const fetchedRooms = await RoomService.getAllRooms();
            rooms.value = fetchedRooms;

            fetchedRooms.forEach((room: any) => {
                selectedGuests.value[room.id] = room.guest_id || null;
            });
        };

        const fetchGuests = async () => {
            guests.value = await GuestService.getAllGuests();
        };

        const assignRoom = async (roomId: number) => {
            const guestId = selectedGuests.value[roomId];
            if (guestId) {
                try {
                    await RoomService.assignRoom(roomId, guestId);
                    alert("Guest assigned successfully!");
                } catch (error) {
                    console.error("Error assigning guest:", error);
                    alert("Failed to assign guest.");
                }
            }
        };

        const setRoomReady = async (roomId: number) => {
            await RoomService.setRoomStatus(roomId, "READY");
            fetchRooms();
        };

        const editRoom = (room: any) => {
            console.log("Editing room:", room);
            router.push({ name: 'RoomEdit', params: { id: room.id } });
        };

        onMounted(async () => {
            await fetchRooms();
            await fetchGuests();
        });

        return {
            rooms,
            guests,
            selectedGuests,
            assignRoom,
            setRoomReady,
            editRoom,
        };
    },
});
</script>
