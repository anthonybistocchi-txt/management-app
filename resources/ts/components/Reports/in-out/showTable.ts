import { createDataTable } from "../../DataTable/DataTable";
import type { FetchParams, FetchResult } from "../../DataTable/DataTable";

export function showTableInOutReport($tableElement: JQuery<HTMLElement>): DataTables.Api {
    return createDataTable($tableElement, {
        columns: [
            { data: "product_name",   title: "NOME" },
            { data: "quantity_moved", title: "QUANTIDADE" },
            { data: "movement_date",  title: "DATA" },
            { data: "description",    title: "DESCRIÇÃO" },
            { data: "category_name",  title: "CATEGORIA" },
            { data: "location_name",  title: "LOCAL" },
            { data: "provider_name",  title: "FORNECEDOR" },
            { data: "type",           title: "TIPO" },
        ],
        
        fetchData: async (_params: FetchParams): Promise<FetchResult> => {
            const response = await fetch("/api/in-out");
            const raw      = await response.json();

            if (Array.isArray(raw)) {
                return {
                    data: raw,
                    recordsTotal: raw.length,
                    recordsFiltered: raw.length,
                };
            }

            return raw as FetchResult;
        },
    });
}
