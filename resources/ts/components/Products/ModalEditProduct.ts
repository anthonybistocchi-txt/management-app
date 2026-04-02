import { submitEditProductForm } from "./helpers/submitEditProductForm";
import { openModal } from "../../utils/openModal";
import { closeModal } from "../../utils/CloseModal";
import { Toast } from "../Swal/swal";
import { showCategories } from "../ProductCategories/showCategories";
import { showProviders } from "../Providers/ShowProviders";
import { showLocations } from "../Locations/showLocations";
import { getTomSelectInstance, syncLocalTomSelect } from "../TomSelect/initTomSelect";
import { maskPrice } from "../../utils/priceMask";

async function ensureSelect(
    $select: JQuery<HTMLElement>,
    loader: (el: JQuery<HTMLElement>) => Promise<void>,
    size: "sm" | "md" | "lg" = "md",
): Promise<void> {
    await loader($select);
    syncLocalTomSelect($select, { size, allowEmpty: true });
}

export async function ShowModalEditProduct(
    product: ProductData,
    table: { draw: (resetPaging?: boolean) => void },
): Promise<void> {
    const $modal     = $("#modal-edit-product");
    const $btnClose  = $("#btn-modal-close-product-edit");
    const $btnCancel = $("#btn-modal-cancel-product-edit");
    const $btnSave   = $("#btn-modal-save-product-edit");

    const $inputId             = $("#input-edit-product-id");
    const $inputName           = $("#input-edit-product-name");
    const $selectCategory      = $("#select-edit-product-category");
    const $selectProvider      = $("#select-edit-product-provider");
    const $inputPrice          = $("#input-edit-product-price");
    const $inputQuantity       = $("#input-edit-product-quantity");
    const $selectLocation      = $("#select-edit-product-location");
    const $textareaDescription = $("#textarea-edit-product-description");

    $inputId.val(String(product.id));
    $inputName.val(product.name ?? "");
    $textareaDescription.val(product.description ?? "");

    if (product.price !== undefined && product.price !== null) {
        $inputPrice.val(maskPrice(String(product.price)));
    } else {
        $inputPrice.val("");
    }

    $inputPrice.off("input").on("input", (event) => {
        const target = event.currentTarget as HTMLInputElement;
        target.value = maskPrice(target.value);
    });

    $inputQuantity.val(product.quantity ?? "");

    await ensureSelect($selectCategory, async (el) => {
        await showCategories(el);
        el.find('option[value="all"]').remove();
    });

    await ensureSelect($selectProvider, async (el) => {
        await showProviders(el);
        el.find('option[value="all"]').remove();
    });

    await ensureSelect($selectLocation, async (el) => {
        await showLocations(el);
        el.find('option[value="all"]').remove();
    });

    const tsCategory = getTomSelectInstance($selectCategory);
    const tsProvider = getTomSelectInstance($selectProvider);
    const tsLocation = getTomSelectInstance($selectLocation);

    if (product.product_category_id) {
        tsCategory?.setValue(String(product.product_category_id), true);
    }
    if (product.provider_id) {
        tsProvider?.setValue(String(product.provider_id), true);
    }
    if (product.location_id) {
        tsLocation?.setValue(String(product.location_id), true);
    }

    openModal($modal);

    $btnCancel.off("click").on("click", () => closeModal($modal));
    $btnClose.off("click").on("click", () => closeModal($modal));

    $btnSave.off("click").on("click", async (e) => {
        e.preventDefault();
        $btnSave.text("Salvando...").prop("disabled", true);

        try {
            const submitResult = await submitEditProductForm(
                product.id,
                $inputName,
                $selectCategory,
                $selectProvider,
                $inputPrice,
                $inputQuantity,
                $selectLocation,
                $textareaDescription,
            );

            if (submitResult === null) {
                return;
            }

            if (submitResult) {
                Toast.success("Produto atualizado com sucesso.");
                closeModal($modal);
                table.draw(false);
            }
        } finally {
            $btnSave.text("Salvar").prop("disabled", false);
        }
    });
}
