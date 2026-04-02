import api from "../../utils/api";
import { ApiResponse } from "../../types/ApiResponse";
import { messageFromAxiosError } from "../../utils/axiosErrorMessage";

export const ProductCategoriesService = {
    async getProductCategories(): Promise<ApiResponse<ProductCategoryData[]>> {
        try {
           const { data } = await api.get<ApiResponse<ProductCategoryData[]>>("product-categories/getAll", {});

            return data;
        } catch (error: unknown) {
            console.error("Erro no serviço:", error);
            const message = messageFromAxiosError(error, "Erro desconhecido ao buscar categorias de produtos.");

            return {
                success: false,
                status: false,
                message,
                errors: [message],
                data: []
            };
        }
    },
};
