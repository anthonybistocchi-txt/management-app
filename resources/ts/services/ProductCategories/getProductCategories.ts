import api from "../../utils/api";
import { ApiResponse } from "../../types/ApiResponse";

export const ProductCategoriesService = {
    async getProductCategories(): Promise<ApiResponse<ProductCategoryData[]>> {
        try {
           const { data } = await api.get<ApiResponse<ProductCategoryData[]>>("product-categories/getAll", {});

            return data;
        } catch (error: any) {
            console.error("Erro no serviço:", error);

            return {
                success: false,
                status: false,
                message: error.message || "Erro desconhecido ao buscar categorias de produtos.",
                errors: [error.message],
                data: []
            };
        }
    },
};
