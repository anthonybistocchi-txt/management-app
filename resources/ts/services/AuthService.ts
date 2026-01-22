import api from "../Utils/api";
import { LoginCredentials } from "../types/Auth/LoginCredentials";
import { Toast } from "../components/swal";
import { handleError } from "../Utils/ApiHandleError";

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

    async logout(): Promise<boolean> {
        try {
            await api.post("/logout");
            Toast.success("Logout realizado com sucesso.");

            return true;
        } catch (error) {
            handleError(error);
            console.error(error);
            return false;
        }
    },
};
