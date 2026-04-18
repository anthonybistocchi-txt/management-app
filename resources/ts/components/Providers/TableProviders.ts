import { createDataTable } from "../DataTable/DataTable";
import { ProviderController } from "../../Controllers/Providers/ProviderController";
import { ShowModalEditProvider } from "./ModalEditProvider";
import { Toast } from "../Swal/swal";
import { attachDeleteConfirmation } from "../shared/modals/attachDeleteConfirmation";
import { buildCrudActionButtonsHtml } from "../shared/tables/buildCrudActionButtonsHtml";
import { getTableRowData } from "../shared/tables/getTableRowData";

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
        render(_cellData: string | null, _displayType: string, row: ProviderData) {
            return buildCrudActionButtonsHtml("provider", row.id);
        },
    },
];

function getFilterValue($el?: JQuery<HTMLElement>, fallback = ""): string {
    return $el ? String($el.val() ?? "").trim() : fallback;
}

function getRowData(table: DataTables.Api, id: number): ProviderData | undefined { // @ts-ignore
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
                    const row = getTableRowData<ProviderData>(tbl, providerId);
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

                    attachDeleteConfirmation({
                        modal: $modal,
                        confirmButton: $btnConfirm,
                        cancelButton: $btnCancel,
                        closeButton: $btnClose,
                        itemIdInput: $inputId,
                        entityLabel: "Fornecedor",
                        failureMessage: "Nao foi possivel excluir o fornecedor.",
                        onConfirm: async () => ProviderController.deleteProvider(providerId), // @ts-ignore
                        onSuccess: () => tbl.draw(false),
                    });
                },
            },
        ],
    });

    $btnFilter?.on("click", (event) => {
        event.preventDefault();
        table.draw();
    });

    return table;
}
