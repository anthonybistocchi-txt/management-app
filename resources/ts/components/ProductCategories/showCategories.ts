import { ProductCategoriesController } from "../../Controllers/ProductCategories/ProductCategoriesController";

export async function showCategories($selectElement: JQuery<HTMLElement>): Promise<void> 
{

    const categories = await ProductCategoriesController.getProductCategories();

        $selectElement.empty();
        $selectElement.append('<option value="" selected disabled>Selecione uma categoria</option>');

        categories.forEach(category => {
            const option = `<option value="${category.id}">${category.name}</option>`;
            $selectElement.append(option);
        });
}