import { CreateUserService } from "../../services/User/CreateUserService";
import { DeleteUserService } from "../../services/User/DeleteUserService";
import { UserEditService } from "../../services/User/EditUserService";
import { GetUserByIdService } from "../../services/User/GetUserByIdService";
import { UserLoggedService } from "../../services/User/GetUserLoggedService";
import { GetUserService } from "../../services/User/GetUsersService";
import { ApiResponse } from "../../types/ApiResponse";
import { UserData, UserListResponse, UserLoggedData } from "../../types/User/User";

export const UserController = {
    async createUser(
        name: string,
        username: string,
        email: string,
        type_user_id: number,
        password: string,
        cpf: string
    ): Promise<{ success: boolean; message?: string }> {
        const result = await CreateUserService.createUser(
            name,
            username,
            email,
            type_user_id,
            password,
            cpf
        );

        if (result.ok) {
            return { success: true };
        }

        return { success: false, message: result.message };
    },

    async getUserLogged(): Promise<UserLoggedData> {
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

    async getAllUsers(
        start: number,
        length: number,
        search?: string,
        operator_type?: number | string,
        active?: string
    ): Promise<UserListResponse> {
        try {
            const response = await GetUserService.getAllUsers(start, length, search, operator_type, active);

            if (response && response.status && response.data && Array.isArray(response.data.users)) {
                return response.data;
            }

            console.error("Dados inválidos recebidos da API");
            return { recordsFiltered: 0, recordsTotal: 0, users: [] };
        } catch (error) {
            console.error("Erro fatal:", error);
            return { recordsFiltered: 0, recordsTotal: 0, users: [] };
        }
    },

    async getUserById(userId: number): Promise<ApiResponse<UserData>> {
        try {
            const response = await GetUserByIdService.getUserById(userId);
            return response;
        } catch (error) {
            console.error("Erro ao obter usuário por ID:", error);
            throw error;
        }
    },

    async editUser(
        id: number,
        name: string,
        email: string,
        username: string,
        password: string,
        type_user_id: number,
        cpf: string
    ): Promise<{ success: boolean; message?: string }> {
        const result = await UserEditService.editUser(
            id,
            name,
            email,
            username,
            password,
            type_user_id,
            cpf
        );

        if (result.ok) {
            return { success: true };
        }

        return { success: false, message: result.message };
    },

    async deleteUser(id: number): Promise<{ success: boolean; message?: string }> {
        const result = await DeleteUserService.deleteUser(id);

        if (result.ok) {
            return { success: true };
        }

        return { success: false, message: result.message };
    },
};
