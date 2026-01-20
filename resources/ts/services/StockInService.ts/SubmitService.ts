import api from "../../Utils/api";
import { AxiosError } from "axios";
import { Toast } from "../../components/swal";

export const SubmitService = {
    async submitStockIn(date: string) {
        try {
            const { data } = await api.post("/dashboard", { date });
            return data;
        } catch (error) {
            const message =
                error instanceof AxiosError
                    ? error.response?.data?.message ?? "Erro ao carregar dashboard."
                    : "Erro inesperado.";

            Toast.error(message);
            throw error;
        }
    },
};
