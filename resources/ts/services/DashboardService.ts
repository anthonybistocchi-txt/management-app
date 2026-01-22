import api from "../Utils/api";
import { AxiosError } from "axios";
import { Toast } from "../components/swal";

export const DashboardService = {
    async getDashboard(date_from: string, date_to: string) {
        try {
            const { data } = await api.post("/dashboard", { date_from, date_to });
            return data;
        } catch (error) {
            const message =
                error instanceof AxiosError
                    ? error.response?.data?.message ?? "Erro ao carregar dashboard."
                    : "Erro inesperado.";
            console.error(error);
        }
    },
};
