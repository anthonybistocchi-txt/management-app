import api from "../../utils/api";
import { ApiResponse } from "../../types/ApiResponse";
import { messageFromAxiosError } from "../../utils/axiosErrorMessage";

export type DeleteProviderResult =
    | { ok: true; data: ApiResponse<null> }
    | { ok: false; message: string };

export const DeleteProviderService = {
    async deleteProvider(id: number): Promise<DeleteProviderResult> {
        try {
            const { data } = await api.delete<ApiResponse<null>>(`providers/delete/${id}`);

            if (data?.status) {
                return { ok: true, data };
            }

            return { ok: false, message: data?.message ?? "Nao foi possivel excluir o fornecedor." };
        } catch (error) {
            return { ok: false, message: messageFromAxiosError(error, "Erro ao excluir fornecedor.") };
        }
    },
};
