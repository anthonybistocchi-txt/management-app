import { ProductCategoriesController } from "../../Controllers/ProductCategories/ProductCategoriesController";
import { renderSelectOptions } from "../../utils/renderSelectOptions";

export async function showCategories($selectElement: JQuery<HTMLElement>): Promise<void> 
{
    const categories = await ProductCategoriesController.getProductCategories();

    renderSelectOptions(
        $selectElement,
        categories.map((category) => ({
            value: String(category.id),
            label: category.name,
        })),
        {
            placeholder: "Categoria",
            includeAllOption: "Todas",
        }
    );
}