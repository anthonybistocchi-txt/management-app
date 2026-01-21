import { ApiResponse } from "../../../../types/Utils/ApiResponse";
import { UserLoggedService } from "../../../../services/StockInService.ts/GetUserLogged";

export const getUserLogged = {

    async loadUserLogged($paragraph: JQuery<HTMLElement>[]) {
        try {
            const response: ApiResponse<UserLoggedData> = await UserLoggedService.getUserLogged();

            if (response.status && response.data) {
                console.log("Resposta do serviço:", response);
                const UserLogged = response.data.user;
                
                if (UserLogged.type_user_id === 1) {
                    $paragraph[1].text("Administrador");
                } else if (UserLogged.type_user_id === 2) {
                    $paragraph[1].text("Gestor");
                } else {
                    $paragraph[1].text("Usuário");
                }
                const user = `${UserLogged.username}`;

                $paragraph[0].text(user);
            
            } else {
                console.error("Erro ao buscar usuarios:", response.message);
            }
        } catch (error) {
            console.error("Erro fatal ao buscar usuarios:", error);
        }
    }
};