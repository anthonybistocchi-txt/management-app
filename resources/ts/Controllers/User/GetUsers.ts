
// import { GetUserService } from "../../services/User/GetUsers";
// import { GetUserData } from "../../types/User/GetUser";
// import { ApiResponse } from "../../types/Utils/ApiResponse";

// export const GetUserController = {
//     async getUser(username?: string, row: HTMLElement): Promise<void> {
//         try {
//             const response: ApiResponse<GetUserData> = await GetUserService.getUser(username);
            
//             if (response.status && response.data) {
//                 const user = response.data;

//                 user.forEach(row => {
//                     const tr = document.createElement("tr");
//                     tr.innerHTML = `
//                         <td>${row.id}</td>
//                         <td>${row.name}</td>
//                         <td>${row.email}</td>
//                         <td>${row.username}</td>
//                         <td>${row.cpf}</td>
//                     `;
//                     row.appendChild(tr);
//                 });

//             }

//         } catch (error) {
//             console.error("Fluxo interrompido:", error);
//         };
//     }
// }