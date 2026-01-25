import { graphicSalesByCategory } from "../../components/graphicDashboard/categoriesGraphic";
import { graphicMovimentsSales } from "../../components/graphicDashboard/movimentsGraphic";
import { DashboardService } from "../../services/Dashboard/DashboardService";
import { ApiResponse } from "../../types/Utils/ApiResponse";
import { formatPrice } from "../../types/Utils/FormatPrice";

export const DashboardController = {
    async loadDashboard(date_from: string, date_to: string, total_sales_selector: JQuery<HTMLElement>, top_selling_product_selector: JQuery<HTMLElement>): Promise<void> {
        try {
            const response: ApiResponse<DashboardData> = await DashboardService.getDashboard(date_from, date_to);
            
            if (response.status && response.data) {
                const data = response.data;

                total_sales_selector.text(formatPrice(data.totalSalesValue));

                if (data.topSellingProduct) {
                    top_selling_product_selector.text(data.topSellingProduct.name);
                }

                graphicMovimentsSales(data.salesMovements);
                graphicSalesByCategory(data.salesByCategory);
            }

        } catch (error) {
            console.error("Fluxo interrompido:", error);
        };
    }
};