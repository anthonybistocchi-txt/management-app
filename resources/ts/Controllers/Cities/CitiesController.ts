import { CitiesService } from "../../services/Cities/getCitiesService";

export const CitiesController = {
    async getCities(ufId?: number): Promise<CityData[]> {
        return CitiesService.getCities(ufId);
    },

    async getCityByCep(cep: string): Promise<{ city?: string; uf?: string; state?: string } | null> {
        if (!cep) return null;
        return CitiesService.getCityByCep(cep);
    },
};
