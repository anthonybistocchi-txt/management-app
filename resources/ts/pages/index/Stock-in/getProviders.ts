import { ProviderService } from "../../../services/StockInService.ts/ProviderService";
import { ApiResponse } from "../../../types/Utils/ApiResponse";
import { Toast } from "../../../components/swal";

export const getProviders = {

    async loadProviders($selectElements: JQuery<HTMLElement>[]) {
        try {
            const response: ApiResponse<ProviderData[]> = await ProviderService.getProviders();

            if (response.success && response.data) {
                const providers = response.data;

                // Percorre todos os selects informados (modal e principal)
                $selectElements.forEach(($element) => {
                    $element.empty();
                    $element.append('<option value="">Selecione um fornecedor</option>');
                    
                    providers.forEach((provider) => {
                        $element.append(`<option value="${provider.id}">${provider.name}</option>`);
                    });
                });
            } else {
                console.error("Erro ao buscar fornecedores:", response.message);
            }
        } catch (error) {
            console.error("Erro fatal ao buscar fornecedores:", error);
            Toast.error("Erro ao carregar lista de fornecedores.");
        }
    }
};