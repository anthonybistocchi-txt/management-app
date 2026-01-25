import { GetUserService } from "../../services/User/GetUsers";
import { GetUsersData } from "../../types/User/GetUser";


export const GetUserController = {
    async getUsers(): Promise<GetUsersData[]> { 
        try {
            const response = await GetUserService.getAllUsers();
            
            if (response.status && response.data) {
    
                const users = response.data; 

                console.log("Usuários carregados:", users);
                
                return users || []; 
            } else {
                console.error("Falha ao carregar usuários: Resposta vazia");
                return []; // Retorna array vazio para não quebrar o forEach
            }

        } catch (error) {
            console.error("Fluxo interrompido:", error);
            return []; // Retorna array vazio em caso de erro
        };
    }
}