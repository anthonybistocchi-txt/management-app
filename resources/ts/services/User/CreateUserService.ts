import api from "../../utils/api";
import { ApiResponse } from "../../types/ApiResponse";
import { CreateUser } from "../../types/User/User";
import { messageFromAxiosError } from "../../utils/axiosErrorMessage";

export type CreateUserResult =
    | { ok: true; data: ApiResponse<CreateUser> }
    | { ok: false; message: string };

export const CreateUserService = {
    async createUser(
        name: string,
        username: string,
        email: string,
        type_user_id: number,
        password: string,
        cpf: string
    ): Promise<CreateUserResult> {
        try {
            const { data } = await api.post<ApiResponse<CreateUser>>("users/create", {
                name,
                username,
                email,
                type_user_id,
                password,
                cpf,
            });

            if (data?.status) {
                return { ok: true, data };
            }

            return { ok: false, message: data?.message ?? "Não foi possível criar o usuário." };
        } catch (error) {
            return { ok: false, message: messageFromAxiosError(error, "Erro ao criar usuário.") };
        }
    },
};
