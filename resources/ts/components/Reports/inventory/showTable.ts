import api from "../../../utils/api";
import { createDataTable } from "../../DataTable/DataTable";
import type { FetchParams, FetchResult } from "../../DataTable/DataTable";
import { formatPrice } from "../../../utils/FormatPrice";
import type { InventoryFilters, InventoryResponse, InventoryRow } from "../../../types/Reports/InventoryReport";

export function showTableInventory(
    $tableElement: JQuery<HTMLElement>,
    filters: InventoryFilters,
): DataTables.Api {

    return createDataTable($tableElement, {
        columns: [
            { data: "product_name",  title: "PRODUTO",      className: "px-4 py-3 text-gray-800 text-sm font-medium" },
            { data: "category_name", title: "CATEGORIA",    className: "px-4 py-3 text-gray-800 text-sm", render: (cellValue: string | null) => String(cellValue ?? "").trim() || "<span class='italic'>N/A</span>" },
            { data: "location_name", title: "LOCAL",        className: "px-4 py-3 text-gray-800 text-sm", render: (cellValue: string | null) => String(cellValue ?? "").trim() || "<span class='italic'>N/A</span>" },
            { data: "quantity",      title: "QUANTIDADE",   className: "px-4 py-3 text-gray-800 text-sm font-semibold" },
            { data: "price",         title: "PREÇO UNIT.",  className: "px-4 py-3 text-gray-800 text-sm", render: (cellValue: number | string | null) => formatPrice(cellValue ?? 0) },
            { data: "total_value",   title: "VALOR TOTAL",  className: "px-4 py-3 text-gray-800 text-sm font-semibold", render: (cellValue: number | string | null) => formatPrice(cellValue ?? 0) },
        ],
        fetchData: async (params: FetchParams): Promise<FetchResult<InventoryRow>> => {
            const response = await api.post("reports/inventory", {
                ...filters,
                start:  params.start,
                length: params.length,
            });
            const payload = response.data as InventoryResponse;
            const rows = Array.isArray(payload.data) ? payload.data : [];
            return {
                data:            rows,
                recordsTotal:    payload.recordsTotal    ?? rows.length,
                recordsFiltered: payload.recordsFiltered ?? rows.length,
            };
        },
    });
}
