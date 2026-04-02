import $ from "jquery";
import { openModal } from "../../../utils/openModal";
import { closeModal } from "../../../utils/CloseModal";
import { maskPrice } from "../../../utils/priceMask";
import { showProductsTable } from "../../../components/Products/TableProducts";
import { ShowModalCreateProduct } from "../../../components/Products/ModalCreateProduct";
import { showUserLogged } from "../../../components/User/ShowUserLogged";
import { getTomSelectInstance, syncLocalTomSelectGroup } from "../../../components/TomSelect/initTomSelect";
import { showCategories } from "../../../components/ProductCategories/showCategories";
import { showProviders } from "../../../components/Providers/ShowProviders";
import { showLocations } from "../../../components/Locations/showLocations";

$(document).ready(async () => {
    const $textHeaderUsername = $("#text-header-username");
    const $textHeaderTypeUser = $("#text-header-type-user");

    const $btnOpenCreate   = $("#btn-open-create-product");
    const $btnSubmitSearch = $("#btn-submit-search-product");
    const $inputSearch     = $("#input-search-product");
    const $filterCategory  = $("#select-filter-product-category");
    const $filterProvider  = $("#select-filter-product-provider");
    const $filterLocation  = $("#select-filter-product-location");

    const $table = $("#table-products");

    const $modalCreate = $("#modal-create-product");
    const $btnModalClose = $("#btn-modal-close-product");
    const $btnModalCancel = $("#btn-modal-cancel-product");
    const $btnModalSave = $("#btn-modal-save-product");

    const $inputName = $("#input-create-product-name");
    const $selectCategory = $("#select-create-product-category");
    const $selectProvider = $("#select-create-product-provider");
    const $inputPrice = $("#input-create-product-price");
    const $inputQuantity = $("#input-create-product-quantity");
    const $selectLocation = $("#select-create-product-location");
    const $textareaDescription = $("#textarea-create-product-description");

    await showUserLogged($textHeaderUsername, $textHeaderTypeUser);

    await showCategories($filterCategory);
    await showProviders($filterProvider);
    await showLocations($filterLocation);

    const filterSelects = [
        { $el: $filterCategory, size: "sm" as const },
        { $el: $filterProvider, size: "sm" as const },
        { $el: $filterLocation, size: "sm" as const },
    ];

    syncLocalTomSelectGroup(filterSelects.map(({ $el, size }) => ({ $el, size, allowEmpty: true })));

    await showProductsTable($table, $inputSearch, $filterCategory, $filterProvider, $filterLocation, $btnSubmitSearch);

    $inputPrice.on("input", (event) => {
        const target = event.currentTarget as HTMLInputElement;
        target.value = maskPrice(target.value);
    });

    $btnOpenCreate.on("click", async () => {
        await showCategories($selectCategory);
        await showProviders($selectProvider);
        await showLocations($selectLocation);

        $selectCategory.find('option[value="all"]').remove();
        $selectProvider.find('option[value="all"]').remove();
        $selectLocation.find('option[value="all"]').remove();

        syncLocalTomSelectGroup([
            { $el: $selectCategory, size: "md", allowEmpty: true },
            { $el: $selectProvider, size: "md", allowEmpty: true },
            { $el: $selectLocation, size: "md", allowEmpty: true },
        ]);

        openModal($modalCreate);
    });

    $btnModalSave.on("click", async (e) => {
        e.preventDefault();
        await ShowModalCreateProduct(
            $inputName,
            $selectCategory,
            $selectProvider,
            $inputPrice,
            $inputQuantity,
            $selectLocation,
            $textareaDescription,
            $btnModalSave,
            $modalCreate,
            $table,
        );
    });

    $btnModalClose.on("click", () => closeModal($modalCreate));
    $btnModalCancel.on("click", () => closeModal($modalCreate));
});
