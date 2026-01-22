import $ from 'jquery';
import flatpickr from "flatpickr";
import { Portuguese } from "flatpickr/dist/l10n/pt.js";
import "flatpickr/dist/flatpickr.css";
import { Toast } from '../../components/Swal/swal';
import { getUserLoggedController } from '../../Controllers/User/getUserLogged';
import { DashboardController } from '../../Controllers/Dashboard/Dashboard';

$(document).ready(() => {
    const $username            = $('#user_name');
    const $typeUserId          = $('#type_user_id');
    const $totalSales          = $('#total_sales');
    const $topSellingProduct   = $('#top_selling_product');
    const $salesCategoryChart  = $('#sales_category_chart');
    const $datePickerId        = $("#date_range_picker"); 
    const $btn_submit          = $("#btn_submit");
    const originalText         = $btn_submit.html();

    getUserLoggedController.loadUserLogged($username, $typeUserId);

    let startFilter: string;
    let endFilter:   string;

    const today        = new Date();
    const sevenDaysAgo = new Date();

    sevenDaysAgo.setDate(today.getDate() - 7);

    flatpickr($datePickerId, {
        mode: "range",
        dateFormat: "d/m/Y",
        locale: Portuguese, 
        defaultDate: [sevenDaysAgo, today],
        onReady: (dates, str, instance) => {
            if (dates.length === 2) {
                startFilter = instance.formatDate(dates[0], "Y-m-d");
                endFilter   = instance.formatDate(dates[1], "Y-m-d");
            }
        },
        onChange: (dates, str, instance) => {
            if (dates.length === 2) {
                startFilter = instance.formatDate(dates[0], "Y-m-d");
                endFilter   = instance.formatDate(dates[1], "Y-m-d");
            }
        }
    });

    $btn_submit.on('click', async function(e) {
        e.preventDefault();
        if (!startFilter || !endFilter) {
            Toast.info("Selecione uma data completa"); 
            return;
        }

        $btn_submit.html('Buscando...').prop('disabled', true);

        await DashboardController.loadDashboard(startFilter, endFilter, $totalSales, $topSellingProduct);
    });

    $btn_submit.trigger('click')
    $btn_submit.html(originalText).prop('disabled', false);
});