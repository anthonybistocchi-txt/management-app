import api from "../../utils/api";
import { AxiosError } from "axios";

export const UserLoggedService = {
    async getUserLogged() {
        try {
            const { data } = await api.get("users/getLogged", {});
      
            return data;
        } catch (error) {
            const message =
                error instanceof AxiosError
                    ? error.response?.data?.message ?? "Erro ao carregar dashboard."
                    : "Erro inesperado.";

            console.error(message);
        }
    },
};
