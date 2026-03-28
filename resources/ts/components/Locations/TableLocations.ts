import { createDataTable } from "../DataTable/DataTable";
import { LocationController } from "../../Controllers/Locations/LocationController";
import { ShowModalEditLocation } from "./ModalEditLocation";
import { Toast } from "../Swal/swal";
import { openModal } from "../../utils/openModal";
import { closeModal } from "../../utils/CloseModal";

const LOCATION_COLUMNS: DataTables.ColumnSettings[] = [
    { data: "name", title: "NOME", className: "px-4 py-3 text-gray-800 text-sm" },
    { data: "address", title: "ENDERECO", className: "px-4 py-3 text-gray-800 text-sm" },
    { data: "city", title: "CIDADE", className: "px-4 py-3 text-gray-800 text-sm" },
    { data: "state", title: "ESTADO", className: "px-4 py-3 text-gray-800 text-sm" },
    { data: "cep", title: "CEP", className: "px-4 py-3 text-gray-800 text-sm" },
    {
        data: null,
        title: "ACOES",
        className: "px-4 py-3 text-gray-800 text-sm text-right",
        orderable: false,
        render(_data: any, _type: any, row: any) {
            return `
                <div class="flex items-center justify-end gap-2">
                    <button type="button"
                        class="btn-edit-location p-2 rounded-lg text-gray-500 hover:bg-gray-200 hover:scale-110 transition-all duration-200"
                        data-id="${row.id}">
                        <span class="material-symbols-outlined text-[20px]">edit</span>
                    </button>
                    <button type="button"
                        class="btn-delete-location p-2 rounded-lg text-red-500 hover:text-red-600 hover:bg-red-100 hover:scale-110 transition-all duration-200"
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

function getRowData(table: DataTables.Api, id: number): LocationData | undefined {
    const $row = $(table.table().body()).find(`[data-id="${id}"]`).closest("tr");
    return table.row($row).data() as LocationData | undefined;
}

export function showLocationsTable(
    $tableElement: JQuery<HTMLElement>,
    $search?: JQuery<HTMLElement>,
    $filterState?: JQuery<HTMLElement>,
    $filterCity?: JQuery<HTMLElement>,
    $btnFilter?: JQuery<HTMLElement>,
): DataTables.Api {
    const table = createDataTable($tableElement, {
        columns: LOCATION_COLUMNS,
        infoLabel: "locais",

        async fetchData(params) {
            const locations = await LocationController.getLocations();

            const searchValue = getFilterValue($search).toLowerCase();
            const stateValue = getFilterValue($filterState, "all").toLowerCase();
            const cityValue = getFilterValue($filterCity, "all").toLowerCase();

            const filtered = locations.filter((location) => {
                const matchesSearch = !searchValue
                    || location.name?.toLowerCase().includes(searchValue);

                const matchesState = stateValue === "all"
                    || String(location.state ?? "").toLowerCase() === stateValue;

                const matchesCity = cityValue === "all"
                    || String(location.city ?? "").toLowerCase() === cityValue;

                return matchesSearch && matchesState && matchesCity;
            });

            const paginated = filtered.slice(params.start, params.start + params.length);

            return {
                data: paginated,
                recordsTotal: locations.length,
                recordsFiltered: filtered.length,
            };
        },

        actions: [
            {
                selector: ".btn-edit-location",
                async handler(locationId, tbl) {
                    const row = getRowData(tbl, locationId);
                    if (!row) {
                        Toast.error("Local nao encontrado.");
                        return;
                    }

                    await ShowModalEditLocation(row, tbl);
                },
            },
            {
                selector: ".btn-delete-location",
                async handler(locationId, tbl) {
                    const $modal = $("#modal-delete-location");
                    const $inputId = $("#input-delete-location-id");
                    const $btnConfirm = $("#btn-modal-confirm-location-delete");
                    const $btnCancel = $("#btn-modal-cancel-location-delete");
                    const $btnClose = $("#btn-modal-close-location-delete");

                    $inputId.val(String(locationId));
                    openModal($modal);

                    $btnCancel.off("click").on("click", () => closeModal($modal));
                    $btnClose.off("click").on("click", () => closeModal($modal));

                    $btnConfirm.off("click").on("click", async (e) => {
                        e.preventDefault();
                        $btnConfirm.text("Excluindo...").prop("disabled", true);

                        try {
                            const result = await LocationController.deleteLocation(locationId);
                            if (result.success) {
                                Toast.success("Local excluido com sucesso.");
                                closeModal($modal);
                                tbl.draw(false);
                            } else {
                                Toast.error(result.message ?? "Nao foi possivel excluir o local.");
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
