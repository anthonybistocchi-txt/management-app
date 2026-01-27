import { StockInService } from "../../services/StockInService/StockInService";
import { ApiResponse } from "../../types/ApiResponse";

export const StockInFormController = {
    async handleSubmit(
        productId: number,
        quantity: number,
        providerId: number,
        finalDate: string,
        description: string | null,
        locationId: number | null): Promise<boolean> {

        try {
            const response: ApiResponse<FormStockInData> = await StockInService.submitStockIn({
                product_id: productId,
                quantity: quantity,
                provider_id: providerId,
                movement_date: finalDate,
                description: description || null,
                location_id: locationId  || null
            })

            if (response.status) return true;
            
        } catch (error) {
            console.error("Erro ao enviar entrada de estoque.");
        }
        return false;
    }
};