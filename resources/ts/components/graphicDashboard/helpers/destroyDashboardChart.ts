import Chart from "chart.js/auto";

export function destroyDashboardChart(canvasElement: HTMLCanvasElement, chartInstance: Chart | null): void {
    const existingChart = Chart.getChart(canvasElement);

    if (existingChart) {
        existingChart.destroy();
    }

    if (chartInstance && chartInstance !== existingChart) {
        chartInstance.destroy();
    }
}