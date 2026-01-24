import Chart from "chart.js/auto"; 
import $ from "jquery";
import { dateformat } from "../../types/Utils/DateRange";

let chartInstance: Chart | null = null;

export function graphicMovimentsSales(data: { total_sold: number; sell_date: string }[]) {
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
    
    const labels = data.map(item => item.sell_date);
    const values = data.map(item => item.total_sold );
    
    chartInstance = new Chart(canvasElement, {
        type: 'line',
        data: {
            labels: labels.map(dateStr => dateformat(dateStr)),
            datasets: [{
                label: 'Quantidade de vendas',
                data: values,
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                borderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: true },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });
}