import { ProviderService } from "../../Services/Provider/getProviderService";
import { ApiResponse } from "../../types/Utils/ApiResponse";

export const getProvidersController = {

    async loadProviders($selectElements: JQuery<HTMLElement>[]) {
        try {
            const response: ApiResponse<ProviderData[]> = await ProviderService.getProviders();

            if (response.status && response.data) {
                const providers = response.data;

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
        }
    }
};