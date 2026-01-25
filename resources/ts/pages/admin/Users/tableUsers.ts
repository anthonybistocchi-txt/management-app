import { GetUserController } from "../../../Controllers/User/GetUsers";

export async function loadTableUsers($tableUsers: JQuery<HTMLElement>) 
    {
        const listUser = await GetUserController.getUsers();

        $tableUsers.empty();

        listUser.forEach((user) => {

            const isActive      = user.active === 1;
            const statusText    = isActive ? 'Ativo' : 'Inativo';
            const statusClasses = isActive 
                ? 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300' 
                : 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300';

            let type_user_name = '';

            switch (user.type_user_id) 
            {
                case 1:
                    type_user_name = 'Administrador';
                    break;
                case 2:
                    type_user_name = 'Gestor';
                    break;
                case 3:
                    type_user_name = 'Operador';
                    break;
            }

            const tr = `
                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors border-b border-slate-100 dark:border-slate-700">
                    <td class="user-name px-6 py-4 font-medium text-[#0d141b] dark:text-white whitespace-nowrap">
                        ${user.name}
                    </td>
                    
                    <td class="user-username px-6 py-4">
                        ${user.username}
                    </td>
                    
                    <td class="user-email px-6 py-4">
                        ${user.email}
                    </td>
                    
                    <td class="user-cpf px-6 py-4">
                        ${user.cpf}
                    </td>
                    
                    <td class="user-role px-6 py-4">
                        ${type_user_name}
                    </td>
                    
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${statusClasses}">
                            ${statusText}
                        </span>
                    </td>
                    
                    <td class="px-6 py-4 text-right">
                        <div class="flex gap-2 justify-end">
                            <button 
                                class="btn-table-edit text-[#4c739a] hover:text-primary transition-colors"
                                data-id="${user.id || user.cpf}" 
                                title="Editar">
                                <span class="material-symbols-outlined text-xl">edit</span>
                            </button>
                            
                            <button 
                                class="btn-table-delete text-[#4c739a] hover:text-red-600 transition-colors"
                                data-id="${user.id || user.cpf}" 
                                title="Excluir">
                                <span class="material-symbols-outlined text-xl">delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            `;

            $tableUsers.append(tr);
        });
    }