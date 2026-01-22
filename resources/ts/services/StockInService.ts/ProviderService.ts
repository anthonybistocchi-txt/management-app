import api from "../../Utils/api";
import { AxiosError } from "axios";
import { Toast } from "../../components/swal";

export const ProviderService = {
    async getProviders() {
        try {
            const { data } = await api.get("providers/all", {});
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
