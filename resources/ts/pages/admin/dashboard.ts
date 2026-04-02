import $ from 'jquery';
import "flatpickr/dist/flatpickr.css";
import { DatePicker } from '../../components/DatePicker/flatpickr';
import { showUserLogged } from '../../components/User/ShowUserLogged';
import { showDashboardGraphics } from '../../components/graphicDashboard/showDashboardGraphics'; 
import { renderDashboardSalesMovementsChart } from '../../components/graphicDashboard/movimentsGraphic'; 
import type { DashboardSalesMetric } from '../../types/Dashboard/DashboardGraphics';

$(document).ready(async () => {
    const $username          = $('#text-header-username');
    const $typeUserId        = $('#text-header-type-user');
    const $totalSales        = $('#total_sales');
    const $topSellingProduct = $('#top_selling_product');
    const $averageTicket     = $('#average_ticket');
    const $totalOrders       = $('#total_orders');
    const $totalSalesGrowth  = $('#total_sales_growth');
    const $topProductsBody   = $('#top_products_table');
    const $recentSalesList   = $('#recent_sales_list');
    const $lowStockAlert     = $('#low_stock_alert');
    const $lowStockCount     = $('#low_stock_count');
    const $lowStockMessage   = $('#low_stock_message');
    const $datePickerId      = $("#date_range_picker"); 
    const $btn_submit        = $("#btn_submit");
    const $metricButtons     = $("#sales-metric-toggle [data-metric]");
  
    let currentMetric: DashboardSalesMetric = "revenue";
    let cachedDashboardData: DashboardData | null = null;

    await showUserLogged($username, $typeUserId);

    let startFilter: string = "";
    let endFilter:   string = "";

    DatePicker.initRange($datePickerId, (start, end) => {
        startFilter = start;
        endFilter   = end;
    });

    const renderCachedSalesMovements = () => {
        if (!cachedDashboardData) {
            return;
        }

        renderDashboardSalesMovementsChart({
            data: cachedDashboardData.salesMovements,
            metric: currentMetric,
            previousData: cachedDashboardData.salesMovementsPrevious,
            dateFrom: startFilter,
            dateTo: endFilter
        });
    };

    const setMetricButtonState = () => {
        $metricButtons.each((_, button) => {
            const $button = $(button);
            const metric = String($button.data("metric"));
            const isActive = metric === currentMetric;
            $button
                .toggleClass("bg-primary text-white", isActive)
                .toggleClass("text-slate-600 hover:text-slate-900", !isActive);
        });
    };

    $metricButtons.on("click", async function () {
        const metric = String($(this).data("metric"));

        if (metric !== "revenue" && metric !== "volume") {
            $btn_submit.html('Buscar').prop('disabled', false);
            return;
        }

        currentMetric = metric;
        setMetricButtonState();

        if (cachedDashboardData) {
            renderCachedSalesMovements();
            return;
        }

        $btn_submit.trigger("click");
        $btn_submit.html('Buscar').prop('disabled', false);
    });

    $btn_submit.on('click', async function(e) {
        e.preventDefault();

        $btn_submit.html('Buscando...').prop('disabled', true);
        
        try {
            const dashboardData = await showDashboardGraphics({
                startFilter,
                endFilter,
                metric: currentMetric,
                elements: {
                    totalSales: $totalSales,
                    topSellingProduct: $topSellingProduct,
                    averageTicket: $averageTicket,
                    totalOrders: $totalOrders,
                    totalSalesGrowth: $totalSalesGrowth,
                    topProductsBody: $topProductsBody,
                    recentSalesList: $recentSalesList,
                    lowStockAlert: $lowStockAlert,
                    lowStockCount: $lowStockCount,
                    lowStockMessage: $lowStockMessage
                }
            });

            if (dashboardData) {
                cachedDashboardData = dashboardData;
            }
        } catch (error) {
            console.error("Erro ao buscar gráficos:", error);
        } finally {
            $btn_submit.html('Buscar').prop('disabled', false);
        }
    });

    setMetricButtonState();
    $btn_submit.trigger('click')
    
});