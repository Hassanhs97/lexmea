<template>
    <form @submit.prevent="handleSubmit">
        <h2>{{ isEdit ? "Edit Room" : "Create Room" }}</h2>
        <div class="form-group">
            <label for="floor_number">Floor Number</label>
            <input
                type="number"
                id="floor_number"
                v-model="room.floor_number"
                required
            />
        </div>
        <div class="form-group">
            <label for="room_number">Room Number</label>
            <input
                type="number"
                id="room_number"
                v-model="room.room_number"
                required
            />
        </div>
        <div class="form-group">
            <label for="capacity">Capacity</label>
            <input
                type="number"
                id="capacity"
                v-model="room.capacity"
                required
            />
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" v-model="room.status" required>
                <option value="READY">Ready</option>
                <option value="TAKEN">Taken</option>
                <option value="MAINTENANCE">Maintenance</option>
            </select>
        </div>
        <button type="submit">
            {{ isEdit ? "Update Room" : "Create Room" }}
        </button>
    </form>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import RoomService from "../services/RoomService";

export default defineComponent({
    name: "RoomForm",
    setup() {
        const room = ref({
            floor_number: 0,
            room_number: 0,
            capacity: 0,
            status: "READY",
        });
        const isEdit = ref(false);
        const route = useRoute();
        const router = useRouter();

        const fetchRoom = async (id: number) => {
            const data = await RoomService.getRoomById(id);
            room.value = data;
        };

        const handleSubmit = async () => {
            if (isEdit.value) {
                await RoomService.updateRoom(room.value.id, room.value);
            } else {
                await RoomService.createRoom(room.value);
            }
            router.push("/rooms"); // Redirect after submission
        };

        onMounted(() => {
            const id = Number(route.params.id);
            if (id) {
                isEdit.value = true;
                fetchRoom(id);
            }
        });

        return { room, isEdit, handleSubmit };
    },
});
</script>
