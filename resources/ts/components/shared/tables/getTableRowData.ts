import $ from "jquery";

export function getTableRowData<TRow extends { id: number }>(table: DataTables.Api, id: number): TRow | null { // @ts-ignore
    const $row = $(table.table().body()).find(`[data-id="${id}"]`).closest("tr");
    const rowData: unknown = table.row($row).data();

    if (!rowData || typeof rowData !== "object") {
        return null;
    }

    return rowData as TRow;
}