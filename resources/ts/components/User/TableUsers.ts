import Swal from "sweetalert2";

import { createDataTable } from "../DataTable/DataTable";
import { Toast } from "../Swal/swal";
import { ShowModalEditUser } from "./ModalEditUser";
import { UserController } from "../../Controllers/User/UserController";

const USER_ROLES: Record<number, string> = {
    1: "Administrador",
    2: "Gestor",
    3: "Operador",
};

/* ------------------------------------------------------------------ */
/*  Colunas da tabela de usuários                                     */
/* ------------------------------------------------------------------ */

const USER_COLUMNS: DataTables.ColumnSettings[] = [
    { data: "name",     title: "NOME",     className: "px-4 py-3 text-gray-800 text-sm" },
    { data: "username", title: "USERNAME",  className: "px-4 py-3 text-gray-800 text-sm" },
    { data: "email",    title: "EMAIL",     className: "px-4 py-3 text-gray-800 text-sm" },
    { data: "cpf",      title: "CPF",       className: "px-4 py-3 text-gray-800 text-sm" },
    {
        data: "type_user_id",
        title: "TIPO",
        className: "px-4 py-3 text-gray-800 text-sm",
        render: (typeId: number) => USER_ROLES[typeId] || "Desconhecido",
    },
    {
        data: "active",
        title: "STATUS",
        className: "px-4 py-3 text-gray-800 text-sm",
        render(value: number) {
            const isActive = value === 1;
            const label = isActive ? "Ativo" : "Inativo";
            const css   = isActive
                ? "bg-emerald-50 text-emerald-700 border border-emerald-100"
                : "bg-red-50 text-red-700 border border-red-100";

            return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold ${css}">${label}</span>`;
        },
    },
    {
        data: null,
        title: "AÇÕES",
        className: `${"px-4 py-3 text-gray-800 text-sm"} text-right`,
        orderable: false,
        render(_data: any, _type: any, row: any) {
            return `
                <div class="flex items-center justify-end gap-2">
                    <button type="button"
                        class="btn-edit-user p-2 rounded-lg text-gray-500 hover:bg-gray-200 hover:scale-110 transition-all duration-200"
                        data-id="${row.id}">
                        <span class="material-symbols-outlined text-[20px]">edit</span>
                    </button>
                    <button type="button"
                        class="btn-delete-user p-2 rounded-lg text-red-500 hover:text-red-600 hover:bg-red-100 hover:scale-110 transition-all duration-200"
                        data-id="${row.id}">
                        <span class="material-symbols-outlined text-[20px]">delete</span>
                    </button>
                </div>`;
        },
    },
];

/* ------------------------------------------------------------------ */
/*  Função pública — monta a tabela de usuários                       */
/* ------------------------------------------------------------------ */

function getFilterValue($el?: JQuery<HTMLElement>, fallback = ""): string {
    return $el ? ($el.val() as string).trim() : fallback;
}

export function showUsersTable(
    $tableElement:       JQuery<HTMLElement>,
    $search?:            JQuery<HTMLElement>,
    $inputOperatorType?: JQuery<HTMLElement>,
    $inputStatusUser?:   JQuery<HTMLElement>,
    $btnFilter?:         JQuery<HTMLElement>,
): DataTables.Api {

    const table = createDataTable($tableElement, {
        columns:   USER_COLUMNS,
        infoLabel: "usuários",

        async fetchData(params) {
            const response = await UserController.getAllUsers(
                params.start,
                params.length,
                getFilterValue($search),
                getFilterValue($inputOperatorType, "all"),
                getFilterValue($inputStatusUser,   "all"),
            );

            return {
                data:            response.users          ?? [],
                recordsTotal:    response.recordsTotal    ?? 0,
                recordsFiltered: response.recordsFiltered ?? 0,
            };
        },

        actions: [
            {
                selector: ".btn-edit-user",
                async handler(userId, tbl) {
                    await ShowModalEditUser(userId, tbl);
                },
            },
            {
                selector: ".btn-delete-user",
                async handler(userId, tbl) {
                    const confirmation = await Swal.fire({
                        title:             "Excluir usuário?",
                        text:              "O usuário será inativado e removido da listagem ativa.",
                        icon:              "warning",
                        showCancelButton:  true,
                        confirmButtonText: "Excluir",
                        cancelButtonText:  "Cancelar",
                        reverseButtons:    true,
                        focusCancel:       true,
                    });

                    if (!confirmation.isConfirmed) return;

                    const result = await UserController.deleteUser(userId);

                    if (result.success) {
                        Toast.success("Usuário excluído com sucesso.");
                        tbl.draw(false);
                    } else {
                        Toast.error(result.message ?? "Não foi possível excluir o usuário.");
                    }
                },
            },
        ],
    });

    $btnFilter?.on("click", (e) => {
        e.preventDefault();
        table.draw();
    });

    return table;
}
