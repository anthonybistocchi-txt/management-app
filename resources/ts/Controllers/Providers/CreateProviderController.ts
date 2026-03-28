import { CreateProviderService } from "../../services/Provider/createProviderService";

export const CreateProviderController = {
    async createProvider(payload: NewProviderData): Promise<{ success: boolean; message?: string }> {
        const result = await CreateProviderService.createProvider(payload);

        if (result.ok) {
            return { success: true };
        }

        return { success: false, message: result.message };
    },
};
