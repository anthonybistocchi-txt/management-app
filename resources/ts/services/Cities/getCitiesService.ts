import api from "../../utils/api";

export const CitiesService = {
    async getCities(ufId: number): Promise<CityData[]> {
        try {
            const { data } = await api.get<CityData[]>("cities/getAll", {
                params: { uf_id: ufId },
            });

            return Array.isArray(data) ? data : [];
        } catch (error) {
            console.error("Erro ao carregar cidades:", error);
            return [];
        }
    },
};
