import api from "../../utils/api";
import { ApiResponse } from "../../types/ApiResponse";
import { messageFromAxiosError } from "../../utils/axiosErrorMessage";

export type UpdateProviderResult =
    | { ok: true; data: ApiResponse<ProviderData> }
    | { ok: false; message: string };

export const UpdateProviderService = {
    async updateProvider(id: number, payload: Partial<ProviderData>): Promise<UpdateProviderResult> {
        try {
            const { data } = await api.put<ApiResponse<ProviderData>>(`providers/update/${id}`, payload);

            if (data?.status) {
                return { ok: true, data };
            }

            return { ok: false, message: data?.message ?? "Nao foi possivel atualizar o fornecedor." };
        } catch (error) {
            return { ok: false, message: messageFromAxiosError(error, "Erro ao atualizar fornecedor.") };
        }
    },
};
