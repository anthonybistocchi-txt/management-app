import api from "../../Utils/api";
import { AxiosError } from "axios";
import { Toast } from "../../components/swal";

export const SubmitStockInService = {
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

            Toast.error(message);
            throw error;
        }
    },
};
