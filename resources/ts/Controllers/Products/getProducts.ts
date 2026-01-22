import { ProductService } from "../../Services/Product/getProductService"; 

export const getProductsController = {
    
    async loadProducts($selectElement: JQuery<HTMLElement>): Promise<void> {
        try {
            const response = await ProductService.getProducts();

            if (response.status && response.data) {
                const products = response.data;
                
                $selectElement.empty();
                $selectElement.append('<option value="">Selecione um Produto</option>');

                products.forEach((product) => {
                    $selectElement.append(`<option value="${product.id}">${product.name}</option>`);
                });
            } else {
                console.error("Falha ao carregar produtos:", response.message);
            }
        } catch (error) {
            console.error("Erro ao buscar produtos:", error);
        }
    }
};