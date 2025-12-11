import api from "../utils/api";
import { LoginCredentials } from "../types/LoginCredentials";
import { Toast } from "../components/swal";

const handleError = (error: any) => {
    const status = error?.response?.status;

    const messages: Record<number, string> = {
        422: "Credenciais inválidas. Verifique seu usuário e senha.",
        404: "Serviço de autenticação não encontrado.",
        419: "Sessão expirada. Atualize a página e tente novamente.",
        500: "Erro interno do servidor. Tente novamente mais tarde.",
    };

    if (messages[status]) {
        Toast.error(messages[status]);
    } else {
        Toast.error("Ocorreu um erro inesperado.");
    }
};

export const AuthService = {
    async login(credentials: LoginCredentials) {
        try {
            const response = await api.post("login", credentials);
            if (response.status === 200) return response.data;
        } catch (error: any) {
            Toast.error("Falha na autenticação. Verifique suas credenciais e tente novamente." + handleError(error));
            throw error;
        }
    },

    async logout() {
        try {
            const response = await api.post("logout");
            if (response.status === 200) {
                Toast.success("Logout realizado com sucesso.");
                return true;
            }
        } catch (error: any) {
            handleError(error);
            return false;
        }
    },
};
