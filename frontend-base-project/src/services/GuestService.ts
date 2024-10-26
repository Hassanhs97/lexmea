import axios from "axios";

const API_URL = "http://localhost:8001/api/admin/guests";

interface Guest {
    id?: number;
    full_name: string;
    age: number;
}

const GuestService = {
    async getAllGuests(): Promise<Guest[]> {
        const response = await axios.get<Guest[]>(API_URL);
        return response.data;
    },

    async getGuestById(id: number): Promise<Guest> {
        const response = await axios.get<Guest>(`${API_URL}/${id}`);
        return response.data;
    },

    async createGuest(guestData: Guest): Promise<Guest> {
        const response = await axios.post<Guest>(API_URL, guestData);
        return response.data;
    },

    async updateGuest(id: number, guestData: Guest): Promise<Guest> {
        const response = await axios.put<Guest>(`${API_URL}/${id}`, guestData);
        return response.data;
    },
};

export default GuestService;
