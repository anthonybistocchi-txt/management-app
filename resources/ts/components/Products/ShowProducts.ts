import { getProductsController } from "../../Controllers/Products/ProductsController";

export async function showProducts($selectElement: JQuery<HTMLElement>): Promise<void> {
    const products = await getProductsController.getProducts();
    console.log(products);
    $selectElement.empty();
    $selectElement.append('<option value="" selected disabled>Selecione um produto</option>');
    
    products.forEach(product => {
        const option = `<option value="${product.id}">${product.name}</option>`;
        $selectElement.append(option);
    });
}