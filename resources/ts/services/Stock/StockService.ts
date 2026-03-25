import api from "../../utils/api";
import { AxiosError } from "axios";

export const StockService = {
    async submitStockIn(requestData: FormStockInData) {
        try {
            const { data } = await api.post("/stock/in", 
            requestData);

            return data;
        } catch (error) {
            const message =
                error instanceof AxiosError
                    ? error.response?.data?.message ?? "Erro ao enviar entrada de estoque."
                    : "Erro inesperado.";

            console.error(message);
        }
    },

    async submitStockOut(requestData: FormStockOutData) {
        try {
            const { data } = await api.post("/stock/out", 
            requestData);

            return data;
        } catch (error) {
            const message =
                error instanceof AxiosError
                    ? error.response?.data?.message ?? "Erro ao enviar saída de estoque."
                    : "Erro inesperado.";

            console.error(message);
        }
    }
};
