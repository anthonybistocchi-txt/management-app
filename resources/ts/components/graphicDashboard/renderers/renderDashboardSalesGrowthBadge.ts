import { calculateDashboardGrowthPercent } from "../helpers/calculateDashboardGrowthPercent";
import type { RenderDashboardSalesGrowthBadgeParams } from "../../../types/Dashboard/DashboardGraphics";

export function renderDashboardSalesGrowthBadge({
    container,
    totalSalesValue,
    totalSalesValuePrevious
}: RenderDashboardSalesGrowthBadgeParams): void {

    const growthPercent = calculateDashboardGrowthPercent(totalSalesValue, totalSalesValuePrevious);
    const isPositive    = growthPercent >= 0;
    const growthText    = `${growthPercent >= 0 ? "+" : ""}${growthPercent.toFixed(0)}% vs. periodo anterior`;
    const iconName      = isPositive ? "north_east" : "south_east";

    container
        .toggleClass("bg-green-100 text-green-700", isPositive)
        .toggleClass("bg-red-100 text-red-700", !isPositive)
        .html(`<span class="material-symbols-outlined text-[16px]">${iconName}</span>${growthText}`);
}