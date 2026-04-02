import api from "../../utils/api";
import { ApiResponse } from "../../types/ApiResponse";
import { messageFromAxiosError } from "../../utils/axiosErrorMessage";

export type DeleteProductResult =
    | { ok: true; data: ApiResponse<null> }
    | { ok: false; message: string };

export const DeleteProductService = {
    async deleteProduct(id: number): Promise<DeleteProductResult> {
        try {
            const { data } = await api.delete<ApiResponse<null>>(`products/delete/${id}`);

            if (data?.status) {
                return { ok: true, data };
            }

            return { ok: false, message: data?.message ?? "Nao foi possivel excluir o produto." };
        } catch (error) {
            return { ok: false, message: messageFromAxiosError(error, "Erro ao excluir produto.") };
        }
    },
};
