import api from "../../../utils/api";
import { createDataTable } from "../../DataTable/DataTable";
import type { FetchParams, FetchResult } from "../../DataTable/DataTable";
import type { StockCardFilters, StockCardResponse, StockCardRow } from "../../../types/Reports/StockCardReport";

export function showTableStockCard(
    $tableElement: JQuery<HTMLElement>,
    filters: StockCardFilters,
): DataTables.Api {

    const buildTypeBadge = (type: string): string => {
        const normalizedType = type.toLowerCase();
        if (normalizedType === "in")       return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">Entrada</span>`;
        if (normalizedType === "out")      return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-red-50 text-red-700 border border-red-100">Saída</span>`;
        if (normalizedType === "transfer") return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">Transferência</span>`;
        return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-gray-50 text-gray-700 border border-gray-100">${type}</span>`;
    };

    return createDataTable($tableElement, {
        columns: [
            { data: "movement_date",    title: "DATA",        className: "px-4 py-3 text-gray-800 text-sm" },
            { data: "type",             title: "TIPO",        className: "px-4 py-3 text-gray-800 text-sm", render: (cellValue: string) => buildTypeBadge(String(cellValue ?? "")) },
            {
                data: "quantity_moved",
                title: "QUANTIDADE",
                className: "px-4 py-3 text-sm font-semibold",
                render(_cellData: string | number | null, _displayType: string, row: StockCardRow) {
                    const quantity = Number(row.quantity_moved);
                    const movementType = String(row.type).toLowerCase();
                    if (movementType === "in")  return `<span class="text-emerald-600">+${quantity}</span>`;
                    if (movementType === "out") return `<span class="text-red-600">-${quantity}</span>`;
                    return `<span class="text-blue-600">${quantity}</span>`;
                },
            },
            { data: "quantity_before",  title: "SALDO ANTES", className: "px-4 py-3 text-gray-800 text-sm", render: (cellValue: number | string | null) => cellValue ?? "—" },
            { data: "quantity_after",   title: "SALDO APÓS",  className: "px-4 py-3 text-gray-800 text-sm font-semibold", render: (cellValue: number | string | null) => cellValue ?? "—" },
            { data: "location_name",    title: "LOCAL",       className: "px-4 py-3 text-gray-800 text-sm", render: (cellValue: string | null) => String(cellValue ?? "").trim() || "<span class='italic'>N/A</span>" },
            { data: "provider_name",    title: "FORNECEDOR",  className: "px-4 py-3 text-gray-800 text-sm", render: (cellValue: string | null) => String(cellValue ?? "").trim() || "<span class='italic'>N/A</span>" },
            { data: "description",      title: "DESCRIÇÃO",   className: "px-4 py-3 text-gray-800 text-sm", render: (cellValue: string | null) => String(cellValue ?? "").trim() || "—" },
        ],
        fetchData: async (params: FetchParams): Promise<FetchResult<StockCardRow>> => {
            const response = await api.post("reports/stock-card", {
                ...filters,
                start:  params.start,
                length: params.length,
            });
            const payload = response.data as StockCardResponse;
            const rows = Array.isArray(payload.data) ? payload.data : [];
            return {
                data:            rows,
                recordsTotal:    payload.recordsTotal    ?? rows.length,
                recordsFiltered: payload.recordsFiltered ?? rows.length,
            };
        },
    });
}
