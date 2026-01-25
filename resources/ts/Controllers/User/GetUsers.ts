import { GetUserService } from "../../services/User/GetUsers";

export const GetUserController = {
    async getUsers(skip: number, take: number) { 
        try {
            const response = await GetUserService.getAllUsers({ skip, take });
    
            if (response) return response

        } catch (error) {
            console.error("Fluxo interrompido:", error);
            return { users: [], total: 0 };
        }
    }
}