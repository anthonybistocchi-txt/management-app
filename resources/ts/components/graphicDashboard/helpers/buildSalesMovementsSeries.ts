import type { DashboardSalesMetric, DashboardSalesMovement } from "../../../types/Dashboard/DashboardGraphics";

export function buildSalesMovementsSeries(data: DashboardSalesMovement[], metric: DashboardSalesMetric) {
    const labels: string[] = [];
    const values: number[] = [];
    const valueByDate = new Map<string, number>();

    data.forEach((item) => {
        if (!valueByDate.has(item.sell_date)) {
            valueByDate.set(item.sell_date, 0);
            labels.push(item.sell_date);
        }

        const currentValue = valueByDate.get(item.sell_date) ?? 0;
        const nextValue    = metric === "revenue" ? Number(item.total_sales ?? 0) : item.total_sold;
        
        valueByDate.set(item.sell_date, currentValue + nextValue);
    });

    labels.forEach((date) => {
        values.push(valueByDate.get(date) ?? 0);
    });

    return { labels, values };
}