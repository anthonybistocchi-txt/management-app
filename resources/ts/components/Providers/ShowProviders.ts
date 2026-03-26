import { getProvidersController } from "../../Controllers/Providers/ProvidersController";

export async function showProviders($selectElement: JQuery<HTMLElement>): Promise<void> {
    const providers = await getProvidersController.getProviders();

    $selectElement.empty();
    $selectElement.append('<option value="" selected disabled>Fornecedor</option>');
    $selectElement.append('<option value="all">Todos</option>');

    providers.forEach(provider => {
        const option = `<option value="${provider.id}">${provider.name}</option>`;
        $selectElement.append(option);
    });
}
