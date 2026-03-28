import $ from "jquery"; 
import { DatePicker } from "../../../components/DatePicker/flatpickr";
import { showUserLogged } from "../../../components/User/ShowUserLogged";
import { showLocations } from "../../../components/Location/ShowLocations";
import { showProviders } from "../../../components/Providers/ShowProviders";
import { submitStockIn } from "../../../components/Stock/SubmitStockIn";
import { initProductSearch } from "../../../components/Products/productSearch";
import { initLocalTomSelect, initAndStore } from "../../../components/TomSelect/initTomSelect";

$(document).ready(async () => {
    const $textHeaderUsername = $('#text-header-username');
    const $textHeaderRole     = $('#text-header-type-user');

    const $selectStockProduct  = $('#select-stock-product');
    const $selectStockProvider = $('#select-stock-provider');
    const $selectStockLocation = $('#select-stock-location');

    const $inputStockQuantity = $('#input-stock-quantity');
    const $inputStockDate     = $('#input-stock-date'); 
    const $textareaStockDesc  = $('#textarea-stock-description');
    const $btnStockSave       = $('#btn-stock-save');

    const today              = new Date();
    const datePickerInstance = DatePicker.initSingle($inputStockDate, today);

    const productEl = $selectStockProduct[0] as HTMLSelectElement | undefined;
    if (productEl) {
        const ts = initProductSearch(productEl, "lg");
        $selectStockProduct.data("tomSelect", ts);
    }

    await showUserLogged($textHeaderUsername, $textHeaderRole);
    await showProviders($selectStockProvider);
    await showLocations($selectStockLocation);

    if ($selectStockProvider.length) {
        initAndStore($selectStockProvider, (el) => initLocalTomSelect(el, { size: "lg" }));
    }
    if ($selectStockLocation.length) {
        initAndStore($selectStockLocation, (el) => initLocalTomSelect(el, { size: "lg" }));
    }

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