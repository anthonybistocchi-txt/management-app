import api from "../../utils/api";

export const CitiesService = {
    async getCities(ufId?: number): Promise<CityData[]> {
        try {
            const params = typeof ufId === "number" && !Number.isNaN(ufId)
                ? { uf_id: ufId }
                : undefined;

            const { data } = await api.get<CityData[]>("cities/getAll", { params });

            return Array.isArray(data) ? data : [];
        } catch (error) {
            console.error("Erro ao carregar cidades:", error);
            return [];
        }
    },

    async getCityByCep(cep: string): Promise<{ city?: string; uf?: string; state?: string } | null> {
        try {
            const { data } = await api.get<{ city?: string; uf?: string; state?: string }>(`cities/getByCEP/${cep}`, {});
            return data ?? null;
        } catch (error) {
            console.error("Erro ao buscar cidade por CEP:", error);
            return null;
        }
    },
};
