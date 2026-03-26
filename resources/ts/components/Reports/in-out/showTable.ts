import api from "../../../utils/api";
import { createDataTable } from "../../DataTable/DataTable";
import type { FetchParams, FetchResult } from "../../DataTable/DataTable";

export interface InOutFilters {
    product_id: string;
    location_id: string;
    type: string;
    provider_id: string;
    category_id: string;
    date_from: string;
    date_to: string;
}

export function showTableInOutReport(
    $tableElement: JQuery<HTMLElement>,
    filters: InOutFilters,
): DataTables.Api {
    return createDataTable($tableElement, {
        columns: [
            { data: "product_name",   title: "NOME",         className: "px-4 py-3 text-gray-800 text-sm" },
            { data: "quantity_moved", title: "QUANTIDADE",  className: "px-4 py-3 text-gray-800 text-sm" },
            { data: "movement_date",  title: "DATA",         className: "px-4 py-3 text-gray-800 text-sm" },
            { data: "description",    title: "DESCRIÇÃO",   className: "px-4 py-3 text-gray-800 text-sm" },
            { data: "category_name",  title: "CATEGORIA",   className: "px-4 py-3 text-gray-800 text-sm" },
            { data: "location_name",  title: "LOCAL",       className: "px-4 py-3 text-gray-800 text-sm" },
            { data: "provider_name",  title: "FORNECEDOR",  className: "px-4 py-3 text-gray-800 text-sm" },
            {
                data: "type",
                title: "TIPO",
                className: "px-4 py-3 text-gray-800 text-sm",
                render(value: unknown) {
                    const type = String(value ?? "").toLowerCase();

                    if (type === "in") {
                        return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">Entrada</span>`;
                    }

                    if (type === "out") {
                        return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-red-50 text-red-700 border border-red-100">Saída</span>`;
                    }

                    if (type === "transfer") {
                        return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">Transferência</span>`;
                    }

                    return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-semibold bg-gray-50 text-gray-700 border border-gray-100">Desconhecido</span>`;
                },
            },
        ],
        
        fetchData: async (_params: FetchParams): Promise<FetchResult> => {
            const response = await api.post("reports/in-out", {
                ...filters,

                start: _params.start,
                length: _params.length,
            });

            const payload = response.data as {
                data?: any;
                recordsTotal?: number;
                recordsFiltered?: number;
            };
            const rows = Array.isArray(payload.data) ? payload.data : [];

            return {
                data: rows,
                recordsTotal: payload.recordsTotal ?? rows.length,
                recordsFiltered: payload.recordsFiltered ?? rows.length,
            };
        },
    });
}
