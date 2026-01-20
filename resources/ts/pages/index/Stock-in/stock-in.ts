import flatpickr from "flatpickr";
import { Portuguese } from "flatpickr/dist/l10n/pt";
import $ from "jquery";
import { openModal } from "../../../utils/openModal";
import { closeModal } from "../../../utils/CloseModal";

// Importando nossos novos controladores
import { getProviders } from "./getProviders"; 
import { getProducts } from "./getProducts"; 
import { StockInForm } from "./stockInForm"; 

$(document).ready(() => {

    const UI = {
        modal: {
            container:      $('#modal-product'),
            btnOpen:        $('#btn-add-product'),
            btnClose:       $('#close-modal, #cancel-modal'),
            selectProvider: $('#provider-new-product')
        },
        form: {
            selectProduct:  $('#products'),
            selectProvider: $('#providers'),
            inputQty:       $('#quantity'),
            inputDate:      $('#date_picker'),
            inputObs:       $('#observations'),
            btnSave:        $('#btn-save')
        }
    };

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

    getProducts.loadProducts(UI.form.selectProduct);

    getProviders.loadProviders([UI.form.selectProvider, UI.modal.selectProvider]);

    UI.modal.btnOpen.on('click', function() {
        
        openModal(UI.modal.container);
    });

    UI.modal.btnClose.on('click', function() {
        closeModal(UI.modal.container);
    });

    UI.form.btnSave.on('click', (event) => {
        StockInForm.handleSubmit(event, {
            $product:  UI.form.selectProduct,
            $qty:      UI.form.inputQty,
            $provider: UI.form.selectProvider,
            $obs:      UI.form.inputObs,
            $date:     UI.form.inputDate,
            $btn:      UI.form.btnSave
        }, dateValue);
    });
});