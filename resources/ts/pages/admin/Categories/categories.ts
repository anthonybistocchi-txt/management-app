import $ from "jquery";
import { openModal } from "../../../utils/openModal";
import { closeModal } from "../../../utils/CloseModal";
import { showCategoriesTable } from "../../../components/Categories/TableCategories";
import { ShowModalCreateCategory } from "../../../components/Categories/ModalCreateCategory";
import { showUserLogged } from "../../../components/User/ShowUserLogged";
import { initLocalTomSelect } from "../../../components/TomSelect/initTomSelect";

$(document).ready(async () => {
    const $textHeaderUsername = $("#text-header-username");
    const $textHeaderTypeUser = $("#text-header-type-user");

    const $btnOpenCreate = $("#btn-open-create-category");
    const $btnSubmitSearch = $("#btn-submit-search-category");
    const $inputSearch = $("#input-search-category");
    const $filterStatus = $("#select-filter-category-status");
    const $filterType = $("#select-filter-category-type");

    const $table = $("#table-categories");

    const $modalCreate = $("#modal-create-category");
    const $btnModalClose = $("#btn-modal-close-category");
    const $btnModalCancel = $("#btn-modal-cancel-category");
    const $btnModalSave = $("#btn-modal-save-category");

    const $inputName = $("#input-create-category-name");
    const $textareaDescription = $("#textarea-create-category-description");

    await showUserLogged($textHeaderUsername, $textHeaderTypeUser);

    const filterSelects = [
        { $el: $filterStatus, size: "sm" as const },
        { $el: $filterType, size: "sm" as const },
    ];

    for (const { $el, size } of filterSelects) {
        const el = $el[0] as HTMLSelectElement | undefined;
        if (el) {
            const ts = initLocalTomSelect(el, { size, allowEmpty: true });
            $el.data("tomSelect", ts);
        }
    }

    await showCategoriesTable($table, $inputSearch, $btnSubmitSearch);

    $btnOpenCreate.on("click", () => {
        openModal($modalCreate);
    });

    $btnModalSave.on("click", async (e) => {
        e.preventDefault();
        await ShowModalCreateCategory(
            $inputName,
            $textareaDescription,
            $btnModalSave,
            $modalCreate,
            $table,
        );
    });

    $btnModalClose.on("click", () => closeModal($modalCreate));
    $btnModalCancel.on("click", () => closeModal($modalCreate));
});
