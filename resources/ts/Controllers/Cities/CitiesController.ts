import { CitiesService } from "../../services/Cities/getCitiesService";

export const CitiesController = {
    async getCities(ufId: number): Promise<CityData[]> {
        if (!ufId) return [];
        return CitiesService.getCities(ufId);
    },
};
