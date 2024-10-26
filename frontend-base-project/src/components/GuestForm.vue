<template>
    <form @submit.prevent="handleSubmit">
        <h2>{{ isEdit ? "Edit Guest" : "Create Guest" }}</h2>
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input
                type="text"
                id="full_name"
                v-model="guest.full_name"
                required
            />
        </div>
        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" id="age" v-model="guest.age" required />
        </div>
        <button type="submit">
            {{ isEdit ? "Update Guest" : "Create Guest" }}
        </button>
    </form>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import GuestService from "../services/GuestService";

export default defineComponent({
    name: "GuestForm",
    setup() {
        const guest = ref({
            full_name: "",
            age: 0,
        });
        const isEdit = ref(false);
        const route = useRoute();
        const router = useRouter();

        const fetchGuest = async (id: number) => {
            const data = await GuestService.getGuestById(id);
            guest.value = data;
        };

        const handleSubmit = async () => {
            if (isEdit.value) {
                await GuestService.updateGuest(guest.value.id, guest.value);
            } else {
                await GuestService.createGuest(guest.value);
            }
            router.push("/guests");
        };

        onMounted(() => {
            const id = Number(route.params.id);
            if (id) {
                isEdit.value = true;
                fetchGuest(id);
            }
        });

        return { guest, isEdit, handleSubmit };
    },
});
</script>
