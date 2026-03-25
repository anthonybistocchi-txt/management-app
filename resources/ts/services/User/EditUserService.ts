import api from "../../utils/api";
import { ApiResponse } from "../../types/ApiResponse";
import { EditUser } from "../../types/User/User";
import { messageFromAxiosError } from "../../utils/axiosErrorMessage";

export type EditUserResult =
    | { ok: true; data: ApiResponse<EditUser> }
    | { ok: false; message: string };

export const UserEditService = {
    async editUser(
        id: number,
        name: string,
        email: string,
        username: string,
        password: string,
        type_user_id: number,
        cpf: string
    ): Promise<EditUserResult> {
        try {
            const body: Record<string, string | number> = {
                id,
                name,
                email,
                username,
                type_user_id,
                cpf,
            };

            if (password.trim() !== "") {
                body.password = password;
            }

            const { data } = await api.put<ApiResponse<EditUser>>("users/update", body);

            if (data?.status) {
                return { ok: true, data };
            }

            return { ok: false, message: data?.message ?? "Não foi possível atualizar o usuário." };
        } catch (error) {
            return { ok: false, message: messageFromAxiosError(error, "Erro ao atualizar usuário.") };
        }
    },
};
