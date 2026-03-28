import Chart from "chart.js/auto";
import $ from "jquery";
import { dateformat } from "../../utils/DateRange";
import { formatPrice } from "../../utils/FormatPrice";


let chartInstance: Chart | null = null;

type SalesMetric = "revenue" | "volume";
type SalesMovement = {
    total_sold: number;
    total_sales?: number;
    sell_date: string;
};

const buildSeries = (data: SalesMovement[], metric: SalesMetric) => {
    const labels: string[] = [];
    const values: number[] = [];
    const valueByDate = new Map<string, number>();

    data.forEach((item) => {
        if (!valueByDate.has(item.sell_date)) {
            valueByDate.set(item.sell_date, 0);
            labels.push(item.sell_date);
        }

        const currentValue = valueByDate.get(item.sell_date) ?? 0;
        const nextValue = metric === "revenue" ? Number(item.total_sales ?? 0) : item.total_sold;
        valueByDate.set(item.sell_date, currentValue + nextValue);
    });

    labels.forEach((date) => {
        values.push(valueByDate.get(date) ?? 0);
    });

    return { labels, values };
};

export function graphicMovimentsSales(data: SalesMovement[], metric: SalesMetric, previousData: SalesMovement[] = []) {
    const $graphic      = $('#moviments_sales_chart');
    const canvasElement = $graphic.get(0) as HTMLCanvasElement;

    if (!canvasElement) {
        console.error("Canvas #moviments_sales_chart não encontrado.");
        return;
    }

    const existingChart = Chart.getChart(canvasElement);
    
    if (existingChart) {
        existingChart.destroy();
    }
    
    if (chartInstance) {
        chartInstance.destroy();
        chartInstance = null;
    }
    
    const currentSeries = buildSeries(data, metric);
    const previousSeries = buildSeries(previousData, metric);
    const labels = currentSeries.labels;
    const values = currentSeries.values;
    const previousValues = labels.map((_, index) => previousSeries.values[index] ?? null);
    const labelText = metric === "revenue" ? "Faturamento" : "Quantidade de vendas";
    
    chartInstance = new Chart(canvasElement, {
        type: 'line',
        data: {
            labels: labels.map(dateStr => dateformat(dateStr)),
            datasets: [
                {
                    label: labelText,
                    data: values,
                    borderColor: '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.1)',
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.3
                },
                {
                    label: "Periodo anterior",
                    data: previousValues,
                    borderColor: '#94a3b8',
                    backgroundColor: 'rgba(148, 163, 184, 0.12)',
                    borderWidth: 2,
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    borderDash: [6, 4],
                    fill: false,
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: true },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        label: (context) => {
                            const value = Number(context.raw ?? 0);
                            return metric === "revenue" ? formatPrice(value) : `${value}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: metric === "revenue" ? undefined : 1,
                        callback: (value) => metric === "revenue" ? formatPrice(Number(value)) : `${value}`
                    }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
}