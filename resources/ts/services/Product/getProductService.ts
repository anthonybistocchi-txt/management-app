import { ApiResponse } from "../../types/ApiResponse";
import api from "../../utils/api";
import { messageFromAxiosError } from "../../utils/axiosErrorMessage";

export const ProductService = {
    async getProducts(): Promise<ApiResponse<ProductData[]> > {
        try {
            const response = await api.get<ApiResponse<ProductData[]>>("products/getAll", {});
            
            return response.data;
        } catch (error) {
            console.error("Erro no serviço:", error);
            const message = messageFromAxiosError(error, "Erro desconhecido ao buscar produtos.");

            return {
                success: false,
                status: false,
                message,
                errors: [message],
                data: []
            };
        }
    }
};
