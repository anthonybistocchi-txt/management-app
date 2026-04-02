import { LocationController } from "../../Controllers/Locations/LocationController";
import { hasSubsidiaries } from "../../config/appEnv";
import { renderSelectOptions } from "../../utils/renderSelectOptions";

export async function showLocations($selectElement: JQuery<HTMLElement>): Promise<void> {
    if (!hasSubsidiaries() || $selectElement.length === 0) {
        return;
    }

    const locations = await LocationController.getLocations();

    renderSelectOptions(
        $selectElement,
        locations.map((location) => ({
            value: String(location.id),
            label: location.name,
        })),
        {
            placeholder: "Selecione uma localização",
        }
    );
}