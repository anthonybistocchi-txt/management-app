import { createDataTable } from "../DataTable/DataTable";
import { ProductCategoriesController } from "../../Controllers/ProductCategories/ProductCategoriesController";
import { ShowModalEditCategory } from "./ModalEditCategory";
import { openModal } from "../../utils/openModal";
import { closeModal } from "../../utils/CloseModal";
import { Toast } from "../Swal/swal";

const CATEGORY_COLUMNS: DataTables.ColumnSettings[] = [
    { data: "name", title: "NOME", className: "px-4 py-3 text-gray-800 text-sm" },
    { data: "description", title: "DESCRICAO", className: "px-4 py-3 text-gray-800 text-sm" },
    {
        data: null,
        title: "ACOES",
        className: "px-4 py-3 text-gray-800 text-sm text-right",
        orderable: false,
        render(_data: any, _type: any, row: any) {
            return `
                <div class="flex items-center justify-end gap-2">
                    <button type="button"
                        class="btn-edit-category p-2 rounded-lg text-gray-500 hover:bg-gray-200 hover:scale-110 transition-all duration-200"
                        data-id="${row.id}">
                        <span class="material-symbols-outlined text-[20px]">edit</span>
                    </button>
                    <button type="button"
                        class="btn-delete-category p-2 rounded-lg text-red-500 hover:text-red-600 hover:bg-red-100 hover:scale-110 transition-all duration-200"
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

function getRowData(table: DataTables.Api, id: number): ProductCategoryData | undefined {
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
                    const row = getRowData(tbl, categoryId);
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
                    const $modal = $("#modal-delete-category");
                    const $inputId = $("#input-delete-category-id");
                    const $btnConfirm = $("#btn-modal-confirm-category-delete");
                    const $btnCancel = $("#btn-modal-cancel-category-delete");
                    const $btnClose = $("#btn-modal-close-category-delete");

                    $inputId.val(String(categoryId));
                    openModal($modal);

                    $btnCancel.off("click").on("click", () => closeModal($modal));
                    $btnClose.off("click").on("click", () => closeModal($modal));

                    $btnConfirm.off("click").on("click", async (e) => {
                        e.preventDefault();
                        Toast.info("API de categorias ainda nao implementada.");
                        closeModal($modal);
                        tbl.draw(false);
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
