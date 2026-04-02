import $ from "jquery";
import { Toast } from "../../components/Swal/swal";
import { showUserLogged } from "../../components/User/ShowUserLogged";
import { showProviders } from "../../components/Providers/ShowProviders";
import { showCategories } from "../../components/ProductCategories/showCategories";
import { showLocations } from "../../components/Locations/showLocations";
import { getTomSelectInstance, syncLocalTomSelectGroup } from "../../components/TomSelect/initTomSelect";
import { ProductController } from "../../Controllers/Products/ProductController";
import { maskPrice, parsePriceToNumber } from "../../utils/priceMask";

$(document).ready(async () => {
    await showUserLogged($("#text-header-username"), $("#text-header-type-user"));

    const $form        = $("#form-register-product");
    const $name        = $("#input-product-name");
    const $price       = $("#input-product-price");
    const $description = $("#textarea-product-description");
    const $quantity    = $("#input-product-quantity");
    const $category    = $("#select-product-category");
    const $provider    = $("#select-product-provider");
    const $location    = $("#select-product-location");
    const $btnSave     = $("#btn-product-save");

    $price.on("input", (event) => {
        const target = event.currentTarget as HTMLInputElement;
        target.value = maskPrice(target.value);
    });

    await showCategories($category);
    await showProviders($provider);
    await showLocations($location);

    $category.find('option[value="all"]').remove();
    $provider.find('option[value="all"]').remove();
    $location.find('option[value="all"]').remove();

    syncLocalTomSelectGroup([
        { $el: $category, size: "lg" },
        { $el: $provider, size: "lg" },
        { $el: $location, size: "lg", allowEmpty: true },
    ]);

    $form.on("submit", async (event) => {
        event.preventDefault();

        const name          = String($name.val()).trim();
        const priceRaw      = String($price.val());
        const price         = parsePriceToNumber(priceRaw);
        const description   = String($description.val()).trim();
        const categoryValue = String($category.val());
        const providerValue = String($provider.val());
        const quantityValue = String($quantity.val()).trim();
        const locationValue = String($location.val());

        if (!name || !price || !categoryValue || !providerValue) {
            Toast.info("Preencha nome, categoria, fornecedor e preco.");
            return;
        }

        const categoryId = Number(categoryValue);
        const providerId = Number(providerValue);
        const quantity   = quantityValue ? Number(quantityValue) : undefined;
        const locationId = locationValue ? Number(locationValue) : undefined;

        if (quantity !== undefined && Number.isNaN(quantity)) {
            Toast.info("Quantidade invalida.");
            return;
        }

        if (quantity !== undefined && !locationId) {
            Toast.info("Selecione a localizacao para o estoque inicial.");
            return;
        }

        $btnSave.prop("disabled", true).text("Salvando...");

        const result = await ProductController.createProduct({
            name,
            price,
            description: description || undefined,
            provider_id: providerId,
            product_category_id: categoryId,
            quantity,
            location_id: locationId,
        });

        if (result.success) {
            Toast.success("Produto cadastrado com sucesso.");
            $form.trigger("reset");

            getTomSelectInstance($category)?.clear();
            getTomSelectInstance($provider)?.clear();
            getTomSelectInstance($location)?.clear();
        } else {
            Toast.error(result.message ?? "Nao foi possivel cadastrar o produto.");
        }

        $btnSave.prop("disabled", false).text("Salvar produto");
    });
});
