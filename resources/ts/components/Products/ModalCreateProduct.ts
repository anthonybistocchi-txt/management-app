import { modalCreateProduct } from "../../pages/admin/Products/modalCreateProduct";
import { showProductsTable } from "./TableProducts";
import { closeModal } from "../../utils/CloseModal";
import { Toast } from "../Swal/swal";

export async function ShowModalCreateProduct(
    $inputName: JQuery<HTMLElement>,
    $selectCategory: JQuery<HTMLElement>,
    $selectProvider: JQuery<HTMLElement>,
    $inputPrice: JQuery<HTMLElement>,
    $inputQuantity: JQuery<HTMLElement>,
    $selectLocation: JQuery<HTMLElement>,
    $textareaDescription: JQuery<HTMLElement>,
    $btnSave: JQuery<HTMLElement>,
    $modal: JQuery<HTMLElement>,
    $table: JQuery<HTMLElement>,
): Promise<void> {
    $btnSave.text("Salvando...").prop("disabled", true);

    try {
        const requestCreate = await modalCreateProduct.handleCreateProductSubmit(
            $inputName,
            $selectCategory,
            $selectProvider,
            $inputPrice,
            $inputQuantity,
            $selectLocation,
            $textareaDescription,
        );

        if (requestCreate === null) {
            return;
        }

        if (requestCreate) {
            Toast.success("Produto criado com sucesso.");
            closeModal($modal);
            await showProductsTable($table);
        }
    } finally {
        $btnSave.text("Salvar").prop("disabled", false);
    }
}
