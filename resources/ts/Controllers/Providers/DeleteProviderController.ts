import { DeleteProviderService } from "../../services/Provider/DeleteProviderService";

export const DeleteProviderController = {
    async deleteProvider(id: number): Promise<{ success: boolean; message?: string }> {
        const result = await DeleteProviderService.deleteProvider(id);
        if (result.ok) {
            return { success: true };
        }
        return { success: false, message: result.message };
    },
};
