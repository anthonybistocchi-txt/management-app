import api from "../Utils/api";
import { AxiosError } from "axios";
import { LoginCredentials } from "../types/Auth/LoginCredentials";
import { Toast } from "../components/swal";

const handleError = (error: unknown): string => {
    if (error instanceof AxiosError) {
        const status = error.response?.status;

        const messages: Record<number, string> = {
            422: "Credenciais inválidas. Verifique seu usuário e senha.",
            404: "Serviço de autenticação não encontrado.",
            419: "Sessão expirada. Atualize a página e tente novamente.",
            500: "Erro interno do servidor. Tente novamente mais tarde.",
        };

        return messages[status ?? 0] || "Ocorreu um erro inesperado.";
    }

    return "Erro inesperado.";
};

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
