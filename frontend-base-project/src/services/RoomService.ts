import axios from "axios";

const API_URL = "http://localhost:8001/api/admin/rooms";

interface Room {
    id?: number;
    floor_number: number;
    room_number: number;
    capacity: number;
    status: "READY" | "TAKEN" | "MAINTENANCE";
}

const RoomService = {
    async getAllRooms(): Promise<Room[]> {
        const response = await axios.get<Room[]>(API_URL);
        return response.data;
    },

    async getRoomById(id: number): Promise<Room> {
        const response = await axios.get<Room>(`${API_URL}/${id}`);
        return response.data;
    },

    async createRoom(roomData: Room): Promise<Room> {
        const response = await axios.post<Room>(API_URL, roomData);
        return response.data;
    },

    async updateRoom(id: number, roomData: Room): Promise<Room> {
        const response = await axios.put<Room>(`${API_URL}/${id}`, roomData);
        return response.data;
    },
    async assignRoom(roomId: number, guestId: number) {
        const response = await axios.post(
            `${API_URL}/${roomId}/assignGuestToRoom/${guestId}`
        );
        return response.data;
    },

    async setRoomStatus(
        id: number,
        status: "READY" | "TAKEN" | "MAINTENANCE"
    ): Promise<void> {
        const response = await axios.post(`${API_URL}/${id}/ready`, { status });
        return response.data;
    },
};

export default RoomService;
