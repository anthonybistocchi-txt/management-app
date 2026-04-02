import $ from 'jquery';
import { submitStockOut } from '../../components/Stock/SubmitStockOut';
import { showLocations } from '../../components/Location/ShowLocations';
import { showUserLogged } from '../../components/User/ShowUserLogged';
import { DatePicker } from '../../components/DatePicker/flatpickr';
import { initProductSearch } from '../../components/Products/productSearch';
import { syncLocalTomSelectGroup } from '../../components/TomSelect/initTomSelect';

$(document).ready(async () => {
    const $textHeaderUsername = $('#text-header-username');
    const $textHeaderRole     = $('#text-header-type-user');

    const $selectStockProduct  = $('#select-stock-product');
    const $selectStockLocation = $('#select-stock-location');

    const $inputStockQuantity = $('#input-stock-quantity');
    const $inputStockDate     = $('#input-stock-date'); 
    const $textareaStockDesc  = $('#textarea-stock-description');
    const $btnStockSave       = $('#btn-stock-save');

    const today              = new Date();
    const datePickerInstance = DatePicker.initSingle($inputStockDate, today);

    const productEl = $selectStockProduct.get(0);
    if (productEl instanceof HTMLSelectElement) {
        const ts = initProductSearch(productEl, "lg");
        $selectStockProduct.data("tomSelect", ts);
    }

    await showUserLogged($textHeaderUsername, $textHeaderRole);
    await showLocations($selectStockLocation);

    syncLocalTomSelectGroup([
        { $el: $selectStockLocation, size: "lg" },
    ]);

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