import api from "../../utils/api";
import { ApiResponse } from "../../types/ApiResponse";
import { messageFromAxiosError } from "../../utils/axiosErrorMessage";

export type UpdateProductResult =
    | { ok: true; data: ApiResponse<ProductData> }
    | { ok: false; message: string };

export const UpdateProductService = {
    async updateProduct(id: number, payload: Partial<ProductData>): Promise<UpdateProductResult> {
        try {
            const { data } = await api.put<ApiResponse<ProductData>>(`products/update/${id}`, payload);

            if (data?.status) {
                return { ok: true, data };
            }

            return { ok: false, message: data?.message ?? "Nao foi possivel atualizar o produto." };
        } catch (error) {
            return { ok: false, message: messageFromAxiosError(error, "Erro ao atualizar produto.") };
        }
    },
};
