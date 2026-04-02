import { formatPrice } from "../../../utils/FormatPrice";
import type { RenderDashboardRecentSalesListParams } from "../../../types/Dashboard/DashboardGraphics";

export function renderDashboardRecentSalesList({ container, items }: RenderDashboardRecentSalesListParams): void {
    container.empty();

    if (!items || items.length === 0) {
        container.append(
            '<div class="text-sm text-text-light-secondary dark:text-text-dark-secondary">Sem vendas recentes no periodo.</div>'
        );
        return;
    }

    const timeFormatter = new Intl.DateTimeFormat("pt-BR", {
        hour: "2-digit",
        minute: "2-digit"
    });

    items.forEach((item) => {
        const formattedDate = new Date(String(item.created_at).replace(" ", "T"));
        const timeLabel     = Number.isNaN(formattedDate.getTime())
            ? "--:--"
            : timeFormatter.format(formattedDate);

        const locationLabel = item.location_name ?? "PDV nao informado";
        const productLabel  = item.product_name ?? "Produto nao informado";
        const totalSales    = formatPrice(Number(item.total_sales));

        container.append(
            `<div class="flex items-center justify-between rounded-lg border border-border-light dark:border-border-dark p-3">
                <div>
                    <p class="text-sm font-semibold">${timeLabel}</p>
                    <p class="text-xs text-text-light-secondary dark:text-text-dark-secondary">${productLabel}</p>
                    <p class="text-xs text-text-light-secondary dark:text-text-dark-secondary">${locationLabel}</p>
                </div>
                <p class="text-sm font-semibold">${totalSales}</p>
            </div>`
        );
    });
}