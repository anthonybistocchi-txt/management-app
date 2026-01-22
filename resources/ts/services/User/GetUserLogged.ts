import api from "../../Utils/api";
import { AxiosError } from "axios";
import { Toast } from "../../components/swal";

export const UserLoggedService = {
    async UserLogged() {
        try {
            const { data } = await api.get("/users/logged", {});
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
