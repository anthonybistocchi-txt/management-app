import $ from 'jquery';
import "flatpickr/dist/flatpickr.css";
import { DatePicker } from '../../components/DatePicker/flatpickr';
import { showUserLogged } from '../../components/User/ShowUserLogged';
import { showGrapics } from '../../components/graphicDashboard/ShowGrapics';
import { graphicMovimentsSales } from '../../components/graphicDashboard/movimentsGraphic';
import { Toast } from '../../components/Swal/swal';

$(document).ready(async () => {
    const $username          = $('#text-header-username');
    const $typeUserId        = $('#text-header-type-user');
    const $totalSales        = $('#total_sales');
    const $topSellingProduct = $('#top_selling_product');
    const $datePickerId      = $("#date_range_picker"); 
    const $btn_submit        = $("#btn_submit");
    const $metricButtons     = $("#sales-metric-toggle [data-metric]");
  
    let currentMetric: "revenue" | "volume" = "revenue";
    let cachedDashboardData: DashboardData | null = null;

    await showUserLogged($username, $typeUserId);

    let startFilter: string = "";
    let endFilter:   string = "";

    DatePicker.initRange($datePickerId, (start, end) => {
        startFilter = start;
        endFilter   = end;
    });

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
            graphicMovimentsSales(
                cachedDashboardData.salesMovements,
                currentMetric,
                cachedDashboardData.salesMovementsPrevious
            );
            return;
        }

        $btn_submit.trigger("click");
        $btn_submit.html('Buscar').prop('disabled', false);
    });

    $btn_submit.on('click', async function(e) {
        e.preventDefault();

        $btn_submit.html('Buscando...').prop('disabled', true);
        
        try {
            const dashboardData = await showGrapics(
                startFilter, 
                endFilter, 
                $totalSales, 
                $topSellingProduct, 
                currentMetric
            );

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