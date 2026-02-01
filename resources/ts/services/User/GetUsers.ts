import { ApiResponse } from "../../types/ApiResponse";
import { UserListResponse } from "../../types/User/User";
import api from "../../utils/api";

export const GetUserService = {
    async getAllUsers(
        start:          number, 
        length:         number, 
        search?:        string, 
        operator_type?: number | string, 
        active?:        number | string): Promise<ApiResponse<UserListResponse> | null> {
        try {
            const { data: response } = await api.post<ApiResponse<UserListResponse>>("users/getAll", { start, length, search, operator_type, active });
            
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