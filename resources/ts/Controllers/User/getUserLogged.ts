import { ApiResponse } from "../../types/Utils/ApiResponse";
import { UserLoggedService } from "../../services/User/GetUserLogged"; 

export const getUserLoggedController = {

   async loadUserLogged($nameElement: JQuery<HTMLElement>, $roleElement: JQuery<HTMLElement>): Promise<void> {
        try {
            const response: ApiResponse<UserLoggedData> = await UserLoggedService.UserLogged();

            if (response.status && response.data) {
                const UserLogged = response.data;
             
                const roleMap: Record<number, string> = {
                    1: "Administrador",
                    2: "Gestor",
                };

                const type_user_id = roleMap[UserLogged.type_user_id] || "Usuário";

                $nameElement.text(UserLogged.username);
                $roleElement.text(type_user_id);
                
                return;
            
            } else {
                console.error("Erro ao buscar usuarios:", response.message);
            }
        } catch (error) {
            console.error("Erro fatal ao buscar usuarios:", error);
        }
    }
};