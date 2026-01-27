import { CreateUserService } from "../../services/User/CreateUser";
import { UserLoggedService } from "../../services/User/GetUserLogged";
import { GetUserService } from "../../services/User/GetUsers";
import { ApiResponse } from "../../types/ApiResponse";
import {  UserListResponse, UserLoggedData } from "../../types/User/User";

export const UserController = {
    async createUser(
        name: string,
        username: string, 
        email: string, 
        type_user_id: number, 
        password: string, 
        cpf: string
    ): Promise<boolean> {

        try {
            const response = await CreateUserService.createUser(name, username, email, type_user_id, password, cpf);

            if (response && response.status) return true;

            return false;

        } catch (error) {
            console.error("Erro ao criar usuário:", error);
            return false;
        }
    },
    
    async getUserLogged(): Promise<UserLoggedData> 
    {
        try {
            const response: ApiResponse<UserLoggedData> = await UserLoggedService.getUserLogged();
            
            if (response.status && response.data) return response.data;

            console.error("Resposta inválida ao obter usuário logado.");
            throw new Error("Não foi possível obter os dados do usuário logado.");

        } catch (error) {
            console.error("Erro ao carregar usuário logado:", error);
            throw error;
        }
    },

    async getAllUsers(): Promise<UserListResponse | null> {
        try {
            const response = await GetUserService.getAllUsers();
            
            if (response && response.status && response.data && Array.isArray(response.data.users)) {
                
                return response.data; 
            }
            
            console.error("Dados inválidos recebidos da API");
            return null;

        } catch (error) {
            console.error("Erro fatal:", error);
            return null;
        }
    }
};