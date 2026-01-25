import { ApiResponse } from "../../types/Utils/ApiResponse";
import api from "../../Utils/api";


export const LocationService = {
    async getLocations(): Promise<ApiResponse<LocationData[]>> {
        try {
            const response = await api.get<ApiResponse<LocationData[]>>("locations/getAll", {});

            return response.data;
        } catch (error: any) {
            console.error("Erro no serviço:", error);

            return {
                success: false,
                status: false,
                message: error.message || "Erro desconhecido ao buscar produtos.",
                errors: [error.message],
                data: [] 
            };
        }
    }
}