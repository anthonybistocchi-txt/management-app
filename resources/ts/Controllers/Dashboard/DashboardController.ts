import { DashboardService } from "../../services/Dashboard/DashboardService";
import { ApiResponse } from "../../types/ApiResponse";

export const DashboardController = {
    async getDashboardData(date_from: string, date_to: string): Promise<DashboardData | null> {
        try {
            const response: ApiResponse<DashboardData> = await DashboardService.getDashboard(date_from, date_to);
            
            if (response?.status && response.data) {
                return response.data;
            }

            return null;

        } catch (error) {
            console.error("Fluxo interrompido:", error);
            return null;
        };
    }
};