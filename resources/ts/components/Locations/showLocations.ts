import { LocationController } from "../../Controllers/Locations/LocationController";

export async function showLocations($selectElement: JQuery<HTMLElement>): Promise<void> {
    const locations = await LocationController.getLocations();

    $selectElement.find("option:not(:first)").remove();

    locations.forEach(location => {
        const option = `<option value="${location.id}">${location.name}</option>`;
        $selectElement.append(option);
    });
}
