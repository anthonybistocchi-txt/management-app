import $ from "jquery"; 
import { DatePicker } from "../../../components/DatePicker/flatpickr";
import { showUserLogged } from "../../../components/User/ShowUserLogged";
import { showLocations } from "../../../components/Location/ShowLocations";
import { showProducts } from "../../../components/Products/ShowProducts";
import { showProviders } from "../../../components/Providers/ShowProviders";
import { submitStockIn } from "../../../components/Stock/SubmitStockIn";
import { submitStockOut } from "../../../components/Stock/SubmitStockOut";

$(document).ready(async () => {
    const $textHeaderUsername = $('#text-header-username');
    const $textHeaderRole     = $('#text-header-role');

    const $selectStockProduct  = $('#select-stock-product');
    const $selectStockProvider = $('#select-stock-provider');
    const $selectStockLocation = $('#select-stock-location');

    const $inputStockQuantity = $('#input-stock-quantity');
    const $inputStockDate     = $('#input-stock-date'); 
    const $textareaStockDesc  = $('#textarea-stock-description');
    const $btnStockSave       = $('#btn-stock-save');

    const today              = new Date();
    const datePickerInstance = DatePicker.initSingle($inputStockDate, today);

    await showUserLogged($textHeaderUsername, $textHeaderRole);
    await showProviders($selectStockProvider);
    await showProducts($selectStockProduct);
    await showLocations($selectStockLocation);

 
    $btnStockSave.on('click', async (event) => {
        event.preventDefault();

        await submitStockIn($selectStockProduct,
            $inputStockQuantity,
            $selectStockProvider,
            datePickerInstance,
            $textareaStockDesc,
            $selectStockLocation,
            $btnStockSave);        
    });
});