
import api from "../../utils/api";
import { AxiosError } from "axios";

export const GetUserService = {
    async getAllUsers() {
        try {
            const { data } = await api.get("users/getAll");
            return data;
        } catch (error) {
            const message =
                error instanceof AxiosError
                    ? error.response?.data?.message ?? "Erro ao carregar usuários."
                    : "Erro inesperado.";

            console.error(message);
        }
    },
};
