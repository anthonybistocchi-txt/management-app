import { LocationService } from "../../services/Location/LocationService";
import { ApiResponse } from "../../types/ApiResponse";

export const LocationController = {
    async getLocations(): Promise<LocationData[]> {
            try {
                const response: ApiResponse<LocationData[]> = await LocationService.getLocations();
    
                if (response.status && response.data) {
                    return response.data;
    
                }
            } catch (error) {
                console.error("Erro ao carregar localizações:", error);
            }
            return [];
        }
}