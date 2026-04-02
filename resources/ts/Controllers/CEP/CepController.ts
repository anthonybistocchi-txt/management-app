import { CepService } from "../../services/CEP/getCepService";

export const CepController = {
    async getAddress(cep: string): Promise<CepAddressData | null> {
        if (!cep) return null;
        return CepService.getAddress(cep);
    },
};
