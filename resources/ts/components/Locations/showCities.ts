import { CitiesController } from "../../Controllers/Cities/CitiesController";
import { renderSelectOptions } from "../../utils/renderSelectOptions";

export async function showCities($selectElement: JQuery<HTMLElement>, ufId?: number): Promise<void> {
    const cities = await CitiesController.getCities(ufId);

    renderSelectOptions(
        $selectElement,
        cities.map((city) => ({
            value: city.nome,
            label: city.nome,
        })),
        {
            placeholder: ufId ? "Cidade" : "Todas as cidades",
            disabled: false,
        }
    );
}
