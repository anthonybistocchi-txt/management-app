import { UpdateLocationService } from "../../services/Location/UpdateLocationService";

export const UpdateLocationController = {
    async updateLocation(payload: Partial<LocationData> & { id: number }): Promise<{ success: boolean; message?: string }> {
        const result = await UpdateLocationService.updateLocation(payload);
        if (result.ok) {
            return { success: true };
        }
        return { success: false, message: result.message };
    },
};
