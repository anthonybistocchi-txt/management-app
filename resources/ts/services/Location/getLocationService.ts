import { ApiResponse } from "../../types/ApiResponse";
import { messageFromAxiosError } from "../../utils/axiosErrorMessage";
import api from "../../utils/api";


export const LocationService = {
    async getLocations(): Promise<ApiResponse<LocationData[]>> {
        try {
            const response = await api.get<ApiResponse<LocationData[]>>("locations/getAll", {});

            return response.data;
        } catch (error) {
            console.error("Erro no serviço:", error);
            const message = messageFromAxiosError(error, "Erro desconhecido ao buscar localizações.");

            return {
                success: false,
                status: false,
                message,
                errors: [message],
                data: []
            };
        }
    }
}