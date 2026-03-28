import api from "../../utils/api";
import { ApiResponse } from "../../types/ApiResponse";
import { messageFromAxiosError } from "../../utils/axiosErrorMessage";

export type UpdateLocationResult =
    | { ok: true; data: ApiResponse<LocationData> }
    | { ok: false; message: string };

export const UpdateLocationService = {
    async updateLocation(payload: Partial<LocationData> & { id: number }): Promise<UpdateLocationResult> {
        try {
            const { data } = await api.put<ApiResponse<LocationData>>("locations/update", payload);

            if (data?.status) {
                return { ok: true, data };
            }

            return { ok: false, message: data?.message ?? "Nao foi possivel atualizar o local." };
        } catch (error) {
            return { ok: false, message: messageFromAxiosError(error, "Erro ao atualizar local.") };
        }
    },
};
