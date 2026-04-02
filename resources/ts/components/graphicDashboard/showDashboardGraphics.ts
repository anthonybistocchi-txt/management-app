import { DashboardController } from "../../Controllers/Dashboard/DashboardController";
import { formatPrice } from "../../utils/FormatPrice";
import { Toast } from "../Swal/swal";
import type { ShowDashboardGraphicsParams } from "../../types/Dashboard/DashboardGraphics";
import { validateDashboardDateRange } from "./helpers/validateDashboardDateRange";
import { renderDashboardLowStockAlert } from "./renderers/renderDashboardLowStockAlert";
import { renderDashboardRecentSalesList } from "./renderers/renderDashboardRecentSalesList";
import { renderDashboardSalesGrowthBadge } from "./renderers/renderDashboardSalesGrowthBadge";
import { renderDashboardSalesMovementsChart } from "./charts/renderDashboardSalesMovementsChart";
import { renderDashboardSalesByCategoryChart } from "./charts/renderDashboardSalesByCategoryChart";
import { renderDashboardTopProductsTable } from "./renderers/renderDashboardTopProductsTable";

export async function showDashboardGraphics({
    startFilter,
    endFilter,
    metric,
    elements
}: ShowDashboardGraphicsParams): Promise<DashboardData | null> {
    const validationResult = validateDashboardDateRange(startFilter, endFilter);

    if (validationResult) 
    {
        if (validationResult.kind === "info") 
        {
            Toast.info(validationResult.message);
        } 
        else 
        {
            Toast.error(validationResult.message);
        }

        return null;
    }

    const dashboardData = await DashboardController.getDashboardData(startFilter, endFilter);

    if (!dashboardData) {
        console.error("Erro ao carregar os dados do dashboard.");
        Toast.error("Nao foi possivel carregar os dados do dashboard.");
        return null;
    }

    const totalSalesValue         = Number(dashboardData.totalSalesValue) || 0;
    const totalSalesValuePrevious = Number(dashboardData.totalSalesValuePrevious) || 0;
    const totalOrders             = Number(dashboardData.totalOrders) || 0;

    elements.totalSales.text(formatPrice(totalSalesValue));
    elements.topSellingProduct.text(dashboardData.topSellingProduct?.name ?? "—");
    elements.totalOrders.text(totalOrders.toLocaleString("pt-BR"));

    const averageTicket = totalOrders > 0 ? totalSalesValue / totalOrders : 0;
    elements.averageTicket.text(formatPrice(averageTicket));

    renderDashboardSalesGrowthBadge({
        container: elements.totalSalesGrowth,
        totalSalesValue,
        totalSalesValuePrevious
    });

    renderDashboardTopProductsTable({
        container: elements.topProductsBody,
        items:     dashboardData.topProducts
    });

    renderDashboardRecentSalesList({
        container: elements.recentSalesList,
        items: dashboardData.recentSales
    });

    renderDashboardLowStockAlert({
        alertContainer:   elements.lowStockAlert,
        countContainer:   elements.lowStockCount,
        messageContainer: elements.lowStockMessage,
        lowStockCount:    Number(dashboardData.lowStockCount) || 0
    });

    renderDashboardSalesMovementsChart({
        data: dashboardData.salesMovements,
        metric,
        previousData: dashboardData.salesMovementsPrevious,
        dateFrom: startFilter,
        dateTo: endFilter
    });

    renderDashboardSalesByCategoryChart({
        data: dashboardData.salesByCategory
    });

    return dashboardData;
}