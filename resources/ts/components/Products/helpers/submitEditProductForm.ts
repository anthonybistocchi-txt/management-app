import { Toast } from "../../Swal/swal";
import { ProductController } from "../../../Controllers/Products/ProductController";
import { parsePriceToNumber } from "../../../utils/priceMask";

export async function submitEditProductForm(
    id: number,
    $inputName: JQuery<HTMLElement>,
    $selectCategory: JQuery<HTMLElement>,
    $selectProvider: JQuery<HTMLElement>,
    $inputPrice: JQuery<HTMLElement>,
    $inputQuantity: JQuery<HTMLElement>,
    $selectLocation: JQuery<HTMLElement>,
    $textareaDescription: JQuery<HTMLElement>,
): Promise<boolean | null> {
    const name          = String($inputName.val()).trim();
    const categoryValue = String($selectCategory.val());
    const providerValue = String($selectProvider.val());
    const priceRaw      = String($inputPrice.val());
    const quantityRaw   = String($inputQuantity.val());
    const locationValue = String($selectLocation.val());
    const description   = String($textareaDescription.val()).trim();

    if (!name || !categoryValue || categoryValue === "all" || !providerValue || providerValue === "all") {
        Toast.info("Preencha nome, categoria e fornecedor.");
        return null;
    }

    const price = parsePriceToNumber(priceRaw);
    if (!price || Number.isNaN(price)) {
        Toast.info("Informe um preco valido.");
        return null;
    }

    const quantity = quantityRaw ? Number(quantityRaw) : undefined;
    if (quantityRaw && Number.isNaN(quantity)) {
        Toast.info("Quantidade invalida.");
        return null;
    }

    const locationId = locationValue && locationValue !== "all" ? Number(locationValue) : undefined;
    if (quantity !== undefined && !locationId) {
        Toast.info("Selecione um local para o estoque inicial.");
        return null;
    }

    const result = await ProductController.updateProduct(id, {
        name,
        price,
        provider_id: Number(providerValue),
        product_category_id: Number(categoryValue),
        quantity,
        location_id: locationId,
        description: description || undefined,
    });

    if (result.success) {
        return true;
    }

    Toast.error(result.message ?? "Nao foi possivel atualizar o produto.");
    return false;
}