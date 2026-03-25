import { LocationController } from "../../Controllers/Locations/LocationController";
import { hasSubsidiaries } from "../../config/appEnv";

export async function showLocations($selectElement: JQuery<HTMLElement>): Promise<void> {
    if (!hasSubsidiaries() || $selectElement.length === 0) {
        return;
    }

    const locations = await LocationController.getLocations();

    $selectElement.empty();
    $selectElement.append('<option value="" selected disabled>Selecione uma localização</option>');
    
    locations.forEach((location) => {
        const option = `<option value="${location.id}">${location.name}</option>`;
        $selectElement.append(option);
    });
}