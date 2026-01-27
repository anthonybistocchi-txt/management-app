import { DashboardService } from "../../services/Dashboard/DashboardService";
import { ApiResponse } from "../../types/ApiResponse";

export const DashboardController = {
    async getDashboardData(date_from: string, date_to: string): Promise<DashboardData | void> {
        try {
            const response: ApiResponse<DashboardData> = await DashboardService.getDashboard(date_from, date_to);
            
            if (response.status && response.data) {
                const data = response.data;

                return data;
            }

        } catch (error) {
            console.error("Fluxo interrompido:", error);
        };
    }
};