<template>
    <div>
        <h1>Guests</h1>
        <router-link to="/guests/create">Create Guest</router-link>
        <table>
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="guest in guests" :key="guest.id">
                    <td>{{ guest.full_name }}</td>
                    <td>{{ guest.age }}</td>
                    <td>
                        <router-link :to="`/guests/${guest.id}/edit`"
                            >Edit</router-link
                        >
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from "vue";
import GuestService from "../services/GuestService";

export default defineComponent({
    name: "GuestList",
    setup() {
        const guests = ref([]);

        const fetchGuests = async () => {
            guests.value = await GuestService.getAllGuests();
        };

        onMounted(fetchGuests);

        return { guests };
    },
});
</script>
