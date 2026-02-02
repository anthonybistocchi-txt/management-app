import { ApiResponse } from "../../types/ApiResponse";
import { EditUser } from "../../types/User/User";
import api from "../../utils/api";

export const UserEditService = { 

    async editUser(
        name:          string,
        email:         string,
        username:      string,
        password:      string,
        type_user_id:  number,
    ): Promise<ApiResponse<EditUser | void>>
        {
            try {
                const { data } = await api.put("users/edit", { name, email, username, password, type_user_id });

                return data;
            } catch (error) {
                console.error("Erro ao editar usuário:", error);
                throw error;
            }
        }
};