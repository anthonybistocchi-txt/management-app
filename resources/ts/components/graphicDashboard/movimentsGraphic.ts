import type { DashboardSalesMetric, DashboardSalesMovement } from "../../types/Dashboard/DashboardGraphics";
import { renderDashboardSalesMovementsChart } from "./charts/renderDashboardSalesMovementsChart";

export function graphicMovimentsSales(
    data: DashboardSalesMovement[],
    metric: DashboardSalesMetric,
    previousData: DashboardSalesMovement[] = [],
    dateFrom?: string,
    dateTo?: string
): void {
    renderDashboardSalesMovementsChart({
        data,
        metric,
        previousData,
        dateFrom,
        dateTo
    });
}

export { renderDashboardSalesMovementsChart };
