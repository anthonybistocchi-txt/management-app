import { CreateProductService } from "../../services/Product/createProductService";

export const CreateProductController = {
    async createProduct(payload: NewProductData): Promise<{ success: boolean; message?: string }> {
        const result = await CreateProductService.createProduct(payload);

        if (result.ok) {
            return { success: true };
        }

        return { success: false, message: result.message };
    },
};
