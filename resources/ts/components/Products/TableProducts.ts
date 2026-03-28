import { createDataTable } from "../DataTable/DataTable";
import { ProductController } from "../../Controllers/Products/ProductController";
import { ProviderController } from "../../Controllers/Providers/ProviderController";
import { ProductCategoriesController } from "../../Controllers/ProductCategories/ProductCategoriesController";
import { LocationController } from "../../Controllers/Locations/LocationController";
import { ShowModalEditProduct } from "./ModalEditProduct";
import { Toast } from "../Swal/swal";
import { openModal } from "../../utils/openModal";
import { closeModal } from "../../utils/CloseModal";

let categoryById = new Map<number, string>();
let providerById = new Map<number, string>();
let locationById = new Map<number, string>();

const PRODUCT_COLUMNS: DataTables.ColumnSettings[] = [
    { data: "name", title: "NOME", className: "px-4 py-3 text-gray-800 text-sm" },
    {
        data: "product_category_id",
        title: "CATEGORIA",
        className: "px-4 py-3 text-gray-800 text-sm",
        render: (value: number | null) => categoryById.get(Number(value)) ?? "-",
    },
    {
        data: "provider_id",
        title: "FORNECEDOR",
        className: "px-4 py-3 text-gray-800 text-sm",
        render: (value: number | null) => providerById.get(Number(value)) ?? "-",
    },
    {
        data: "price",
        title: "PRECO",
        className: "px-4 py-3 text-gray-800 text-sm",
        render: (value: number | string | null) => {
            if (value === null || value === undefined || value === "") return "-";
            const numeric = typeof value === "string" ? Number(value) : value;
            if (Number.isNaN(numeric)) return "-";
            return numeric.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
        },
    },
    {
        data: "quantity",
        title: "ESTOQUE",
        className: "px-4 py-3 text-gray-800 text-sm",
        render: (value: number | null) => (value ?? 0).toString(),
    },
    {
        data: "location_id",
        title: "LOCAL",
        className: "px-4 py-3 text-gray-800 text-sm",
        render: (value: number | null) => locationById.get(Number(value)) ?? "-",
    },
    {
        data: null,
        title: "ACOES",
        className: "px-4 py-3 text-gray-800 text-sm text-right",
        orderable: false,
        render(_data: any, _type: any, row: any) {
            return `
                <div class="flex items-center justify-end gap-2">
                    <button type="button"
                        class="btn-edit-product p-2 rounded-lg text-gray-500 hover:bg-gray-200 hover:scale-110 transition-all duration-200"
                        data-id="${row.id}">
                        <span class="material-symbols-outlined text-[20px]">edit</span>
                    </button>
                    <button type="button"
                        class="btn-delete-product p-2 rounded-lg text-red-500 hover:text-red-600 hover:bg-red-100 hover:scale-110 transition-all duration-200"
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

function getRowData(table: DataTables.Api, id: number): ProductData | undefined {
    const $row = $(table.table().body()).find(`[data-id="${id}"]`).closest("tr");
    return table.row($row).data() as ProductData | undefined;
}

export function showProductsTable(
    $tableElement: JQuery<HTMLElement>,
    $search?: JQuery<HTMLElement>,
    $filterCategory?: JQuery<HTMLElement>,
    $filterProvider?: JQuery<HTMLElement>,
    $filterLocation?: JQuery<HTMLElement>,
    $btnFilter?: JQuery<HTMLElement>,
): DataTables.Api {
    const table = createDataTable($tableElement, {
        columns: PRODUCT_COLUMNS,
        infoLabel: "produtos",

        async fetchData(params) {
            const [products, categories, providers, locations] = await Promise.all([
                ProductController.getProducts(),
                ProductCategoriesController.getProductCategories(),
                ProviderController.getProviders(),
                LocationController.getLocations(),
            ]);

            categoryById = new Map(categories.map((item) => [item.id, item.name]));
            providerById = new Map(providers.map((item) => [item.id, item.name]));
            locationById = new Map(locations.map((item) => [item.id, item.name]));

            const searchValue = getFilterValue($search).toLowerCase();
            const categoryValue = getFilterValue($filterCategory, "all");
            const providerValue = getFilterValue($filterProvider, "all");
            const locationValue = getFilterValue($filterLocation, "all");

            const filtered = products.filter((product) => {
                const matchesSearch = !searchValue
                    || product.name?.toLowerCase().includes(searchValue);

                const matchesCategory = categoryValue === "all"
                    || Number(categoryValue) === Number(product.product_category_id);

                const matchesProvider = providerValue === "all"
                    || Number(providerValue) === Number(product.provider_id);

                const matchesLocation = locationValue === "all"
                    || Number(locationValue) === Number(product.location_id);

                return matchesSearch && matchesCategory && matchesProvider && matchesLocation;
            });

            const paginated = filtered.slice(params.start, params.start + params.length);

            return {
                data: paginated,
                recordsTotal: products.length,
                recordsFiltered: filtered.length,
            };
        },

        actions: [
            {
                selector: ".btn-edit-product",
                async handler(productId, tbl) {
                    const row = getRowData(tbl, productId);
                    if (!row) {
                        Toast.error("Produto nao encontrado.");
                        return;
                    }

                    await ShowModalEditProduct(row, tbl);
                },
            },
            {
                selector: ".btn-delete-product",
                async handler(productId, tbl) {
                    const $modal = $("#modal-delete-product");
                    const $inputId = $("#input-delete-product-id");
                    const $btnConfirm = $("#btn-modal-confirm-product-delete");
                    const $btnCancel = $("#btn-modal-cancel-product-delete");
                    const $btnClose = $("#btn-modal-close-product-delete");

                    $inputId.val(String(productId));
                    openModal($modal);

                    $btnCancel.off("click").on("click", () => closeModal($modal));
                    $btnClose.off("click").on("click", () => closeModal($modal));

                    $btnConfirm.off("click").on("click", async (e) => {
                        e.preventDefault();
                        $btnConfirm.text("Excluindo...").prop("disabled", true);

                        try {
                            const result = await ProductController.deleteProduct(productId);
                            if (result.success) {
                                Toast.success("Produto excluido com sucesso.");
                                closeModal($modal);
                                tbl.draw(false);
                            } else {
                                Toast.error(result.message ?? "Nao foi possivel excluir o produto.");
                            }
                        } finally {
                            $btnConfirm.text("Excluir").prop("disabled", false);
                        }
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
