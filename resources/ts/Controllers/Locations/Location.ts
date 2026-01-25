import { LocationService } from "../../services/Location/LocationService";

export const LocationController = {
    async loadLocations(locations_container: JQuery<HTMLElement>): Promise<void> {
        try {
            const response = await LocationService.getLocations();
            if (response.status && response.data) {
                const locations = response.data;

                locations.forEach(element => {
                    locations_container.append(`<option value="${element.id}">${element.name}</option>`);
                });
            }

        } catch (error) {
            console.error("Erro ao carregar localizações:", error);
        }
    }
}