import $ from 'jquery';
import { submitStockOut } from '../../components/Stock/SubmitStockOut';
import { showLocations } from '../../components/Location/ShowLocations';
import { showProducts } from '../../components/Products/ShowProducts';
import { showProviders } from '../../components/Providers/ShowProviders';
import { showUserLogged } from '../../components/User/ShowUserLogged';
import { DatePicker } from '../../components/DatePicker/flatpickr';

$(document).ready(async () => {
    const $textHeaderUsername = $('#text-header-username');
    const $textHeaderRole     = $('#text-header-role');

    const $selectStockProduct  = $('#select-stock-product');
    const $selectStockLocation = $('#select-stock-location');

    const $inputStockQuantity = $('#input-stock-quantity');
    const $inputStockDate     = $('#input-stock-date'); 
    const $textareaStockDesc  = $('#textarea-stock-description');
    const $btnStockSave       = $('#btn-stock-save');

    const today              = new Date();
    const datePickerInstance = DatePicker.initSingle($inputStockDate, today);

    await showUserLogged($textHeaderUsername, $textHeaderRole);
    await showProducts($selectStockProduct);
    await showLocations($selectStockLocation);

 
    $btnStockSave.on('click', async (event) => {
        event.preventDefault();

        await submitStockOut($selectStockProduct,
            $inputStockQuantity,
            datePickerInstance,
            $textareaStockDesc,
            $selectStockLocation,
            $btnStockSave);        
    });

});