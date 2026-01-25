import $ from "jquery"; 
import { getProductsController } from "../../../Controllers/Products/getProducts";
import { getProvidersController } from "../../../Controllers/Providers/getProviders";
import { getUserLoggedController } from "../../../Controllers/User/getUserLogged";
import { StockInFormController } from "../../../Controllers/StockIn/stockInForm";
import { DatePicker } from "../../../components/DatePicker/flatpickr";
import { Toast } from "../../../components/Swal/swal";
import { LocationController } from "../../../Controllers/Locations/Location";

$(document).ready(() => {
    const $textHeaderUsername = $('#text-header-username');
    const $textHeaderRole     = $('#text-header-role');

    const $selectStockProduct  = $('#select-stock-product');
    const $selectStockProvider = $('#select-stock-provider');
    const $selectStockLocation = $('#select-stock-location');

    const $inputStockQuantity = $('#input-stock-quantity');
    const $inputStockDate     = $('#input-stock-date'); 
    const $textareaStockDesc  = $('#textarea-stock-description');
    const $btnStockSave       = $('#btn-stock-save');

    getProductsController.loadProducts($selectStockProduct);
    getProvidersController.loadProviders([$selectStockProvider]);
    getUserLoggedController.loadUserLogged($textHeaderUsername, $textHeaderRole);
    LocationController.loadLocations($selectStockLocation);

    const today = new Date();

    const datePickerInstance = DatePicker.initSingle($inputStockDate, today)
    const selectedDate       = datePickerInstance.selectedDates[0];
    const dateValue          = datePickerInstance.formatDate(selectedDate, "Y-m-d");

    
    $btnStockSave.on('click', async (event) => {
        event.preventDefault();

        const selectedDates = datePickerInstance.selectedDates;
        const currentDateValue = selectedDates.length > 0 
            ? datePickerInstance.formatDate(selectedDates[0], "Y-m-d H:i:s") 
            : null;

        if (!currentDateValue) {
            Toast.info("Selecione uma data!");
            return;
        }

        const productId   = Number($selectStockProduct.val());
        const quantity    = Number($inputStockQuantity.val());
        const providerId  = Number($selectStockProvider.val());
        const description = $textareaStockDesc.val() as string;
        const finalDate   = String(currentDateValue); 
        const locationId  = Number($selectStockLocation.val());

        if (!productId || !quantity || !providerId || !finalDate || !locationId) {
            Toast.info("Por favor, preencha todos os campos obrigatórios.");
            return;
        }

        if (quantity <= 0) {
            Toast.info("A quantidade deve ser maior que zero.");
            return;
        }

        $btnStockSave.html('Salvando...').prop('disabled', true);

        const result = await StockInFormController.handleSubmit(productId, quantity, providerId, finalDate, description, locationId);

        if (result) {
            Toast.success("Entrada de estoque registrada com sucesso!");

            $selectStockProduct.val(''); 
            $selectStockProvider.val('');
            $selectStockLocation.val('');
            $inputStockQuantity.val('');
            $textareaStockDesc.val(''); 
            
            datePickerInstance.setDate(new Date()); 
        }

        $btnStockSave.html('Salvar').prop('disabled', false);
    });
});