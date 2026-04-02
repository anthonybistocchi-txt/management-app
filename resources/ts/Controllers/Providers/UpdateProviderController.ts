import { UpdateProviderService } from "../../services/Provider/UpdateProviderService";

export const UpdateProviderController = {
    async updateProvider(id: number, payload: Partial<ProviderData>): Promise<{ success: boolean; message?: string }> {
        const result = await UpdateProviderService.updateProvider(id, payload);
        if (result.ok) {
            return { success: true };
        }
        return { success: false, message: result.message };
    },
};
