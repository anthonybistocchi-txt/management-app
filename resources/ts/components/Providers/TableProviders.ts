import { createDataTable } from "../DataTable/DataTable";
import { ProviderController } from "../../Controllers/Providers/ProviderController";
import { ShowModalEditProvider } from "./ModalEditProvider";
import { Toast } from "../Swal/swal";
import { openModal } from "../../utils/openModal";
import { closeModal } from "../../utils/CloseModal";

const PROVIDER_COLUMNS: DataTables.ColumnSettings[] = [
    { data: "name", title: "NOME", className: "px-4 py-3 text-gray-800 text-sm" },
    { data: "cnpj", title: "CNPJ", className: "px-4 py-3 text-gray-800 text-sm" },
    { data: "phone", title: "TELEFONE", className: "px-4 py-3 text-gray-800 text-sm" },
    { data: "email", title: "EMAIL", className: "px-4 py-3 text-gray-800 text-sm" },
    { data: "city", title: "CIDADE", className: "px-4 py-3 text-gray-800 text-sm" },
    { data: "state", title: "ESTADO", className: "px-4 py-3 text-gray-800 text-sm" },
    {
        data: "active",
        title: "STATUS",
        className: "px-4 py-3 text-gray-800 text-sm",
        render(value: number | null) {
            if (value === null || value === undefined) return "-";
            const isActive = value === 1;
            const label = isActive ? "Ativo" : "Inativo";
            const css = isActive
                ? "bg-emerald-50 text-emerald-700 border border-emerald-100"
                : "bg-red-50 text-red-700 border border-red-100";

            return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold ${css}">${label}</span>`;
        },
    },
    {
        data: null,
        title: "ACOES",
        className: "px-4 py-3 text-gray-800 text-sm text-right",
        orderable: false,
        render(_data: any, _type: any, row: any) {
            return `
                <div class="flex items-center justify-end gap-2">
                    <button type="button"
                        class="btn-edit-provider p-2 rounded-lg text-gray-500 hover:bg-gray-200 hover:scale-110 transition-all duration-200"
                        data-id="${row.id}">
                        <span class="material-symbols-outlined text-[20px]">edit</span>
                    </button>
                    <button type="button"
                        class="btn-delete-provider p-2 rounded-lg text-red-500 hover:text-red-600 hover:bg-red-100 hover:scale-110 transition-all duration-200"
                        data-id="${row.id}">
                        <span class="material-symbols-outlined text-[20px]">delete</span>
                    </button>
                </div>`;
        },
    },
];

function getFilterValue($el?: JQuery<HTMLElement>, fallback = ""): string {
    return $el ? String($el.val() ?? "").trim() : fallback;
}

function getRowData(table: DataTables.Api, id: number): ProviderData | undefined {
    const $row = $(table.table().body()).find(`[data-id="${id}"]`).closest("tr");
    return table.row($row).data() as ProviderData | undefined;
}

export function showProvidersTable(
    $tableElement: JQuery<HTMLElement>,
    $search?: JQuery<HTMLElement>,
    $filterState?: JQuery<HTMLElement>,
    $filterCity?: JQuery<HTMLElement>,
    $btnFilter?: JQuery<HTMLElement>,
): DataTables.Api {
    const table = createDataTable($tableElement, {
        columns: PROVIDER_COLUMNS,
        infoLabel: "fornecedores",

        async fetchData(params) {
            const providers = await ProviderController.getProviders();

            const searchValue = getFilterValue($search).toLowerCase();
            const stateValue = getFilterValue($filterState, "all").toLowerCase();
            const cityValue = getFilterValue($filterCity, "all").toLowerCase();

            const filtered = providers.filter((provider) => {
                const matchesSearch = !searchValue
                    || provider.name?.toLowerCase().includes(searchValue);

                const matchesState = stateValue === "all"
                    || String(provider.state ?? "").toLowerCase() === stateValue;

                const matchesCity = cityValue === "all"
                    || String(provider.city ?? "").toLowerCase() === cityValue;

                return matchesSearch && matchesState && matchesCity;
            });

            const paginated = filtered.slice(params.start, params.start + params.length);

            return {
                data: paginated,
                recordsTotal: providers.length,
                recordsFiltered: filtered.length,
            };
        },

        actions: [
            {
                selector: ".btn-edit-provider",
                async handler(providerId, tbl) {
                    const row = getRowData(tbl, providerId);
                    if (!row) {
                        Toast.error("Fornecedor nao encontrado.");
                        return;
                    }

                    await ShowModalEditProvider(row, tbl);
                },
            },
            {
                selector: ".btn-delete-provider",
                async handler(providerId, tbl) {
                    const $modal = $("#modal-delete-provider");
                    const $inputId = $("#input-delete-provider-id");
                    const $btnConfirm = $("#btn-modal-confirm-provider-delete");
                    const $btnCancel = $("#btn-modal-cancel-provider-delete");
                    const $btnClose = $("#btn-modal-close-provider-delete");

                    $inputId.val(String(providerId));
                    openModal($modal);

                    $btnCancel.off("click").on("click", () => closeModal($modal));
                    $btnClose.off("click").on("click", () => closeModal($modal));

                    $btnConfirm.off("click").on("click", async (e) => {
                        e.preventDefault();
                        $btnConfirm.text("Excluindo...").prop("disabled", true);

                        try {
                            const result = await ProviderController.deleteProvider(providerId);
                            if (result.success) {
                                Toast.success("Fornecedor excluido com sucesso.");
                                closeModal($modal);
                                tbl.draw(false);
                            } else {
                                Toast.error(result.message ?? "Nao foi possivel excluir o fornecedor.");
                            }
                        } finally {
                            $btnConfirm.text("Excluir").prop("disabled", false);
                        }
                    });
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
