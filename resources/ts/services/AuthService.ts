import api from "../utils/api";
import { LoginCredentials } from "../types/Auth/LoginCredentials";
import { Toast } from "../components/swal";
import { handleError } from "../utils/ApiHandleError";

export const AuthService = {
    async login(credentials: LoginCredentials) {
        try {
            const { data } = await api.post("/login", credentials);
            
            return data;
        } catch (error) {
            const message = handleError(error);
            Toast.error(message);

            throw error;
        }
    },

    async logout(): Promise<boolean> {
        try {
            await api.post("/logout");
            Toast.success("Logout realizado com sucesso.");

            return true;
        } catch (error) {
            const message = handleError(error);
            Toast.error(message);
            
            return false;
        }
    },
};
