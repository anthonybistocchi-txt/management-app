import flatpickr from "flatpickr";
import { Portuguese } from "flatpickr/dist/l10n/pt";
import $ from "jquery";
import { openModal } from "../../utils/openModal";
import { closeModal } from "../../utils/CloseModal";
import { ProviderService } from "../../services/StockInService.ts/ProviderService";
import { Api } from "datatables.net";
import { ApiResponse } from "../../types/Utils/ApiResponse";

$(document).ready(() => {
    const $modalProduct       = $('#modal-product');
    const $btnOpenModal       = $('#btn-add-product');
    const $modalNameInput     = $('#name-new-product');
    const $modalDescInput     = $('#description-new-product'); 
    const $modalProviderInput = $('#provider-new-product');
    const $modalPriceInput    = $('#price-new-product');
    const $modalSaveBtn       = $('#save-new-product'); 
    const $closeModalBtn      = $('#close-modal');
    const $cancelBtn          = $('#cancel-modal');

    const $mainProductSelect  = $('#products');
    const $mainProviderSelect = $('#provider');
    const $mainQtyInput       = $('#quantity');
    const $mainDateInput      = $('#date_picker');
    const $mainObsInput       = $('#observations');
    const $mainSubmitBtn      = $('#btn-save');

    const today = new Date();

    let dateValue: string;

    flatpickr("#date_picker", {
       
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d/m/Y",
        allowInput: true,
        locale: Portuguese,
        defaultDate: today,
        onReady: (date, str, instance) => {
            if (date.length === 1) {
                dateValue = instance.formatDate(date[0], "Y-m-d");
            }
        },
        onChange: (date, str, instance) => {
            if (date.length === 1) {
                dateValue = instance.formatDate(date[0], "Y-m-d");
            }
        }
    });

    $btnOpenModal.on('click', async function() {
        openModal($modalProduct);
    
        const productName    = $modalNameInput.val()     as string;
        const providerId     = $modalProviderInput.val() as string;
        const observations   = $modalDescInput.val()     as string;
        const price          = Number($modalPriceInput.val());
        const saveBtn        = $modalSaveBtn;
        const closeModalBtn  = $closeModalBtn;
        const cancelModalBtn = $cancelBtn;

        try {
            const providersData: ApiResponse<ProviderData[]> = await ProviderService.getProviders();

            if (providersData.status && providersData.data) {
                console.log(providersData.data);
                const providers = providersData.data;
                $modalProviderInput.empty();

                providers.forEach((provider: ProviderData) => {
                    const option = `<option value="${provider.id}">${provider.name}</option>`;
                    $modalProviderInput.append(option);
                });
            }

        } catch (error) {
            console.error("Error loading providers:", error);
        }

        closeModalBtn.on('click', function() {
            closeModal($modalProduct);
        });
        
        cancelModalBtn.on('click', function() {
            closeModal($modalProduct);
        });
    });


    $mainSubmitBtn.on('click', function(event) {
        event.preventDefault();

        const productId    = $mainProductSelect.val()     as string;
        const quantity     = $mainQtyInput.val()     as string;
        const providerId   = $mainProviderSelect.val()   as string;
        const observations = $mainObsInput.val() as string;
    });
});