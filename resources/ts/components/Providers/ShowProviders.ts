import { getProvidersController } from "../../Controllers/Providers/ProvidersController";

export async function showProviders($selectElement: JQuery<HTMLElement>): Promise<void> {
    const providers = await getProvidersController.getProviders();

    $selectElement.find("option:not(:first)").remove();

    providers.forEach(provider => {
        const option = `<option value="${provider.id}">${provider.name}</option>`;
        $selectElement.append(option);
    });
}
