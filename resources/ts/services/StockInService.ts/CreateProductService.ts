import api from "../../Utils/api";
import { AxiosError } from "axios";
import { Toast } from "../../components/swal";

export const ProductService = {
    async createProduct(productData: any) {
        try {
            const { data } = await api.post("/products", productData);
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
