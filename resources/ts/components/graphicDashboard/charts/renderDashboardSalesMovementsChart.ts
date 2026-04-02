import Chart from "chart.js/auto";
import $ from "jquery";
import { dateformat } from "../../../utils/DateRange";
import { formatPrice } from "../../../utils/FormatPrice";
import type { RenderDashboardSalesMovementsChartParams } from "../../../types/Dashboard/DashboardGraphics";
import { buildSalesMovementsSeries } from "../helpers/buildSalesMovementsSeries";
import { destroyDashboardChart } from "../helpers/destroyDashboardChart";
import { getPreviousPeriodRange } from "../../../utils/dashboardPeriodDates";

let chartInstance: Chart | null = null;

export function renderDashboardSalesMovementsChart({
    data,
    metric,
    previousData = [],
    dateFrom,
    dateTo
}: RenderDashboardSalesMovementsChartParams): void {
    const $graphic      = $("#moviments_sales_chart");
    const canvasElement = $graphic.get(0) as HTMLCanvasElement;

    if (!canvasElement) 
    {
        console.error("Canvas #moviments_sales_chart não encontrado.");
        return;
    }

    destroyDashboardChart(canvasElement, chartInstance);
    chartInstance = null;

    const hasRange = Boolean(dateFrom?.trim() && dateTo?.trim());
    const prevRange = hasRange ? getPreviousPeriodRange(dateFrom!, dateTo!) : null;

    const currentSeries = hasRange
        ? buildSalesMovementsSeries(data, metric, dateFrom, dateTo)
        : buildSalesMovementsSeries(data, metric);

    const previousSeries =
        hasRange && prevRange
            ? buildSalesMovementsSeries(previousData, metric, prevRange.from, prevRange.to)
            : buildSalesMovementsSeries(previousData, metric);

    const labels = currentSeries.labels;
    const values = currentSeries.values;

    const previousValues = hasRange
        ? labels.map((_, i) => Number(previousSeries.values[i] ?? 0))
        : labels.map((_, index) => previousSeries.values[index] ?? null);
    const labelText      = metric === "revenue" ? "Faturamento" : "Quantidade de vendas";

    chartInstance = new Chart(canvasElement, {
        type: "line",
        data: {
            labels: labels.map((dateStr) => dateformat(dateStr)),
            datasets: [
                {
                    label: labelText,
                    data: values,
                    borderColor: "#007bff",
                    backgroundColor: "rgba(0, 123, 255, 0.1)",
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.3
                },
                {
                    label: "Periodo anterior",
                    data: previousValues,
                    borderColor: "#94a3b8",
                    backgroundColor: "rgba(148, 163, 184, 0.12)",
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
                legend: {
                    display: true
                },
                tooltip: {
                    mode: "index",
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
                        callback: (value) => (metric === "revenue" ? formatPrice(Number(value)) : `${value}`)
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
}