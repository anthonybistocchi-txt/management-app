import Chart from "chart.js/auto";
import $ from "jquery";
import { formatPrice, formatPriceAxisCompact } from "../../../utils/FormatPrice";
import type {
    DashboardSalesByCategory,
    RenderDashboardSalesByCategoryChartParams,
} from "../../../types/Dashboard/DashboardGraphics";
import { destroyDashboardChart } from "../helpers/destroyDashboardChart";

let categoryChartInstance: Chart | null = null;

const BAR_COLORS = [
    "#3b82f6",
    "#10b981",
    "#f97316",
    "#8b5cf6",
    "#ec4899",
    "#06b6d4",
    "#84cc16",
    "#eab308",
    "#64748b",
    "#f43f5e",
    "#6366f1",
    "#14b8a6",
];

/** Quantidade máxima de barras no gráfico; o restante vira “Demais” + tabela completa abaixo. */
const CHART_TOP_N = 12;

interface ChartRow {
    label: string;
    sales: number;
    qty: number;
    isDemais: boolean;
}

function buildChartRows(sorted: DashboardSalesByCategory[]): ChartRow[] {
    const top = sorted.slice(0, CHART_TOP_N);
    const rest = sorted.slice(CHART_TOP_N);

    const rows: ChartRow[] = top.map((item) => ({
        label: item.category_name,
        sales: Number(item.total_sales),
        qty: Number(item.total_quantity ?? 0),
        isDemais: false,
    }));

    if (rest.length > 0) {
        const sales = rest.reduce((s, x) => s + Number(x.total_sales), 0);
        const qty = rest.reduce((s, x) => s + Number(x.total_quantity ?? 0), 0);
        rows.push({
            label: `Demais (${rest.length} categorias)`,
            sales,
            qty,
            isDemais: true,
        });
    }

    return rows;
}

function renderCategoryTable(sorted: DashboardSalesByCategory[], totalSalesSum: number): void {
    const $tbody = $("#sales_category_table_body");
    if (!$tbody.length) {
        return;
    }

    $tbody.empty();

    sorted.forEach((item) => {
        const sales = Number(item.total_sales);
        const pct = totalSalesSum > 0 ? ((sales / totalSalesSum) * 100).toFixed(1) : "0";

        $("<tr/>")
            .addClass("hover:bg-slate-50 dark:hover:bg-slate-800/40")
            .append(
                $("<td/>")
                    .addClass(
                        "px-3 py-2 text-text-light-primary dark:text-text-dark-primary max-w-[min(100%,280px)] truncate",
                    )
                    .attr("title", item.category_name)
                    .text(item.category_name),
                $("<td/>")
                    .addClass("px-3 py-2 text-right tabular-nums text-text-light-secondary dark:text-text-dark-secondary")
                    .text(Number(item.total_quantity ?? 0).toLocaleString("pt-BR")),
                $("<td/>")
                    .addClass("px-3 py-2 text-right tabular-nums text-text-light-secondary dark:text-text-dark-secondary")
                    .text(`${pct}%`),
                $("<td/>")
                    .addClass("px-3 py-2 text-right font-medium tabular-nums text-text-light-primary dark:text-text-dark-primary")
                    .text(formatPrice(sales)),
            )
            .appendTo($tbody);
    });
}

export function renderDashboardSalesByCategoryChart({ data }: RenderDashboardSalesByCategoryChartParams): void {
    const $canvas = $("#sales_category_chart");
    const canvasElement = $canvas.get(0) as HTMLCanvasElement;

    if (!canvasElement) {
        console.error("Canvas #sales_category_chart não encontrado.");
        return;
    }

    destroyDashboardChart(canvasElement, categoryChartInstance);
    categoryChartInstance = null;

    const sorted = [...data].sort((a, b) => Number(b.total_sales) - Number(a.total_sales));
    const totalSalesSum = sorted.reduce((sum, x) => sum + Number(x.total_sales), 0);

    renderCategoryTable(sorted, totalSalesSum);

    const chartRows = buildChartRows(sorted);
    const labels = chartRows.map((r) => r.label);
    const salesValues = chartRows.map((r) => r.sales);
    const colors = chartRows.map((r, i) =>
        r.isDemais ? "#94a3b8" : BAR_COLORS[i % BAR_COLORS.length],
    );

    categoryChartInstance = new Chart(canvasElement, {
        type: "bar",
        data: {
            labels,
            datasets: [
                {
                    data: salesValues,
                    backgroundColor: colors,
                    borderWidth: 0,
                    borderRadius: 4,
                    categoryPercentage: 0.75,
                    barPercentage: 0.85,
                },
            ],
        },
        options: {
            indexAxis: "y",
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: { left: 4, right: 12, top: 8, bottom: 8 },
            },
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    callbacks: {
                        title: (items) => {
                            const i = items[0]?.dataIndex ?? 0;
                            return chartRows[i]?.label ?? "";
                        },
                        label: (ctx) => {
                            const i = ctx.dataIndex;
                            const row = chartRows[i];
                            if (!row) {
                                return [];
                            }
                            const pct =
                                totalSalesSum > 0 ? ((row.sales / totalSalesSum) * 100).toFixed(1) : "0";
                            const lines = [
                                `Faturamento: ${formatPrice(row.sales)}`,
                                `Volume: ${row.qty.toLocaleString("pt-BR")} un. (${pct}% do total)`,
                            ];
                            if (row.isDemais) {
                                lines.push("Soma das categorias fora do top 12.");
                            }

                            return lines;
                        },
                    },
                },
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        callback: (value) => formatPriceAxisCompact(Number(value)),
                        maxTicksLimit: 6,
                    },
                    grid: {
                        color: "rgba(148, 163, 184, 0.25)",
                    },
                },
                y: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 0,
                        font: { size: 11 },
                        padding: 8,
                        callback: function (_tickValue: string | number, index: number) {
                            const raw = labels[index] ?? "";
                            const text = String(raw);
                            return text.length > 40 ? `${text.slice(0, 38)}…` : text;
                        },
                    },
                    grid: {
                        display: false,
                    },
                },
            },
        },
    });
}
