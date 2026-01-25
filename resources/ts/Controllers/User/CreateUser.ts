import { CreateUserService } from "../../services/User/CreateUser";

export const CreateUserController = {
    async createUser(name: string, username: string, email: string, type_user_id: number, password: string, cpf: string): Promise<boolean> {
        try {
            const response = await CreateUserService.createUser(name, username, email, type_user_id, password, cpf);
            
            if (response && response.status) return true;

            return false;
            
        } catch (error) {
            console.error("Erro ao criar usuário:", error);
            return false;
        }
    }
};