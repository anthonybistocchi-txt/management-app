import { UpdateProductService } from "../../services/Product/UpdateProductService";

export const UpdateProductController = {
    async updateProduct(id: number, payload: Partial<ProductData>): Promise<{ success: boolean; message?: string }> {
        const result = await UpdateProductService.updateProduct(id, payload);
        if (result.ok) {
            return { success: true };
        }
        return { success: false, message: result.message };
    },
};
