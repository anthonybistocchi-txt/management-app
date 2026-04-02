import type { DashboardSalesMetric, DashboardSalesMovement } from "../../types/Dashboard/DashboardGraphics";
import { renderDashboardSalesMovementsChart } from "./charts/renderDashboardSalesMovementsChart";

export function graphicMovimentsSales(
    data: DashboardSalesMovement[],
    metric: DashboardSalesMetric,
    previousData: DashboardSalesMovement[] = []
): void {
    renderDashboardSalesMovementsChart({
        data,
        metric,
        previousData
    });
}

export { renderDashboardSalesMovementsChart };
