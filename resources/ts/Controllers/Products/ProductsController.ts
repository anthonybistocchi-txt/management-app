import { ProductService } from "../../services/Product/getProductService";
import { ApiResponse } from "../../types/ApiResponse";

export const getProductsController = {

    async getInfoProducts(): Promise<ProductData[]> {
        try {
            const response: ApiResponse<ProductData[]> = await ProductService.getInfoProducts();

            if (response.status && response.data) {
                return response.data;

            }
        } catch (error) {
            console.error("Erro ao carregar produtos:", error);
        }
        return [];
    }
};