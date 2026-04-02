import { formatPrice } from "../../../utils/FormatPrice";
import type { DashboardSalesByCategory } from "../../../types/Dashboard/DashboardGraphics";

interface BuildDashboardCategoryLegendItemHtmlParams {
    item: DashboardSalesByCategory;
    color: string;
    percent: string;
}

export function buildDashboardCategoryLegendItemHtml({ item, color, percent }: BuildDashboardCategoryLegendItemHtmlParams): string {
    const finalPrice = formatPrice(item.total_sales);

    return `
        <div class="group flex items-center justify-between p-4 rounded-xl bg-gray-50 border border-gray-200 hover:bg-white hover:border-blue-300 hover:shadow-md transition-all duration-200 cursor-default">
            <div class="flex items-center gap-4">
                <div class="relative flex items-center justify-center w-8 h-8 rounded-full bg-white border border-gray-100 shadow-sm">
                    <span class="w-3 h-3 rounded-full" style="background-color: ${color}; box-shadow: 0 0 6px ${color}60;"></span>
                </div>

                <div class="flex flex-col">
                    <span class="text-sm font-bold text-gray-700 group-hover:text-gray-900 transition-colors" title="${item.category_name}">
                        ${item.category_name}
                    </span>
                    <div class="flex items-center gap-2 mt-0.5">
                        <span class="text-xs text-gray-700 font-medium px-2 py-0.5 rounded-md">
                            ${item.total_quantity} vendas
                        </span>
                        <span class="text-xs text-gray-400 font-medium">
                            ${percent}%
                        </span>
                    </div>
                </div>
            </div>

            <div class="text-right">
                <span class="block font-bold text-gray-800 text-base tracking-tight">
                    ${finalPrice}
                </span>
            </div>
        </div>
    `;
}