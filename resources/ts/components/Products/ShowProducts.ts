import { ProductController } from "../../Controllers/Products/ProductController";
import { renderSelectOptions } from "../../utils/renderSelectOptions";

export async function getInfoProducts($selectElement: JQuery<HTMLElement>): Promise<void> {
    const products = await ProductController.getInfoProducts();

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