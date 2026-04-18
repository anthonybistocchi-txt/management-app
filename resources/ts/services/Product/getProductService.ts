import { ApiResponse } from "../../types/ApiResponse";
import { AxiosError } from "axios";
import api from "../../utils/api";
import { messageFromAxiosError } from "../../utils/axiosErrorMessage";

export const ProductService = {
    async getInfoProducts(): Promise<ApiResponse<ProductData[]> > {
        try {
            const response = await api.get<ApiResponse<ProductData[]>>("stock/getAllInfo", {});
            
            return response.data;
        } catch (error: unknown) {
            console.error("Erro no serviço:", error);
            const message = messageFromAxiosError(error as Error | AxiosError, "Erro desconhecido ao buscar produtos.");

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
