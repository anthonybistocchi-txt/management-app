import { ProductCategoriesService } from "../../services/ProductCategories/getProductCategories";
import { ApiResponse } from "../../types/ApiResponse";

export const ProductCategoriesController = {
    async getProductCategories(): Promise<ProductCategoryData[]> {
            try {
                const response: ApiResponse<ProductCategoryData[]> = await ProductCategoriesService.getProductCategories();
    
                if (response.status && response.data) {
                    return response.data;
    
                }
            } catch (error) {
                console.error("Erro ao carregar categorias de produtos:", error);
            }
            return [];
        }
}