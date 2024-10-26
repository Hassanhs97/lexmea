import { createRouter, createWebHistory } from "vue-router";
import RoomList from "../components/RoomList.vue";
import RoomForm from "../components/RoomForm.vue";
import GuestList from "../components/GuestList.vue";
import GuestForm from "../components/GuestForm.vue";

const routes = [
    {
        path: "/",
        name: "Home",
        component: RoomList,
    },
    {
        path: "/rooms",
        name: "RoomList",
        component: RoomList,
    },
    {
        path: "/rooms/create",
        name: "RoomCreate",
        component: RoomForm,
    },
    {
        path: "/rooms/:id/edit",
        name: "RoomEdit",
        component: RoomForm,
    },
    {
        path: "/guests",
        name: "GuestList",
        component: GuestList,
    },
    {
        path: "/guests/create",
        name: "GuestCreate",
        component: GuestForm,
    },
    {
        path: "/guests/:id/edit",
        name: "GuestEdit",
        component: GuestForm,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
