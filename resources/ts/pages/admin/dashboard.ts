import $ from 'jquery';
import flatpickr from "flatpickr";
import { Portuguese } from "flatpickr/dist/l10n/pt.js";
import "flatpickr/dist/flatpickr.css";
import { DashboardService } from '../../services/DashboardService';
import { Toast } from '../../components/swal';
import { formatPrice } from '../../types/Utils/FormatPrice';


$(document).ready(() => {
    // --- SELETORES ---
    const $username            = $('#user_name');
    const $typeUserId          = $('#type_user_id');
    const $totalSales          = $('#total_sales');
    const $topSellingProduct   = $('#top_selling_product');
    const $movimentsSalesChart = $('#moviments_sales_chart');
    const $salesCategoryChart  = $('#sales_category_chart');
    const $datePickerId        = $("#date_range_picker"); 
    const $btn_submit          = $("#btn_submit");

    let startFilter: string | null = null;
    let endFilter:   string | null = null;

    // const today = new Date();
    // const fourteen = new Date();
    // fourteen.setDate(today.getDate() - 14);

    flatpickr($datePickerId, {
        mode: "range",
        dateFormat: "d/m/Y",
        locale: Portuguese, 
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

        const originalText = $btn_submit.html();
        $btn_submit.html('Buscando...').prop('disabled', true);

        try {
            const response: ApiResponse = await DashboardService.getDashboard(startFilter, endFilter);

            if (response.status && response.data) {
                const data = response.data;
                console.log("Dados do dashboard recebidos:", data);

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

                updateCharts(data.moviments_sales, data.sales_categorys);
            }

        } catch (error) {
            console.error("Fluxo interrompido:", error);
        } finally {
            $btn_submit.html(originalText).prop('disabled', false);
        }
    });

    
    function updateCharts(movements: any[], categories: any[]) {
        console.log("Dados recebidos para gráficos:", movements, categories);
 
    }
});