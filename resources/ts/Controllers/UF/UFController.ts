import { UfService } from "../../services/UF/getUfService";

export const UFController = {
    async getUfs(): Promise<UFData[]> {
        return UfService.getUfs();
    },
};
