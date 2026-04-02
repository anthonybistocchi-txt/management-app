import { ProviderController } from "../../Controllers/Providers/ProviderController";
import { renderSelectOptions } from "../../utils/renderSelectOptions";

export async function showProviders($selectElement: JQuery<HTMLElement>): Promise<void> {
    const providers = await ProviderController.getProviders();

    renderSelectOptions(
        $selectElement,
        providers.map((provider) => ({
            value: String(provider.id),
            label: provider.name,
        })),
        {
            placeholder: "Fornecedor",
            includeAllOption: "Todos",
        }
    );
}
