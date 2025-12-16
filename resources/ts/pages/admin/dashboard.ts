import $ from 'jquery';
import flatpickr from "flatpickr";
import { Portuguese } from "flatpickr/dist/l10n/pt.js";
import "flatpickr/dist/flatpickr.css";
import { DashboardService } from '../../services/DashboardService';
import { Toast } from '../../components/swal';
import { formatPrice } from '../../types/Utils/FormatPrice';
import { graphicMovimentsSales } from '../../components/graphicAdm/movimentsGraphic';
import { graphicSalesByCategory } from '../../components/graphicAdm/categoriesGraphic';


$(document).ready(() => {
    const $username            = $('#user_name');
    const $typeUserId          = $('#type_user_id');
    const $totalSales          = $('#total_sales');
    const $topSellingProduct   = $('#top_selling_product');
    const $salesCategoryChart  = $('#sales_category_chart');
    const $datePickerId        = $("#date_range_picker"); 
    const $btn_submit          = $("#btn_submit");
    const originalText         = $btn_submit.html();

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

        try {
            const response: ApiResponse = await DashboardService.getDashboard(startFilter, endFilter);

            if (response.status && response.data) {
                const data = response.data;

                $totalSales.text(formatPrice(data.total_sales));

                if (data.product_top_sale) {
                    $topSellingProduct.text(data.product_top_sale.name);
                } 
              
                if (data.user_logged) {
                    $username.text(data.user_logged.username);
                    
                    if (data.user_logged.type_user_id == 1) {
                        $typeUserId.text('Administrador');
                    } else if (data.user_logged.type_user_id == 2) {
                        $typeUserId.text('Gestor');
                    } else {
                        $typeUserId.text('Usuário');
                    }
                }
                
                graphicMovimentsSales(data.moviments_sales);
                graphicSalesByCategory(data.sales_categorys);
            }

        } catch (error) {
            console.error("Fluxo interrompido:", error);
            Toast.error("Erro ao buscar dados.");
            
        } finally {
            $btn_submit.html(originalText).prop('disabled', false);
        }
    });

});