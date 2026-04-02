import { LocationController } from "../../Controllers/Locations/LocationController";
import { renderSelectOptions } from "../../utils/renderSelectOptions";

export async function showLocations($selectElement: JQuery<HTMLElement>): Promise<void> {
    const locations = await LocationController.getLocations();

    renderSelectOptions(
        $selectElement,
        locations.map((location) => ({
            value: String(location.id),
            label: location.name,
        })),
        {
            placeholder: "Local",
            includeAllOption: "Todas",
        }
    );
}
