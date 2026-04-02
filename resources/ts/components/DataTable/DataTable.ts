import "datatables.net-dt";

export interface FetchParams {
    start:  number;
    length: number;
    draw:   number;
}

export interface FetchResult<TRow extends object = Record<string, unknown>> {
    data:            TRow[];
    recordsTotal:    number;
    recordsFiltered: number;
}

export interface RowAction {
    /** Classe CSS do botão dentro da linha (ex: ".btn-edit") */
    selector: string;
    /** Recebe o id da linha (data-id) e a instância da tabela */
    handler: (id: number, table: DataTables.Api) => void | Promise<void>;
}

export interface DataTableOptions<TRow extends object = Record<string, unknown>> {
    /** Definição das colunas (mesmo formato do DataTables) */
    columns: DataTables.ColumnSettings[];

    /** Função que busca os dados no servidor */
    fetchData: (params: FetchParams) => Promise<FetchResult<TRow>>;

    /** Botões de ação dentro das linhas (edit, delete, etc.) */
    actions?: RowAction[];

    /** Nome exibido na paginação: "Exibindo 1 a 10 de 50 {infoLabel}" */
    infoLabel?: string;

    /** Linhas zebradas (padrão: true) */
    striped?: boolean;
}

/* ------------------------------------------------------------------ */
/*  Função principal — cria e retorna a instância do DataTable        */
/* ------------------------------------------------------------------ */

interface DataTableAjaxParams {
    start: number;
    length: number;
    draw: number;
}

interface DataTableAjaxResponse<TRow extends object = Record<string, unknown>> {
    draw: number;
    recordsTotal: number;
    recordsFiltered: number;
    data: TRow[];
}

export function createDataTable<TRow extends object = Record<string, unknown>>(
    $table:  JQuery<HTMLElement>,
    options: DataTableOptions<TRow>,
): DataTables.Api {

    const columns   = options.columns;
    const fetchData = options.fetchData;
    const actions   = options.actions   ?? [];
    const infoLabel = options.infoLabel ?? "registros";
    const striped   = options.striped   ?? true;

    const tableId = $table.attr("id") ?? "";

    const table = $table.DataTable({
        destroy:    true,
        serverSide: true,
        processing: false,
        autoWidth:  true,
        pagingType: "simple_numbers",
        columns,

        dom: '<"flex items-center justify-between mb-4"l>rt<"flex items-center justify-between mt-4"ip>',

        language: {
            lengthMenu:  "_MENU_",
            search:      "Buscar:",
            processing:  "",
            info:        `Exibindo _START_ a _END_ de _TOTAL_ ${infoLabel}`,
            infoEmpty:   "Nenhum resultado encontrado",
            zeroRecords: "Nenhum resultado encontrado", 
        },// @ts-ignore 
        ajax: async (dtParams: DataTableAjaxParams, callback: (data: DataTableAjaxResponse<TRow>) => void) => {
            try {
                const result = await fetchData({
                    start:  dtParams.start,
                    length: dtParams.length,
                    draw:   dtParams.draw,
                });

                callback({
                    draw:            dtParams.draw,
                    recordsTotal:    result.recordsTotal,
                    recordsFiltered: result.recordsFiltered,
                    data:            result.data,
                });
            } catch {
                const emptyData: TRow[] = [];

                callback({
                    draw:            dtParams.draw,
                    recordsTotal:    0,
                    recordsFiltered: 0,
                    data:            emptyData,
                });
            }
        },

        createdRow(row, _data, index) {
            if (striped && index % 2 === 0) {
                $(row).addClass("bg-gray-100");
            }
        },

        drawCallback() {
            if (tableId) {
                $(`#${tableId}_info`).addClass("text-gray-800 text-sm pl-2 pb-1");
            }
        },
    });

    /* ---------- Registra os handlers dos botões de ação ---------- */

    for (const action of actions) {
        $table.on("click", action.selector, async function (e) {
            e.preventDefault();

            const id = Number($(this).data("id"));

            if (id) {
                await action.handler(id, table);
            }
        });
    }

    return table;
}
