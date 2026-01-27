import { ApiResponse } from "../../types/ApiResponse";
import { UserListResponse } from "../../types/User/User";
import api from "../../utils/api";

export const GetUserService = {
    async getAllUsers(): Promise<ApiResponse<UserListResponse> | null> {
        try {
            const { data: response } = await api.post<ApiResponse<UserListResponse>>("users/getAll");
            
            if (response.status && response.data) {
                return response; 
            }
            
            return null;
        } catch (error) {
            console.error("Erro na requisição:", error);
            return null;
        }
    },
};