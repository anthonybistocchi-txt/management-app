import api from "../../utils/api";
import { AxiosError } from "axios";
import { ApiResponse } from "../../types/Utils/ApiResponse";
import { CreateUser } from "../../types/User/CreateUser";

export const CreateUserService = {
    async createUser(name: string, username: string, email: string, type_user_id: number, password: string, cpf: string):Promise<ApiResponse<CreateUser> | void> {
        try {
            const { data } = await api.post("users/create", { name, username, email, type_user_id, password, cpf });
            return data;
        } catch (error) {
            const message =
                error instanceof AxiosError
                    ? error.response?.data?.message ?? "Erro ao criar usuário."
                    : "Erro inesperado.";

            console.error(message);
        }
    },
};
