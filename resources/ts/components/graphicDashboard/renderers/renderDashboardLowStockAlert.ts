import type { RenderDashboardLowStockAlertParams } from "../../../types/Dashboard/DashboardGraphics";

export function renderDashboardLowStockAlert({
    alertContainer,
    countContainer,
    messageContainer,
    lowStockCount
}: RenderDashboardLowStockAlertParams): void {
    const sanitizedLowStockCount = Number.isFinite(lowStockCount) ? lowStockCount : 0;
    const hasLowStock = sanitizedLowStockCount > 0;

    countContainer.text(sanitizedLowStockCount.toString());
    messageContainer.text(
        hasLowStock
            ? "Produtos estao com estoque abaixo do minimo."
            : "Nenhum produto abaixo do minimo."
    );
    alertContainer
        .toggleClass("border-red-200 bg-red-50 text-red-700", hasLowStock)
        .toggleClass("border-amber-200 bg-amber-50 text-amber-700", !hasLowStock);
}