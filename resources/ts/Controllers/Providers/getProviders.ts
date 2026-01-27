import { ProviderService } from "../../services/Provider/getProviderService";
import { ApiResponse } from "../../types/ApiResponse";

export const getProvidersController = {

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
        }
};