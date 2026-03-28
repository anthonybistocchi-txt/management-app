import api from "../../utils/api";
import { ApiResponse } from "../../types/ApiResponse";
import { messageFromAxiosError } from "../../utils/axiosErrorMessage";

export type DeleteLocationResult =
    | { ok: true; data: ApiResponse<null> }
    | { ok: false; message: string };

export const DeleteLocationService = {
    async deleteLocation(id: number): Promise<DeleteLocationResult> {
        try {
            const { data } = await api.delete<ApiResponse<null>>("locations/delete", {
                data: { id },
            });

            if (data?.status) {
                return { ok: true, data };
            }

            return { ok: false, message: data?.message ?? "Nao foi possivel excluir o local." };
        } catch (error) {
            return { ok: false, message: messageFromAxiosError(error, "Erro ao excluir local.") };
        }
    },
};
