import { ApiResponse } from "../../types/ApiResponse";
import { UserData } from "../../types/User/User";
import api from "../../utils/api";

export const GetUserByIdService = {
    async getUserById(id: number): Promise<ApiResponse<UserData>> {
        try {   
            const { data: response } = await api.get<ApiResponse<UserData>>(`users/getById/${id}`);
            console.log(response);
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