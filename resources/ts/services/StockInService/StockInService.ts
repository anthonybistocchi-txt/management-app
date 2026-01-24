import api from "../../Utils/api";
import { AxiosError } from "axios";

export const StockInService = {
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
};
