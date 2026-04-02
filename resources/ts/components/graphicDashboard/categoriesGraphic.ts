import type { DashboardSalesByCategory } from "../../types/Dashboard/DashboardGraphics";
import { renderDashboardSalesByCategoryChart } from "./charts/renderDashboardSalesByCategoryChart";

export function graphicSalesByCategory(data: DashboardSalesByCategory[]): void {
    renderDashboardSalesByCategoryChart({ data });
}

export { renderDashboardSalesByCategoryChart };
