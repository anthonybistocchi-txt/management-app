import { ProductService } from "../../../services/StockInService.ts/GetProductService";
import { ApiResponse } from "../../../types/Utils/ApiResponse";
import { Toast } from "../../../components/swal";

interface ProductData {
    id: number;
    name: string;
}

export const getProducts = {
    
    async loadProducts($selectElement: JQuery<HTMLElement>) {
        try {
            const response: ApiResponse<ProductData[]> = await ProductService.getProducts();

            if (response.success && response.data) {
                const products = response.data;
                
                $selectElement.empty();
                $selectElement.append('<option value="">Selecione um Produto</option>');

                products.forEach((product) => {
                    $selectElement.append(`<option value="${product.id}">${product.name}</option>`);
                });
            } else {
                Toast.error("Não foi possível carregar a lista de produtos.");
            }
        } catch (error) {
            console.error("Erro ao buscar produtos:", error);
            Toast.error("Erro ao carregar produtos. Contate o suporte.");
        }
    }
};