import $, { get } from "jquery";
import flatpickr from "flatpickr";
import { Portuguese } from "flatpickr/dist/l10n/pt";
import { openModal } from "../../../utils/openModal";
import { closeModal } from "../../../utils/CloseModal";
import { getProviders } from "./Api/getProviders"; 
import { getProducts } from "./Api/getProducts"; 
import { StockInForm } from "./Api/stockInForm"; 
import { getUserLogged } from "./Api/getUserLogged";

$(document).ready(() => {
    const $modalProduct        = $('#modal-product');
    const $btnOpenModal        = $('#btn-add-product');
    const $btnCloseModal       = $('#close-modal, #cancel-modal');
    const $modalProviderSelect = $('#provider-new-product');

    const $mainProductSelect  = $('#products');
    const $mainProviderSelect = $('#providers');
    const $usernameInput      = $('#username');
    const $type_user_idInput  = $('#type_user_id');
    const $mainQtyInput       = $('#quantity');
    const $mainDateInput      = $('#date_picker'); 
    const $mainObsInput       = $('#observations');
    const $btnSave            = $('#btn-save');

    let dateValue: string = "";
    const today = new Date();

    flatpickr("#date_picker", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d/m/Y",
        allowInput: true,
        locale: Portuguese,
        defaultDate: today,
        onReady: (date, s, instance) => {
            if (date.length > 0) dateValue = instance.formatDate(date[0], "Y-m-d");
        },
        onChange: (date, s, instance) => {
            if (date.length > 0) dateValue = instance.formatDate(date[0], "Y-m-d");
        }
    });

    getProducts.loadProducts($mainProductSelect);
    getProviders.loadProviders([$mainProviderSelect, $modalProviderSelect]);
    getUserLogged.loadUserLogged([$usernameInput, $type_user_idInput]);

    $btnOpenModal.on('click', function() {
        openModal($modalProduct);
    });

    $btnCloseModal.on('click', function() {
        closeModal($modalProduct);
    });

    $btnSave.on('click', (event) => {
        StockInForm.handleSubmit(event, {
            $product:  $mainProductSelect,
            $qty:      $mainQtyInput,
            $provider: $mainProviderSelect,
            $obs:      $mainObsInput,
            $date:     $mainDateInput,
            $btn:      $btnSave
        }, dateValue);
    });
});