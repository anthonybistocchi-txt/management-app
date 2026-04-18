import api from "../../../utils/api";
import { createDataTable } from "../../DataTable/DataTable";
import type { FetchParams, FetchResult } from "../../DataTable/DataTable";
import type { StockTurnoverFilters, StockTurnoverResponse, StockTurnoverRow } from "../../../types/Reports/StockTurnoverReport";

export function showTableStockTurnover(
    $tableElement: JQuery<HTMLElement>,
    filters: StockTurnoverFilters,
): DataTables.Api {

    const buildTurnoverBadge = (turnoverValue: number): string => {
        if (turnoverValue >= 2)  return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">${turnoverValue}</span>`;
        if (turnoverValue >= 1)  return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100">${turnoverValue}</span>`;
        return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-red-50 text-red-700 border border-red-100">${turnoverValue}</span>`;
    };

    return createDataTable($tableElement, {
        columns: [
            { data: "product_name",  title: "PRODUTO",    className: "px-4 py-3 text-gray-800 text-sm font-medium" },
            { data: "category_name", title: "CATEGORIA",  className: "px-4 py-3 text-gray-800 text-sm", render: (cellValue: string | null) => String(cellValue ?? "").trim() || "<span class='italic'>N/A</span>" },
            { data: "total_in",      title: "ENTRADAS",   className: "px-4 py-3 text-emerald-600 text-sm font-semibold" },
            { data: "total_out",     title: "SAÍDAS",     className: "px-4 py-3 text-red-600 text-sm font-semibold" },
            { data: "turnover",      title: "GIRO",       className: "px-4 py-3 text-sm", render: (cellValue: number | string) => buildTurnoverBadge(Number(cellValue ?? 0)) },
        ],
        fetchData: async (params: FetchParams): Promise<FetchResult<StockTurnoverRow>> => {
            const response = await api.post("reports/stock-turnover", {
                ...filters,
                start:  params.start,
                length: params.length,
            });
            const payload = response.data as StockTurnoverResponse;
            const rows = Array.isArray(payload.data) ? payload.data : [];
            return {
                data:            rows,
                recordsTotal:    payload.recordsTotal    ?? rows.length,
                recordsFiltered: payload.recordsFiltered ?? rows.length,
            };
        },
    });
}
