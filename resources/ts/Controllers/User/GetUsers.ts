import { GetUserService } from "../../services/User/GetUsers";

export const GetUserController = {
    async getUsers() {
        try {
            const response = await GetUserService.getAllUsers();
    
            if (response) return response

        } catch (error) {
            console.error("Fluxo interrompido:", error);
            return { users: [], total: 0 };
        }
    }
}