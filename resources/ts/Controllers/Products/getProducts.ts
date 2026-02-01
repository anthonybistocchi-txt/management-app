import { ProductService } from "../../services/Product/getProductService";
import { ApiResponse } from "../../types/ApiResponse";

export const getProductsController = {

    async getProducts(): Promise<ProductData[]> {
        try {
            const response: ApiResponse<ProductData[]> = await ProductService.getProducts();

            if (response.status && response.data) {
                return response.data;

            }
        } catch (error) {
            console.error("Erro ao carregar produtos:", error);
        }
        return [];
    }
};