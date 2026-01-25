import api from "../../utils/api";
import { LoginCredentials } from "../../types/Auth/LoginCredentials";
import { Toast } from "../../components/Swal/swal";
import { handleError } from "../../utils/ApiHandleError";

export const AuthService = {
    async login(credentials: LoginCredentials) {
        try {
            const { data } = await api.post("/login", credentials);

            return data;
        } catch (error) {
            handleError(error);
            console.error(error);
        }
    },

    async logout() {
        try {
            const logout: boolean = await api.post("/logout");

            if (logout) return true;

            return false;
        } catch (error) {
            handleError(error);
            console.error(error);
            return false;
        }
    },
};
