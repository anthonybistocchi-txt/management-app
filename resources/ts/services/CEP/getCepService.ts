import api from "../../utils/api";

export const CepService = {
    async getAddress(cep: string): Promise<CepAddressData | null> {
        try {
            const { data } = await api.get<CepAddressData>(`cep/get/${cep}`, {});
            return data ?? null;
        } catch (error) {
            console.error("Erro ao buscar CEP:", error);
            return null;
        }
    },
};
