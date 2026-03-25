import { ApiResponse } from "../../types/ApiResponse";
import api from "../../utils/api";

export const ProductService = {
    async getProducts(): Promise<ApiResponse<ProductData[]> > {
        try {
            const response = await api.get<ApiResponse<ProductData[]>>("products/getAll", {});
            
            return response.data;
        } catch (error: any) {
            console.error("Erro no serviço:", error);

            return {
                success: false,
                status: false,
                message: error.message || "Erro desconhecido ao buscar produtos.",
                errors: [error.message],
                data: [] 
            };
        }
    }
};
