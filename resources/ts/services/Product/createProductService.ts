import api from "../../Utils/api";
import { ApiResponse } from "../../types/ApiResponse";

export const ProductService = {
    async createProduct(newProduct: NewProductData): Promise<ApiResponse<NewProductData>> {
        try {
           const { data } = await api.post<ApiResponse<NewProductData>>("products/create", newProduct);

            return data;
        } catch (error: any) {
            console.error("Erro no serviço:", error);

            return {
                success: false,
                status: false,
                message: error.message || "Erro desconhecido ao buscar produtos.",
                errors: [error.message],
                data: null as any
            };
        }
    },
};
