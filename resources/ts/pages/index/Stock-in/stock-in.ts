import $ from "jquery"; 
import { StockInFormController } from "../../../Controllers/StockIn/stockInForm";
import { DatePicker } from "../../../components/DatePicker/flatpickr";
import { Toast } from "../../../components/Swal/swal";
import { showUserLogged } from "../../../components/User/ShowUserLogged";
import { showLocations } from "../../../components/Location/ShowLocations";
import { showProducts } from "../../../components/Products/ShowProducts";
import { showProviders } from "../../../components/Providers/ShowProviders";
import { submitStockIn } from "../../../components/StockIn/SubmitStockIn";

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

    await showUserLogged($textHeaderUsername, $textHeaderRole);
    await showProviders($selectStockProvider);
    await showProducts($selectStockProduct);
    await showLocations($selectStockLocation);

 
    $btnStockSave.on('click', async (event) => {
        event.preventDefault();

        await submitStockIn($selectStockProduct,
            $inputStockQuantity,
            $selectStockProvider,
            $inputStockDate,
            $textareaStockDesc,
            $selectStockLocation,
            $btnStockSave);        
    });
});