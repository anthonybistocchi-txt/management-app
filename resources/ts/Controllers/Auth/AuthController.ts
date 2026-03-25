import { LoginCredentials } from "../../types/Auth/LoginCredentials";
import { handleError } from "../../utils/ApiHandleError";
import { AuthService } from "../../services/Auth/AuthService";

interface LoginResult {
    success: boolean;
    redirectUrl: string;
}

export const AuthController = {
    async login(credentials: LoginCredentials): Promise<LoginResult> {
        try {
            const response = await AuthService.login(credentials);

            if (response?.status && response.redirect_url) {
                return {
                    success: true,
                    redirectUrl: response.redirect_url,
                };
            }

            return { success: false, redirectUrl: "/login" };
        } catch (error) {
            handleError(error);
            return { success: false, redirectUrl: "/login" };
        }
    },

    async logout(): Promise<boolean> {
        try {
            const response: boolean = await AuthService.logout();
            return !!response;
        } catch (error) {
            handleError(error);
            return false;
        }
    },
};
