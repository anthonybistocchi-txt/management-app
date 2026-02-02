import { DashboardController } from "../../Controllers/Dashboard/Dashboard";
import { formatPrice } from "../../utils/FormatPrice";
import { Toast } from "../Swal/swal";
import { graphicSalesByCategory } from "./categoriesGraphic";
import { graphicMovimentsSales } from "./movimentsGraphic";

export async function showGrapics(startFilter: string, endFilter: string, $totalSales: JQuery<HTMLElement>, $topSellingProduct: JQuery<HTMLElement>, $btn_submit: JQuery<HTMLElement>): Promise<void> {
    const DashbaordData = await DashboardController.getDashboardData(startFilter, endFilter);

    if (!startFilter || !endFilter) 
    {
        Toast.info("Selecione uma data completa"); 
        return;
    }
    
    if (DashbaordData) 
    {
        $totalSales.text(formatPrice(DashbaordData.totalSalesValue));
        $topSellingProduct.text(DashbaordData.topSellingProduct.name);
            
        graphicMovimentsSales(DashbaordData.salesMovements);
        graphicSalesByCategory(DashbaordData.salesByCategory);
    }
    else 
    {
        console.error("Erro ao carregar os dados do dashboard.");
    }

}