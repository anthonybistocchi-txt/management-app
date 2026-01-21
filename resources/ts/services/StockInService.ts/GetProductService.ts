import api from "../../Utils/api";
import { AxiosError } from "axios";
import { Toast } from "../../components/swal";

export const ProductService = {
    async getProducts() {
        try {
            const { data } = await api.get("/products", {});
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
