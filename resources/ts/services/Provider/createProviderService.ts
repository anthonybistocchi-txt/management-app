import api from "../../utils/api";
import { ApiResponse } from "../../types/ApiResponse";
import { messageFromAxiosError } from "../../utils/axiosErrorMessage";

export type CreateProviderResult =
    | { ok: true; data: ApiResponse<NewProviderData> }
    | { ok: false; message: string };

export const CreateProviderService = {
    async createProvider(newProvider: NewProviderData): Promise<CreateProviderResult> {
        try {
            const { data } = await api.post<ApiResponse<NewProviderData>>("providers/create", newProvider);

            if (data?.status) {
                return { ok: true, data };
            }

            return { ok: false, message: data?.message ?? "Nao foi possivel criar o fornecedor." };
        } catch (error) {
            return { ok: false, message: messageFromAxiosError(error, "Erro ao criar fornecedor.") };
        }
    },
};
