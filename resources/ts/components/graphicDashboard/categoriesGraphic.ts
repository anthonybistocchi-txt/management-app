import Chart from "chart.js/auto";
import $ from "jquery";
import { formatPrice } from "../../utils/FormatPrice";

let categoryChartInstance: Chart | null = null;

export function graphicSalesByCategory(data: CategoryData[]) {
    const $canvas          = $('#sales_category_chart');
    const canvasElement    = $canvas.get(0) as HTMLCanvasElement;
    const $legendContainer = $('#sales_category_legend'); 

    if (!canvasElement) {
        console.error("Canvas #sales_category_chart não encontrado.");
        return;
    }

    const existingChart = Chart.getChart(canvasElement);
    if (existingChart) {
        existingChart.destroy();
    }
    if (categoryChartInstance) {
        categoryChartInstance.destroy();
        categoryChartInstance = null;
    }

    const backgroundColors = ['#3b82f6', '#10b981', '#f97316', '#6b7280', '#8b5cf6', '#ec4899', '#eab308'];

    const labels      = data.map(item => item.category_name);
    const salesValues = data.map(item => parseFloat(item.total_sales)); 

    const totalSalesSum = salesValues.reduce((a, b) => a + b, 0);

    categoryChartInstance = new Chart(canvasElement, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: salesValues.map(value => value / 100), // de centavos para reais
                backgroundColor: backgroundColors,
                borderWidth: 0, 
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%', 
            plugins: {
                legend: {
                    display: false 
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed !== null) {
                                label += new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(context.parsed);
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
            const salesNumber = parseFloat(item.total_sales);
            const finalPrice  = formatPrice(salesNumber);

            const percent = totalSalesSum > 0 ? ((salesNumber / totalSalesSum) * 100).toFixed(1) : '0';
            const color   = backgroundColors[index % backgroundColors.length];

            const htmlItem = `
                <div class="group flex items-center justify-between p-4 rounded-xl bg-gray-50 border border-gray-200 hover:bg-white hover:border-blue-300 hover:shadow-md transition-all duration-200 cursor-default">

                    <div class="flex items-center gap-4">
                        <div class="relative flex items-center justify-center w-8 h-8 rounded-full bg-white border border-gray-100 shadow-sm">
                            <span class="w-3 h-3 rounded-full" 
                                style="background-color: ${color}; box-shadow: 0 0 6px ${color}60;">
                            </span>
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

            $legendContainer.append(htmlItem);
        });
    }
}