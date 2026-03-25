import { LoginCredentials } from "../../types/Auth/LoginCredentials";
import { handleError } from "../../utils/ApiHandleError";
import { ApiResponse } from "../../types/ApiResponse";
import { AuthService } from "../../services/Auth/AuthService";

export const AuthController = {
    async login(credentials: LoginCredentials) {
        try {
            const response: ApiResponse<boolean> = await AuthService.login(credentials);

            if (response.status) return true

            return false

        } catch (error) {
            handleError(error);
            console.error("error ao logar: " + error);
        }
    },

    async logout(): Promise<boolean> {
        try {
            const response: boolean = await AuthService.logout();

            if (response) return true;

            return false;
        } catch (error) {
            handleError(error);
            console.error(error);
            return false;
        }
    },
}