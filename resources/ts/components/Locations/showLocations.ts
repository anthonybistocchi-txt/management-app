import { LocationController } from "../../Controllers/Locations/LocationController";

export async function showLocations($selectElement: JQuery<HTMLElement>): Promise<void> {
    const locations = await LocationController.getLocations();

    $selectElement.empty();
    $selectElement.append('<option value="" selected disabled>Local</option>');
    $selectElement.append('<option value="all">Todas</option>');

    locations.forEach(location => {
        const option = `<option value="${location.id}">${location.name}</option>`;
        $selectElement.append(option);
    });
}
