import { ApiResponse } from "../../types/ApiResponse";
import { EditUser, UserData } from "../../types/User/User";
import api from "../../utils/api";

export const GetUserByIdService = {
    async getUserById(id: number[]): Promise<ApiResponse<UserData>> {
        try {   
            const { data: response } = await api.post<ApiResponse<UserData>>(`users/get`, { id });
            if (response.status && response.data) {
                return response;
            }
            throw new Error("Resposta inválida da API ao obter usuário por ID.");
        } catch (error) {
            console.error("Erro na requisição:", error);
            throw error;
        }
    },
};