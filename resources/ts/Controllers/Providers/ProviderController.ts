import { ProviderService } from "../../services/Provider/getProviderService";
import { CreateProviderService } from "../../services/Provider/createProviderService";
import { UpdateProviderService } from "../../services/Provider/UpdateProviderService";
import { DeleteProviderService } from "../../services/Provider/DeleteProviderService";
import { ApiResponse } from "../../types/ApiResponse";

export const ProviderController = {
    async getProviders(): Promise<ProviderData[]> {
        try {
            const response: ApiResponse<ProviderData[]> = await ProviderService.getProviders();

            if (response.status && response.data) {
                return response.data;
            }
        } catch (error) {
            console.error("Erro ao carregar fornecedores:", error);
        }
        return [];
    },

    async createProvider(payload: NewProviderData): Promise<{ success: boolean; message?: string }> {
        const result = await CreateProviderService.createProvider(payload);

        if (result.ok) {
            return { success: true };
        }

        return { success: false, message: result.message };
    },

    async updateProvider(id: number, payload: Partial<ProviderData>): Promise<{ success: boolean; message?: string }> {
        const result = await UpdateProviderService.updateProvider(id, payload);
        if (result.ok) {
            return { success: true };
        }
        return { success: false, message: result.message };
    },

    async deleteProvider(id: number): Promise<{ success: boolean; message?: string }> {
        const result = await DeleteProviderService.deleteProvider(id);

        if (result.ok) {
            return { success: true };
        }

        return { success: false, message: result.message };
    },
};