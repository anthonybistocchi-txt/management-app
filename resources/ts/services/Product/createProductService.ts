import api from "../../utils/api";
import { ApiResponse } from "../../types/ApiResponse";
import { messageFromAxiosError } from "../../utils/axiosErrorMessage";

export type CreateProductResult =
    | { ok: true; data: ApiResponse<NewProductData> }
    | { ok: false; message: string };

export const CreateProductService = {
    async createProduct(newProduct: NewProductData): Promise<CreateProductResult> {
        try {
            const { data } = await api.post<ApiResponse<NewProductData>>("products/create", newProduct);

            if (data?.status) {
                return { ok: true, data };
            }

            return { ok: false, message: data?.message ?? "Nao foi possivel criar o produto." };
        } catch (error) {
            return { ok: false, message: messageFromAxiosError(error, "Erro ao criar produto.") };
        }
    },
};
