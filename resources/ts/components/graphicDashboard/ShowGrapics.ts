import { DashboardController } from "../../Controllers/Dashboard/DashboardController";
import { formatPrice } from "../../utils/FormatPrice";
import { Toast } from "../Swal/swal";
import { graphicSalesByCategory } from "./categoriesGraphic";
import { graphicMovimentsSales } from "./movimentsGraphic";

type SalesMetric = "revenue" | "volume";

export async function showGrapics(
    startFilter: string,
    endFilter: string,
    $totalSales: JQuery<HTMLElement>,
    $topSellingProduct: JQuery<HTMLElement>,
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
        $totalSales.text(formatPrice(DashbaordData.totalSalesValue));
        $topSellingProduct.text(DashbaordData.topSellingProduct.name);
            
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