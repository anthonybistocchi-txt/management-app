import { createDataTable } from "../DataTable/DataTable";
import { formatPrice } from "../../utils/FormatPrice";
import { ProductController } from "../../Controllers/Products/ProductController";
import { ShowModalEditProduct } from "./ModalEditProduct";
import { Toast } from "../Swal/swal";
import { attachDeleteConfirmation } from "../shared/modals/attachDeleteConfirmation";
import { buildCrudActionButtonsHtml } from "../shared/tables/buildCrudActionButtonsHtml";
import { getTableRowData } from "../shared/tables/getTableRowData";

const PRODUCT_COLUMNS: DataTables.ColumnSettings[] = [
    { data: "name", title: "NOME", className: "px-4 py-3 text-gray-800 text-sm" },
    {
        data: "category_name",
        title: "CATEGORIA",
        className: "px-4 py-3 text-gray-800 text-sm",
        render: (value: string | null, _displayType: string, row: ProductData) => value ?? row.category_name ?? row.category?.name ?? "-",
    },
    {
        data: "provider_name",
        title: "FORNECEDOR",
        className: "px-4 py-3 text-gray-800 text-sm",
        render: (value: string | null, _displayType: string, row: ProductData) => value ?? row.provider_name ?? row.provider?.name ?? "-",
    },
    {
        data: "price",
        title: "PRECO",
        className: "px-4 py-3 text-gray-800 text-sm",
        render: (value: number | string | null, _displayType: string, row: ProductData) => {
            const numeric = Number(value ?? row.price ?? 0);
            if (Number.isNaN(numeric)) return "-";
            return formatPrice(numeric);
        },
    },
    {
        data: "quantity",
        title: "ESTOQUE",
        className: "px-4 py-3 text-gray-800 text-sm",
        render: (value: number | string | null, _displayType: string, row: ProductData) => String(value ?? row.quantity ?? 0),
    },
    {
        data: "location_name",
        title: "LOCAL",
        className: "px-4 py-3 text-gray-800 text-sm",
        render: (value: string | null, _displayType: string, row: ProductData) => value ?? row.location_name ?? row.location?.name ?? "-",
    },
    {
        data: null,
        title: "ACOES",
        className: "px-4 py-3 text-gray-800 text-sm text-right",
        orderable: false,
        render(_cellData: string | null, _displayType: string, row: ProductData) {
            return buildCrudActionButtonsHtml("product", row.id);
        },
    },
];

function getFilterValue($el?: JQuery<HTMLElement>, fallback = ""): string {
    return $el ? String($el.val() ?? "").trim() : fallback;
}

export function showProductsTable(
    $tableElement:    JQuery<HTMLElement>,
    $search?:         JQuery<HTMLElement>,
    $filterCategory?: JQuery<HTMLElement>,
    $filterProvider?: JQuery<HTMLElement>,
    $filterLocation?: JQuery<HTMLElement>,
    $btnFilter?:      JQuery<HTMLElement>,
): DataTables.Api {
    const table = createDataTable($tableElement, {
        columns: PRODUCT_COLUMNS,
        infoLabel: "produtos",

        async fetchData(params) {
            const products = await ProductController.getInfoProducts();

            const searchValue   = getFilterValue($search).toLowerCase();
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
                    const row = getTableRowData<ProductData>(tbl, productId);
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
                    const $modal      = $("#modal-delete-product");
                    const $inputId    = $("#input-delete-product-id");
                    const $btnConfirm = $("#btn-modal-confirm-product-delete");
                    const $btnCancel  = $("#btn-modal-cancel-product-delete");
                    const $btnClose   = $("#btn-modal-close-product-delete");

                    $inputId.val(String(productId));

                    attachDeleteConfirmation({
                        modal: $modal,
                        confirmButton: $btnConfirm,
                        cancelButton:  $btnCancel,
                        closeButton:   $btnClose,
                        itemIdInput:   $inputId,
                        entityLabel:   "Produto",
                        failureMessage: "Nao foi possivel excluir o produto.",
                        onConfirm: async () => ProductController.deleteProduct(productId), // @ts-ignore
                        onSuccess: () => tbl.draw(false),
                    });
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
