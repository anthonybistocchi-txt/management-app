import type { DashboardSalesMetric, DashboardSalesMovement } from "../../../types/Dashboard/DashboardGraphics";
import { eachDayInclusive } from "../../../utils/dashboardPeriodDates";

function aggregateByDate(
    data: DashboardSalesMovement[],
    metric: DashboardSalesMetric,
): Map<string, number> {
    const map = new Map<string, number>();

    data.forEach((item) => {
        const raw = item.sell_date;
        const key = typeof raw === "string" ? raw.slice(0, 10) : "";
        if (!key) {
            return;
        }

        const add =
            metric === "revenue"
                ? Number(item.total_sales ?? 0)
                : Number(item.total_sold ?? 0);

        if (!Number.isFinite(add)) {
            return;
        }

        map.set(key, (map.get(key) ?? 0) + add);
    });

    return map;
}

/**
 * Série para o gráfico: valores em centavos (faturamento) ou unidades (volume).
 * Com `dateFrom`/`dateTo`, preenche todos os dias do intervalo (0 nos dias sem venda).
 */
export function buildSalesMovementsSeries(
    data: DashboardSalesMovement[],
    metric: DashboardSalesMetric,
    dateFrom?: string,
    dateTo?: string,
): { labels: string[]; values: number[] } {
    const byDate = aggregateByDate(data, metric);

    if (!dateFrom?.trim() || !dateTo?.trim()) {
        const labels = [...byDate.keys()].sort();
        const values = labels.map((d) => Number(byDate.get(d) ?? 0));

        return { labels, values };
    }

    const spine = eachDayInclusive(dateFrom, dateTo);
    const values = spine.map((d) => Number(byDate.get(d) ?? 0));

    return { labels: spine, values };
}
