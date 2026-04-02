import { CitiesController } from "../../Controllers/Cities/CitiesController";
import { renderSelectOptions } from "../../utils/renderSelectOptions";

export async function showCities($selectElement: JQuery<HTMLElement>, ufId?: number): Promise<void> {
    if (!ufId) {
        renderSelectOptions($selectElement, [], {
            placeholder: "Selecione um estado",
            disabled: true,
        });
        return;
    }

    const cities = await CitiesController.getCities(ufId);

    renderSelectOptions(
        $selectElement,
        cities.map((city) => ({
            value: city.nome,
            label: city.nome,
        })),
        {
            placeholder: "Cidade",
            disabled: false,
        }
    );
}
