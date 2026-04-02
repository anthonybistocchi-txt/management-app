import api from "../../utils/api";

export const UfService = {
    async getUfs(): Promise<UFData[]> {
        try {
            const { data } = await api.get<UFData[]>("uf/getAll", {});
            return Array.isArray(data) ? data : [];
        } catch (error) {
            console.error("Erro ao carregar UFs:", error);
            return [];
        }
    },
};
