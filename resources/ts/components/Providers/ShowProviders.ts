import { ProviderController } from "../../Controllers/Providers/ProviderController";

export async function showProviders($selectElement: JQuery<HTMLElement>): Promise<void> {
    const providers = await ProviderController.getProviders();

    $selectElement.empty();
    $selectElement.append('<option value="" selected disabled>Fornecedor</option>');
    $selectElement.append('<option value="all">Todos</option>');

    providers.forEach(provider => {
        const option = `<option value="${provider.id}">${provider.name}</option>`;
        $selectElement.append(option);
    });
}
