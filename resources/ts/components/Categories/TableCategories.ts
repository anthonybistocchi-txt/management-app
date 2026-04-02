import { createDataTable } from "../DataTable/DataTable";
import { ProductCategoriesController } from "../../Controllers/ProductCategories/ProductCategoriesController";
import { ShowModalEditCategory } from "./ModalEditCategory";
import { Toast } from "../Swal/swal";
import { buildCrudActionButtonsHtml } from "../shared/tables/buildCrudActionButtonsHtml";
import { getTableRowData } from "../shared/tables/getTableRowData";

const CATEGORY_COLUMNS: DataTables.ColumnSettings[] = [
    { data: "name", title: "NOME", className: "px-4 py-3 text-gray-800 text-sm" },
    { data: "description", title: "DESCRICAO", className: "px-4 py-3 text-gray-800 text-sm" },
    {
        data: null,
        title: "ACOES",
        className: "px-4 py-3 text-gray-800 text-sm text-right",
        orderable: false,
        render(_cellData: string | null, _displayType: string, row: ProductCategoryData) {
            return buildCrudActionButtonsHtml("category", row.id);
        },
    },
];

function getFilterValue($el?: JQuery<HTMLElement>, fallback = ""): string {
    return $el ? String($el.val() ?? "").trim() : fallback;
}

function getRowData(table: DataTables.Api, id: number): ProductCategoryData | undefined { // @ts-ignore
    const $row = $(table.table().body()).find(`[data-id="${id}"]`).closest("tr");
    return table.row($row).data() as ProductCategoryData | undefined;
}

export function showCategoriesTable(
    $tableElement: JQuery<HTMLElement>,
    $search?: JQuery<HTMLElement>,
    $btnFilter?: JQuery<HTMLElement>,
): DataTables.Api {
    const table = createDataTable($tableElement, {
        columns: CATEGORY_COLUMNS,
        infoLabel: "categorias",

        async fetchData(params) {
            const categories = await ProductCategoriesController.getProductCategories();

            const searchValue = getFilterValue($search).toLowerCase();

            const filtered = categories.filter((category) => {
                return !searchValue || category.name?.toLowerCase().includes(searchValue);
            });

            const paginated = filtered.slice(params.start, params.start + params.length);

            return {
                data: paginated,
                recordsTotal: categories.length,
                recordsFiltered: filtered.length,
            };
        },

        actions: [
            {
                selector: ".btn-edit-category",
                async handler(categoryId, tbl) {
                    const row = getTableRowData<ProductCategoryData>(tbl, categoryId);
                    if (!row) {
                        Toast.error("Categoria nao encontrada.");
                        return;
                    }

                    await ShowModalEditCategory(row, tbl);
                },
            },
            {
                selector: ".btn-delete-category",
                async handler(categoryId, tbl) {
                    Toast.info("API de categorias ainda nao implementada.");
                    tbl.draw(false);
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
