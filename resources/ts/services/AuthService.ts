import api from "../utils/api";
import { LoginCredentials } from "../types/LoginCredentials";
import { Toast } from "../components/swal";

export const AuthService = {

    async login(credentials: LoginCredentials) {
        try {

            const response = await api.post('login', credentials);

            if (response.status === 200) return response.data;

        } catch (error: any) {
            if (error.response.status === 422) {
                Toast.error("Credenciais inválidas. Verifique seu usuário e senha.");
                return;
            }

            if (error.response.status === 404) {
                Toast.error("Serviço de autenticação não encontrado.");
                return;
            }

            if (error.response.status === 422) {
                Toast.error("Credenciais inválidas. Verifique seu usuário e senha.");
                return;
            }
            
            if (error.response.status === 419) {
                Toast.error("Sessão expirada. Atualize a página e tente novamente.");
                return;
            }
            if(error.response.status === 500) {
                Toast.info("Erro interno do servidor. Tente novamente mais tarde.");
                return;
            }
        }
    },

    async logout() {
        try {
            const response = await api.post('logout');
            if (response.status === 200) {
                Toast.success("Logout realizado com sucesso.");
                return true;
            }
        } catch (error: any) {
            if (error.response.status === 500) {
                Toast.info("Erro interno do servidor. Tente novamente mais tarde.");
            }
            return false;
        }
    }
};