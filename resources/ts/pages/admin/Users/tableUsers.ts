import { Toast } from "../../../components/Swal/swal";
import { ShowModalEditUser } from "../../../components/User/ModalEditUser";
import { UserController } from "../../../Controllers/User/UserController";
// import 'datatables.net-responsive-dt';

const USER_ROLES: Record<number, string> = {
    1: "Administrador",
    2: "Gestor",
    3: "Operador",
};

export async function showUsersTable(
    $tableElement:       JQuery<HTMLElement>,
    search?:             JQuery<HTMLElement>,
    $inputOperatorType?: JQuery<HTMLElement>,
    $inputStatusUser?:   JQuery<HTMLElement>,
    $btnFilter?:         JQuery<HTMLElement>,
): Promise<void> {
    const table = $tableElement.DataTable({
        destroy:    true,
        serverSide: true, // Habilita o processamento no servidor
        processing: false, // Mostra o indicador de carregamento
        autoWidth:  true,
        pagingType: "simple_numbers",

        ajax: async (data: any, callback: any) => {
            const start         = data.start; // Registro inicial
            const length        = data.length; // Quantidade por página
            const searchValue   = search ? (search.val() as string).trim() : "";

            const operator_type = $inputOperatorType
                ? ($inputOperatorType.val() as string).trim()
                : "all";

            const active = $inputStatusUser
                ? ($inputStatusUser.val() as string).trim()
                : "all";

            try {
                const responseData = await UserController.getAllUsers(
                    start,
                    length,
                    searchValue,
                    operator_type,
                    active,
                );

                callback({
                    draw:            data.draw,
                    recordsTotal:    responseData.recordsTotal ?? 0,    // Mudado de recordsTotal para total
                    recordsFiltered: responseData.recordsFiltered ?? 0,    // Mudado de recordsFiltered para total
                    data:            responseData.users ?? [],   // Mantido users
                });

            } catch (error) {
                Toast.error("Erro ao carregar usuários.");
                callback({ data: [] });
            }
        },
        createdRow: function (row, data, dataIndex) {
            if (dataIndex % 2 === 0) {
                $(row).addClass("bg-gray-100");
            }
        },
        dom: '<"flex items-center justify-between mb-4"l>rt<"flex items-center justify-between mt-4"ip>',
        language: {
            lengthMenu: "_MENU_",
            search:     "Buscar:",
            processing:  "",
            info:       "Exibindo _START_ a _END_ de _TOTAL_ usuários",
            infoEmpty:  "Nenhum resultado encontrado",
            zeroRecords:"Nenhum resultado encontrado",
        },

        columns: [
            {
                data: "name",
                title: "NOME",
                className: "px-4 py-3 text-gray-800 text-sm",
            },
            {
                data: "username",
                title: "USERNAME",
                className: "px-4 py-3 text-gray-800 text-sm",
            },
            {
                data: "email",
                title: "EMAIL",
                className: "px-4 py-3 text-gray-800 text-sm",
            },
            {
                data: "cpf",
                title: "CPF",
                className: "px-4 py-3 text-gray-800 text-sm",
            },
            {
                data: "type_user_id",
                title: "TIPO",
                className: "px-4 py-3 text-gray-800 text-sm",
                render: (data) => USER_ROLES[data] || "Desconhecido",
            },
            {
                data: "active",
                title: "STATUS",
                className: "px-4 py-3 text-gray-800 text-sm",
                render: function (data) {
                    const isActive = data === 1;
                    const text = isActive ? "Ativo" : "Inativo";
                    const css = isActive
                        ? "bg-emerald-50 text-emerald-700 border border-emerald-100"
                        : "bg-red-50 text-red-700 border border-red-100";
                    return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold ${css}">${text}</span>`;
                },
            },
            {
                data: null,
                title: "AÇÕES",
                className: "px-4 py-3 text-right text-gray-800 text-sm",
                orderable: false,
                render: (data, type, row) => `
                    <div class="flex items-center justify-end gap-2">
                        <button id="btn-edit-user" class="p-2 rounded-lg text-gray-500 hover:bg-gray-200 hover:scale-110 transition-all duration-200" data-id="${row.id}">
                            <span class="material-symbols-outlined text-[20px]">edit</span>
                        </button>
                        <button id="btn-delete-user" class="p-2 rounded-lg text-red-500 hover:text-red-600 hover:bg-red-100 hover:scale-110 transition-all duration-200" data-id="${row.id}">
                            <span class="material-symbols-outlined text-[20px]">delete</span>
                        </button>
                    </div>`,
            },
        ],

        drawCallback: function () {
            const $labelRegisters  = $("#table-users_info");
            
            $labelRegisters.addClass("text-gray-800 text-sm pl-2 pb-1");
           
        },

    });

    $tableElement.on("click", "#btn-edit-user", async function (e) {
        e.preventDefault();

        const userId = $(this).data("id");

        if (!userId) return false;

        await ShowModalEditUser([userId], table); 
    });

    $btnFilter?.on("click", (e) => {
        e.preventDefault();
        table.draw(); // Recarrega a tabela mantendo a página 1 (filtro novo)
    });

    // Se você tiver um botão de "Filtrar" ou o input de busca for externo:
    // search?.on("keyup", () => table.draw());
    // $inputOperatorType?.on("change", () => table.draw());
    // $inputStatusUser?.on("change", () => table.draw());
}
