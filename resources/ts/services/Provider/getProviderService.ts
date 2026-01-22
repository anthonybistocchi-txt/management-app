import api from "../../Utils/api";
import { AxiosError } from "axios";

export const ProviderService = {
    async getProviders() {
        try {
            const { data } = await api.get("providers/getAll", {});
            return data;
        } catch (error) {
            const message =
                error instanceof AxiosError
                    ? error.response?.data?.message ?? "Erro ao carregar fornecedores."
                    : "Erro inesperado.";

            console.error(message);
        }
    },
};
