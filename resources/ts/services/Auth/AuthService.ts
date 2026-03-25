import api from "../../utils/api";
import { LoginCredentials } from "../../types/Auth/LoginCredentials";
import { handleError } from "../../utils/ApiHandleError";

export const AuthService = {
    async login(credentials: LoginCredentials) {
        try {
            const { data } = await api.post("/login", credentials, { baseURL: '/' });

            return data;
        } catch (error) {
            handleError(error);
            console.error(error);
        }
    },

    async logout() {
        try {
            const logout: boolean = await api.post("/logout", {}, { baseURL: '/' });

            if (logout) return true;

            return false;
        } catch (error) {
            handleError(error);
            console.error(error);
            return false;
        }
    },
};
