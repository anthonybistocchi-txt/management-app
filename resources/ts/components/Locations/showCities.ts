import { CitiesController } from "../../Controllers/Cities/CitiesController";

export async function showCities($selectElement: JQuery<HTMLElement>, ufId?: number): Promise<void> {
    $selectElement.empty();

    if (!ufId) {
        $selectElement.append('<option value="" selected disabled>Selecione um estado</option>');
        $selectElement.prop("disabled", true);
        return;
    }

    const cities = await CitiesController.getCities(ufId);
    $selectElement.append('<option value="" selected disabled>Cidade</option>');
    $selectElement.prop("disabled", false);

    cities.forEach((city) => {
        const option = `<option value="${city.nome}">${city.nome}</option>`;
        $selectElement.append(option);
    });
}
