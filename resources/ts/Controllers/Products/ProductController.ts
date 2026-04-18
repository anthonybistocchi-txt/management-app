import { ProductService } from "../../services/Product/getProductService";
import { CreateProductService } from "../../services/Product/createProductService";
import { UpdateProductService } from "../../services/Product/UpdateProductService";
import { DeleteProductService } from "../../services/Product/DeleteProductService";
import { ApiResponse } from "../../types/ApiResponse";

export const ProductController = {
    async getInfoProducts(): Promise<ProductData[]> {
        try {
            const response: ApiResponse<ProductData[]> = await ProductService.getInfoProducts();

            if (Array.isArray(response.data)) {
                return response.data;
            }

            console.error("Resposta inválida ao obter produtos.");
        } catch (error) {
            console.error("Erro ao carregar produtos:", error);
        }
        return [];
    },

    async createProduct(payload: NewProductData): Promise<{ success: boolean; message?: string }> {
        const result = await CreateProductService.createProduct(payload);

        if (result.ok) {
            return { success: true };
        }

        return { success: false, message: result.message };
    },

    async updateProduct(id: number, payload: Partial<ProductData>): Promise<{ success: boolean; message?: string }> {
        const result = await UpdateProductService.updateProduct(id, payload);
        if (result.ok) {
            return { success: true };
        }
        return { success: false, message: result.message };
    },

    async deleteProduct(id: number): Promise<{ success: boolean; message?: string }> {
        const result = await DeleteProductService.deleteProduct(id);

        if (result.ok) {
            return { success: true };
        }

        return { success: false, message: result.message };
    },

};