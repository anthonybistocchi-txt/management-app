import { ProductController } from "../../Controllers/Products/ProductController";
import { renderSelectOptions } from "../../utils/renderSelectOptions";

export async function showProducts($selectElement: JQuery<HTMLElement>): Promise<void> {
    const products = await ProductController.getProducts();

    renderSelectOptions(
        $selectElement,
        products.map((product) => ({
            value: String(product.id),
            label: product.name,
        })),
        {
            placeholder: "Selecione um produto",
        }
    );
}