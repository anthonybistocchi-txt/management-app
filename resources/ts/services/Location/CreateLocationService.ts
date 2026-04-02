import api from "../../utils/api";
import { ApiResponse } from "../../types/ApiResponse";
import { messageFromAxiosError } from "../../utils/axiosErrorMessage";

export type CreateLocationResult =
    | { ok: true; data: ApiResponse<LocationData> }
    | { ok: false; message: string };

export const CreateLocationService = {
    async createLocation(payload: Partial<LocationData>): Promise<CreateLocationResult> {
        try {
            const { data } = await api.post<ApiResponse<LocationData>>("locations/create", payload);

            if (data?.status) {
                return { ok: true, data };
            }

            return { ok: false, message: data?.message ?? "Nao foi possivel criar o local." };
        } catch (error) {
            return { ok: false, message: messageFromAxiosError(error, "Erro ao criar local.") };
        }
    },
};
