import { formatPrice } from "../../../utils/FormatPrice";
import type { RenderDashboardTopProductsTableParams } from "../../../types/Dashboard/DashboardGraphics";

export function renderDashboardTopProductsTable({ container, items }: RenderDashboardTopProductsTableParams): void {
    container.empty();

    if (!items || items.length === 0) {
        container.append(
            '<tr><td colspan="3" class="py-4 text-center text-sm text-text-light-secondary dark:text-text-dark-secondary">Sem dados no periodo.</td></tr>'
        );
        return;
    }

    items.forEach((item, index) => {
        const totalSales = formatPrice(Number(item.total_sales));

        container.append(
            `<tr class="border-b border-border-light dark:border-border-dark">
                <td class="py-2 text-sm font-semibold">#${index + 1}</td>
                <td class="py-2 text-sm">${item.name}</td>
                <td class="py-2 text-sm text-right font-semibold">${totalSales}</td>
            </tr>`
        );
    });
}