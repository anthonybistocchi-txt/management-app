import api from "../../utils/api";
import { ApiResponse } from "../../types/ApiResponse";
import { UserData } from "../../types/User/User";

export const GetUserService = {

    async getAllUsers(): Promise<ApiResponse<UserData[]> | null> {
        try {
            const { data: response } = await api.post<ApiResponse<UserData[]>>("users/getAll");
          
            if (response.status && response.data) return response; 

            return null;
            
        } catch (error) {
            console.error("Erro na requisição:", error);
            return null;
        }
    },
};