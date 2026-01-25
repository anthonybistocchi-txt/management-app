import api from "../../utils/api";
import {UsersResponse } from "../../types/User/GetUser";
import { ApiResponse } from "../../types/Utils/ApiResponse";

export const GetUserService = {

    async getAllUsers(): Promise<UsersResponse | null> {
        try {
            const { data: response } = await api.post<ApiResponse<UsersResponse>>("users/getAll");
          
            if (response.status && response.data) {
                
                return response.data; 
            }
            
            return null;
        } catch (error) {
            console.error("Erro na requisição:", error);
            return null;
        }
    },
};