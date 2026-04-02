import Chart from "chart.js/auto";
import $ from "jquery";
import { formatPrice } from "../../../utils/FormatPrice";
import type { RenderDashboardSalesByCategoryChartParams } from "../../../types/Dashboard/DashboardGraphics";
import { buildDashboardCategoryLegendItemHtml } from "../helpers/buildDashboardCategoryLegendItemHtml";
import { destroyDashboardChart } from "../helpers/destroyDashboardChart";

let categoryChartInstance: Chart | null = null;

const backgroundColors = ["#3b82f6", "#10b981", "#f97316", "#6b7280", "#8b5cf6", "#ec4899", "#eab308"];

export function renderDashboardSalesByCategoryChart({ data }: RenderDashboardSalesByCategoryChartParams): void {
    const $canvas = $("#sales_category_chart");
    const canvasElement = $canvas.get(0) as HTMLCanvasElement;
    const $legendContainer = $("#sales_category_legend");

    if (!canvasElement) {
        console.error("Canvas #sales_category_chart não encontrado.");
        return;
    }

    destroyDashboardChart(canvasElement, categoryChartInstance);
    categoryChartInstance = null;

    const labels        = data.map((item) => item.category_name);
    const salesValues   = data.map((item) => Number(item.total_sales));
    const totalSalesSum = salesValues.reduce((sum, value) => sum + value, 0);

    categoryChartInstance = new Chart(canvasElement, {
        type: "doughnut",
        data: {
            labels,
            datasets: [
                {
                    data: salesValues,
                    backgroundColor: backgroundColors,
                    borderWidth: 0,
                    hoverOffset: 4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: "70%",
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: (context) => {
                            let label = context.label || "";

                            if (label) {
                                label += ": ";
                            }

                            if (context.parsed !== null) {
                                label += formatPrice(Number(context.parsed));
                            }

                            return label;
                        }
                    }
                }
            }
        }
    });

    if ($legendContainer.length) {
        $legendContainer.empty();

        data.forEach((item, index) => {
            const salesNumber = Number(item.total_sales);
            const percent = totalSalesSum > 0 ? ((salesNumber / totalSalesSum) * 100).toFixed(1) : "0";
            const color = backgroundColors[index % backgroundColors.length];

            $legendContainer.append(
                buildDashboardCategoryLegendItemHtml({
                    item,
                    color,
                    percent
                })
            );
        });
    }
}