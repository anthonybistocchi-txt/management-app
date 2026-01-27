import { Toast } from "../../../components/Swal/swal";
import { UserController } from "../../../Controllers/User/UserController";
import 'datatables.net-dt';
import { UserData } from "../../../types/User/User";

export async function showUsersTable($tableElement: JQuery<HTMLElement>): Promise<void> {

    const users:UserData[] = await UserController.getAllUsers();
    console.log(users);
    if (!users) Toast.error("Erro ao carregar usuários.");
    
    let type_user_id: string;

    users.forEach(user => {
        switch (user.type_user_id) {
            case 1:
                user.type_user_id = 1;
                type_user_id = 'Administrador';
                break;
            case 2:
                user.type_user_id = 2;
                type_user_id = 'Gestor';
                break;
            default:
                user.type_user_id = 3;
                type_user_id = 'Usuário';
        }
    });

    $tableElement.DataTable({
        data: users, // O array que veio do Controller
        destroy: true, // Permite recarregar a tabela sem erro
        // responsive: true,
        autoWidth: false,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
            // Personalizando textos para ficarem mais curtos se quiser
            paginate: { previous: 'Anterior', next: 'Próximo' }
        },
        columns: [
            { 
                data: 'name',
                className: 'px-6 py-4 font-medium text-[#0d141b] dark:text-white whitespace-nowrap'
            },
            { data: 'username', className: 'px-6 py-4' },
            { data: 'email', className: 'px-6 py-4' },
            { data: 'cpf', className: 'px-6 py-4' },
            { 
                data: 'type_user_id',
                className: 'px-6 py-4',
                render: function() {
                    return  type_user_id || 'Desconhecido';
                }
            },
            { 
                data: 'active',
                className: 'px-6 py-4',
                render: function(data) {
                    const isActive = data === 1;
                    const text = isActive ? 'Ativo' : 'Inativo';
                    const css = isActive 
                        ? 'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300' 
                        : 'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300';
                    
                    return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${css}">${text}</span>`;
                }
            },
            {
                data: null, // Coluna sem dados diretos (Botões)
                className: 'px-6 py-4 text-right',
                orderable: false, // Não ordenar por botões
                render: function(data, type, row) {
                    // 'row' contém o objeto do usuário inteiro
                    return `
                        <div class="flex gap-2 justify-end">
                            <button class="btn-table-edit text-[#4c739a] hover:text-primary transition-colors"
                                    data-id="${row.id}" title="Editar">
                                <span class="material-symbols-outlined text-xl">edit</span>
                            </button>
                            <button class="btn-table-delete text-[#4c739a] hover:text-red-600 transition-colors"
                                    data-id="${row.id}" title="Excluir">
                                <span class="material-symbols-outlined text-xl">delete</span>
                            </button>
                        </div>
                    `;
                }
            }
        ],
        // Essa função aplica as classes na TR (linha) inteira
        createdRow: function(row, data, dataIndex) {
            $(row).addClass('hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors border-b border-slate-100 dark:border-slate-700');
        },
        // Personaliza onde aparece a busca/paginação (Opcional, layout padrão do DT)
        dom: '<"p-4 flex justify-between items-center"lf>rt<"p-4 flex justify-between items-center border-t border-slate-200 dark:border-slate-800"ip>'
    });
}