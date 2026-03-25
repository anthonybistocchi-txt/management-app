import api from "../../utils/api";
import { messageFromAxiosError } from "../../utils/axiosErrorMessage";

export type DeleteUserResult = { ok: true } | { ok: false; message: string };

export const DeleteUserService = {
    async deleteUser(id: number): Promise<DeleteUserResult> {
        try {
            const { data } = await api.delete<{ status: boolean; message?: string }>(`users/delete/${id}`);

            if (data?.status) {
                return { ok: true };
            }

            return { ok: false, message: data?.message ?? "Não foi possível excluir o usuário." };
        } catch (error) {
            return { ok: false, message: messageFromAxiosError(error, "Erro ao excluir usuário.") };
        }
    },
};
