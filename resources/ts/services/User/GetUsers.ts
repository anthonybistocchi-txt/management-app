// import { GetUserData } from "../../types/User/GetUser";
// import { ApiResponse } from "../../types/Utils/ApiResponse";
// import api from "../../utils/api";
// import { AxiosError } from "axios";

// export const GetUserService = {
//     async getUser(username?: string): Promise<ApiResponse<GetUserData> | void> {
//         try {
//             const { data } = await api.post("users/getUser", { params: { username: username ?? null } });
//             return data;
//         } catch (error) {
//             const message =
//                 error instanceof AxiosError
//                     ? error.response?.data?.message ?? "Erro ao carregar usuários."
//                     : "Erro inesperado.";

//             console.error(message);
//         }
//     },
// };
