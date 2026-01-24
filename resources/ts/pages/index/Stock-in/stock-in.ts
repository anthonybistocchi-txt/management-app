import $ from "jquery"; 
import { getProductsController } from "../../../Controllers/Products/getProducts";
import { getProvidersController } from "../../../Controllers/Providers/getProviders";
import { getUserLoggedController } from "../../../Controllers/User/getUserLogged";
import { StockInFormController } from "../../../Controllers/StockIn/stockInForm";
import { DatePicker } from "../../../components/DatePicker/flatpickr";
import { Toast } from "../../../components/Swal/swal";
import { LocationController } from "../../../Controllers/Locations/Location";
import { openModal } from "../../../utils/openModal";
import { closeModal } from "../../../utils/CloseModal";



$(document).ready(() => {
    const $modalProduct        = $('#modal-product');
    const $btnOpenModal        = $('#btn-add-product');
    const $btnCloseModal       = $('#close-modal, #cancel-modal');
    const $modalProviderSelect = $('#provider-new-product');

    const $mainProductSelect    = $('#products');
    const $mainProviderSelect   = $('#providers');
    const $usernameInput        = $('#username');
    const $type_user_idInput    = $('#type_user_id');
    const $mainLocationSelect   = $('#locations');
    const $mainQtyInput         = $('#quantity');
    const $mainDateInput        = $('#date_picker'); 
    const $mainDescriptionInput = $('#description');
    const $btnSave              = $('#btn-save');

    getProductsController.loadProducts($mainProductSelect);
    getProvidersController.loadProviders([$mainProviderSelect, $modalProviderSelect]);
    getUserLoggedController.loadUserLogged($usernameInput, $type_user_idInput);
    LocationController.loadLocations($mainLocationSelect);

    const today = new Date();

    const datePickerInstance = DatePicker.initSingle($mainDateInput, today)
    const selectedDate       = datePickerInstance.selectedDates[0];
    const dateValue          = datePickerInstance.formatDate(selectedDate, "Y-m-d");

    $btnOpenModal.on('click', function() {
        openModal($modalProduct);
    });

    $btnCloseModal.on('click', function() {
        closeModal($modalProduct);
    });
    
    $btnSave.on('click', async (event) => {
        event.preventDefault();

        const selectedDates = datePickerInstance.selectedDates;
        const currentDateValue = selectedDates.length > 0 
            ? datePickerInstance.formatDate(selectedDates[0], "Y-m-d H:i:s") 
            : null;

        if (!currentDateValue) {
            Toast.info("Selecione uma data!");
            return;
        }

        const productId   = Number($mainProductSelect.val());
        const quantity    = Number($mainQtyInput.val());
        const providerId  = Number($mainProviderSelect.val());
        const description = $mainDescriptionInput.val() as string;
        const finalDate   = String(currentDateValue); 
        const locationId  = Number($mainLocationSelect.val());

        if (!productId || !quantity || !providerId || !finalDate || !locationId) {
            Toast.info("Por favor, preencha todos os campos obrigatórios.");
            return;
        }

        if (quantity <= 0) {
            Toast.info("A quantidade deve ser maior que zero.");
            return;
        }

        $btnSave.html('Salvando...').prop('disabled', true);

        const result = await StockInFormController.handleSubmit(productId, quantity, providerId, finalDate, description, locationId);

        if (result) {
            Toast.success("Entrada de estoque registrada com sucesso!");

            $mainProductSelect.val(''); 
            $mainProviderSelect.val('');
            $mainLocationSelect.val('');
            $mainQtyInput.val('');
            $mainDescriptionInput.val(''); 
            
            datePickerInstance.setDate(new Date()); 
        }

        $btnSave.html('Salvar').prop('disabled', false);
    });
});