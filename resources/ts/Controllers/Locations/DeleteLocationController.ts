import { DeleteLocationService } from "../../services/Location/DeleteLocationService";

export const DeleteLocationController = {
    async deleteLocation(id: number): Promise<{ success: boolean; message?: string }> {
        const result = await DeleteLocationService.deleteLocation(id);
        if (result.ok) {
            return { success: true };
        }
        return { success: false, message: result.message };
    },
};
