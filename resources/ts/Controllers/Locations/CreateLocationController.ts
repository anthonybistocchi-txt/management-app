import { CreateLocationService } from "../../services/Location/CreateLocationService";

export const CreateLocationController = {
    async createLocation(payload: Partial<LocationData>): Promise<{ success: boolean; message?: string }> {
        const result = await CreateLocationService.createLocation(payload);
        if (result.ok) {
            return { success: true };
        }
        return { success: false, message: result.message };
    },
};
