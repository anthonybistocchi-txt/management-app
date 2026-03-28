import { DeleteProductService } from "../../services/Product/DeleteProductService";

export const DeleteProductController = {
    async deleteProduct(id: number): Promise<{ success: boolean; message?: string }> {
        const result = await DeleteProductService.deleteProduct(id);
        if (result.ok) {
            return { success: true };
        }
        return { success: false, message: result.message };
    },
};
