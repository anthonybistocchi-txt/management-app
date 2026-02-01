import { StockService } from "../../services/StockService/StockService";
import { ApiResponse } from "../../types/ApiResponse";

export const StockController = {
    async handleSubmitStockIn(
        productId: number,
        quantity: number,
        providerId: number,
        finalDate: string,
        description: string | null,
        locationId: number | null): Promise<boolean> {

        try {
            const response: ApiResponse<FormStockInData> = await StockService.submitStockIn({
                product_id:    productId,
                quantity:      quantity,
                provider_id:   providerId,
                movement_date: finalDate,
                description:   description || null,
                location_id:   locationId  || null
            })

            if (response.status) return true;
            
        } catch (error) {
            console.error("Erro ao enviar entrada de estoque.");
        }
        return false;
    },

    async handleSubmitStockOut(
        productId: number,
        quantity: number,
        finalDate: string,
        description: string | null,
        locationId: number | null): Promise<boolean> {

        try {
            const response: ApiResponse<FormStockOutData> = await StockService.submitStockOut({
                product_id:    productId,
                quantity:      quantity,
                movement_date: finalDate,
                description:   description || null,
                location_id:   locationId  || null
            });

            if (response.status) return true;
            
        } catch (error) {
            console.error("Erro ao enviar saída de estoque.");
        }
        return false;
    }
};