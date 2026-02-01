import { getProvidersController } from "../../Controllers/Providers/getProviders";

export async function showProviders($selectElement: JQuery<HTMLElement>): Promise<void> {
    const providers = await getProvidersController.getProviders();
    
    $selectElement.empty();
    $selectElement.append('<option value="" selected disabled>Selecione um fornecedor</option>');

    providers.forEach(provider => {
        const option = `<option value="${provider.id}">${provider.name}</option>`;
        $selectElement.append(option);
    });
}