import { LocationService } from "../../services/Location/getLocationService";
import { CreateLocationService } from "../../services/Location/CreateLocationService";
import { UpdateLocationService } from "../../services/Location/UpdateLocationService";
import { DeleteLocationService } from "../../services/Location/DeleteLocationService";
import { ApiResponse } from "../../types/ApiResponse";

export const LocationController = {
    async getLocations(): Promise<LocationData[]> {
        try {
            const response: ApiResponse<LocationData[]> = await LocationService.getLocations();

            if (response.status && response.data) {
                return response.data;
            }
        } catch (error) {
            console.error("Erro ao carregar localizacoes:", error);
        }
        return [];
    },

    async createLocation(payload: Partial<LocationData>): Promise<{ success: boolean; message?: string }> {
        const result = await CreateLocationService.createLocation(payload);
        if (result.ok) {
            return { success: true };
        }
        return { success: false, message: result.message };
    },

    async updateLocation(payload: Partial<LocationData> & { id: number }): Promise<{ success: boolean; message?: string }> {
        const result = await UpdateLocationService.updateLocation(payload);
        if (result.ok) {
            return { success: true };
        }
        return { success: false, message: result.message };
    },

    async deleteLocation(id: number): Promise<{ success: boolean; message?: string }> {
        const result = await DeleteLocationService.deleteLocation(id);
        if (result.ok) {
            return { success: true };
        }
        return { success: false, message: result.message };
    },
};