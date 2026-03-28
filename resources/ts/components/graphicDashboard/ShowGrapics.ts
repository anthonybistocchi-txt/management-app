import { DashboardController } from "../../Controllers/Dashboard/DashboardController";
import { formatPrice } from "../../utils/FormatPrice";
import { Toast } from "../Swal/swal";
import { graphicSalesByCategory } from "./categoriesGraphic";
import { graphicMovimentsSales } from "./movimentsGraphic";

type SalesMetric = "revenue" | "volume";

export async function showGrapics(
    startFilter:        string,
    endFilter:          string,
    $totalSales:        JQuery<HTMLElement>,
    $topSellingProduct: JQuery<HTMLElement>,
    $averageTicket:     JQuery<HTMLElement>,
    $totalOrders:       JQuery<HTMLElement>,
    $totalSalesGrowth:  JQuery<HTMLElement>,
    $topProductsBody:   JQuery<HTMLElement>,
    $recentSalesList:   JQuery<HTMLElement>,
    $lowStockAlert:     JQuery<HTMLElement>,
    $lowStockCount:     JQuery<HTMLElement>,
    $lowStockMessage:   JQuery<HTMLElement>,
    metric: SalesMetric
): Promise<DashboardData | null> {
    const DashbaordData = await DashboardController.getDashboardData(startFilter, endFilter);

    if (!startFilter || !endFilter) 
    {
        Toast.info("Selecione uma data completa"); 
        return null;
    }

    if (startFilter && endFilter) 
    {
        const startDate = new Date(startFilter);
        const endDate   = new Date(endFilter);

        if (startDate > endDate) 
        {
            Toast.error("A data de início não pode ser posterior à data de fim.");
            return null; 
        }

        if (startDate > new Date()) 
        {
            Toast.error("A data de início não pode ser no futuro.");
            return null;
        }

        if (endDate > new Date()) 
        {
            Toast.error("A data de fim não pode ser no futuro.");
            return null;
        }
        }
    
    if (DashbaordData) 
    {
        const totalSalesValue         = Number(DashbaordData.totalSalesValue);
        const totalSalesValuePrevious = Number(DashbaordData.totalSalesValuePrevious);
        const totalOrders             = Number(DashbaordData.totalOrders);

        $totalSales.text(formatPrice(totalSalesValue));
        $topSellingProduct.text(DashbaordData.topSellingProduct.name);
        $totalOrders.text(totalOrders.toLocaleString('pt-BR'));

        const averageTicket = totalOrders > 0 ? totalSalesValue / totalOrders : 0;
        $averageTicket.text(formatPrice(averageTicket));

        let growthPercent = 0;
        if (totalSalesValuePrevious > 0) {
            growthPercent = ((totalSalesValue - totalSalesValuePrevious) / totalSalesValuePrevious) * 100;
        }

        const isPositive  = growthPercent >= 0;
        const growthText  = `${growthPercent.toFixed(0)}% vs. periodo anterior`;
        const $growthIcon = $totalSalesGrowth.find('.material-symbols-outlined');

        $growthIcon.text(isPositive ? 'north_east' : 'south_east');
        $totalSalesGrowth
            .toggleClass('bg-green-100 text-green-700', isPositive)
            .toggleClass('bg-red-100 text-red-700', !isPositive)
            .contents()
            .filter(function () {
                return this.nodeType === Node.TEXT_NODE;
            })
            .remove();
        $totalSalesGrowth.append(` ${growthText}`);

        const renderTopProducts = () => {
            $topProductsBody.empty();

            if (!DashbaordData.topProducts || DashbaordData.topProducts.length === 0) {
                $topProductsBody.append(
                    '<tr><td colspan="3" class="py-4 text-center text-sm text-text-light-secondary dark:text-text-dark-secondary">Sem dados no periodo.</td></tr>'
                );
                return;
            }

            DashbaordData.topProducts.forEach((item, index) => {
                const totalSales = formatPrice(Number(item.total_sales));

                $topProductsBody.append(
                    `<tr class="border-b border-border-light dark:border-border-dark">
                        <td class="py-2 text-sm font-semibold">#${index + 1}</td>
                        <td class="py-2 text-sm">${item.name}</td>
                        <td class="py-2 text-sm text-right font-semibold">${totalSales}</td>
                    </tr>`
                );
            });
        };

        const renderRecentSales = () => {
            $recentSalesList.empty();

            if (!DashbaordData.recentSales || DashbaordData.recentSales.length === 0) {
                $recentSalesList.append(
                    '<div class="text-sm text-text-light-secondary dark:text-text-dark-secondary">Sem vendas recentes no periodo.</div>'
                );
                return;
            }

            DashbaordData.recentSales.forEach((item) => {
                const formattedDate = new Date(String(item.created_at).replace(' ', 'T'));
                const timeLabel = Number.isNaN(formattedDate.getTime())
                    ? '--:--'
                    : new Intl.DateTimeFormat('pt-BR', { hour: '2-digit', minute: '2-digit' }).format(formattedDate);
                const locationLabel = item.location_name ?? 'PDV nao informado';
                const productLabel = item.product_name ?? 'Produto nao informado';
                const totalSales = formatPrice(Number(item.total_sales));

                $recentSalesList.append(
                    `<div class="flex items-center justify-between rounded-lg border border-border-light dark:border-border-dark p-3">
                        <div>
                            <p class="text-sm font-semibold">${timeLabel}</p>
                            <p class="text-xs text-text-light-secondary dark:text-text-dark-secondary">${productLabel}</p>
                            <p class="text-xs text-text-light-secondary dark:text-text-dark-secondary">${locationLabel}</p>
                        </div>
                        <p class="text-sm font-semibold">${totalSales}</p>
                    </div>`
                );
            });
        };

        const renderLowStockAlert = () => {
            const lowStockCount = Number(DashbaordData.lowStockCount);
            const hasLowStock = lowStockCount > 0;

            $lowStockCount.text(lowStockCount.toString());
            $lowStockMessage.text(
                hasLowStock
                    ? 'Produtos estao com estoque abaixo do minimo.'
                    : 'Nenhum produto abaixo do minimo.'
            );
            $lowStockAlert
                .toggleClass('border-red-200 bg-red-50 text-red-700', hasLowStock)
                .toggleClass('border-amber-200 bg-amber-50 text-amber-700', !hasLowStock);
        };

        renderTopProducts();
        renderRecentSales();
        renderLowStockAlert();
            
        graphicMovimentsSales(
            DashbaordData.salesMovements,
            metric,
            DashbaordData.salesMovementsPrevious
        );
        graphicSalesByCategory(DashbaordData.salesByCategory);

        return DashbaordData;
    }
    else 
    {
        console.error("Erro ao carregar os dados do dashboard.");
    }

    return null;

}