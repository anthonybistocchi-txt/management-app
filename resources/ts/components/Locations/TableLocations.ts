import { createDataTable } from "../DataTable/DataTable";
import { LocationController } from "../../Controllers/Locations/LocationController";
import { ShowModalEditLocation } from "./ModalEditLocation";
import { Toast } from "../Swal/swal";
import { attachDeleteConfirmation } from "../shared/modals/attachDeleteConfirmation";
import { buildCrudActionButtonsHtml } from "../shared/tables/buildCrudActionButtonsHtml";
import { getTableRowData } from "../shared/tables/getTableRowData";

const LOCATION_COLUMNS: DataTables.ColumnSettings[] = [
    { data: "name",    title: "NOME",     className: "px-4 py-3 text-gray-800 text-sm" },
    { data: "address", title: "ENDERECO", className: "px-4 py-3 text-gray-800 text-sm" },
    { data: "city",    title: "CIDADE",   className: "px-4 py-3 text-gray-800 text-sm" },
    { data: "state",   title: "ESTADO",   className: "px-4 py-3 text-gray-800 text-sm" },
    { data: "cep",     title: "CEP",      className: "px-4 py-3 text-gray-800 text-sm" },
    {
        data: null,
        title: "ACOES",
        className: "px-4 py-3 text-gray-800 text-sm text-right",
        orderable: false,
        render(_cellData: string | null, _displayType: string, row: LocationData) {
            return buildCrudActionButtonsHtml("location", row.id);
        },
    },
];

function getFilterValue($el?: JQuery<HTMLElement>, fallback = ""): string {
    return $el ? String($el.val() ?? "").trim() : fallback;
}

function getRowData(table: DataTables.Api, id: number): LocationData | undefined { // @ts-ignore
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
            const stateValue  = getFilterValue($filterState, "all").toLowerCase();
            const cityValue   = getFilterValue($filterCity, "all").toLowerCase();

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
                    const row = getTableRowData<LocationData>(tbl, locationId);
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
                    const $modal      = $("#modal-delete-location");
                    const $inputId    = $("#input-delete-location-id");
                    const $btnConfirm = $("#btn-modal-confirm-location-delete");
                    const $btnCancel  = $("#btn-modal-cancel-location-delete");
                    const $btnClose   = $("#btn-modal-close-location-delete");

                    $inputId.val(String(locationId));

                    attachDeleteConfirmation({
                        modal: $modal,
                        confirmButton: $btnConfirm,
                        cancelButton:  $btnCancel,
                        closeButton:   $btnClose,
                        itemIdInput:   $inputId,
                        entityLabel:    "Local",
                        failureMessage: "Nao foi possivel excluir o local.",
                        onConfirm: async () => LocationController.deleteLocation(locationId), // @ts-ignore
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
