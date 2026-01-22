import $ from "jquery";
import flatpickr from "flatpickr";
import { Portuguese } from "flatpickr/dist/l10n/pt"; 

import { openModal } from "../../../Utils/openModal";
import { closeModal } from "../../../Utils/CloseModal"; 
import { getProductsController } from "../../../Controllers/Products/getProducts";
import { getProvidersController } from "../../../Controllers/Providers/getProviders";
import { getUserLoggedController } from "../../../Controllers/User/getUserLogged";
import { StockInFormController } from "../../../Controllers/StockIn/stockInForm";
import { DatePicker } from "../../../components/DatePicker/flatpickr";
import { Toast } from "../../../components/Swal/swal";



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

    getProductsController.loadProducts($mainProductSelect);
    getProvidersController.loadProviders([$mainProviderSelect, $modalProviderSelect]);
    getUserLoggedController.loadUserLogged($usernameInput, $type_user_idInput);

    let dateValue: string = "";
    const today = new Date();

  const datePickerInstance = DatePicker.initSingle($mainDateInput, today)

    $btnOpenModal.on('click', function() {
        openModal($modalProduct);
    });

    $btnCloseModal.on('click', function() {
        closeModal($modalProduct);
    });

    $btnSave.on('click', (event) => {
        const selectedDate = datePickerInstance.selectedDates[0];
        const dateValue    = datePickerInstance.formatDate(selectedDate, "Y-m-d");

        if (!dateValue) {
            Toast.error("Selecione uma data!");
            return;
        }

        StockInFormController.handleSubmit(event, {
            $product:  $mainProductSelect,
            $qty:      $mainQtyInput,
            $provider: $mainProviderSelect,
            $obs:      $mainObsInput,
            $date:     $mainDateInput,
            $btn:      $btnSave
        }, dateValue);
    });
});