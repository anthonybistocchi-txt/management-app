import { modalEditCategory } from "../../pages/admin/Categories/modalEditCategory";
import { openModal } from "../../utils/openModal";
import { closeModal } from "../../utils/CloseModal";
import { Toast } from "../Swal/swal";

export async function ShowModalEditCategory(
    category: ProductCategoryData,
    table: { draw: (resetPaging?: boolean) => void },
): Promise<void> {
    const $modal = $("#modal-edit-category");
    const $btnClose = $("#btn-modal-close-category-edit");
    const $btnCancel = $("#btn-modal-cancel-category-edit");
    const $btnSave = $("#btn-modal-save-category-edit");

    const $inputId = $("#input-edit-category-id");
    const $inputName = $("#input-edit-category-name");
    const $textareaDescription = $("#textarea-edit-category-description");

    $inputId.val(String(category.id));
    $inputName.val(category.name ?? "");
    $textareaDescription.val(category.description ?? "");

    openModal($modal);

    $btnCancel.off("click").on("click", () => closeModal($modal));
    $btnClose.off("click").on("click", () => closeModal($modal));

    $btnSave.off("click").on("click", async (e) => {
        e.preventDefault();
        $btnSave.text("Salvando...").prop("disabled", true);

        try {
            const submitResult = await modalEditCategory.handleEditCategorySubmit(
                category.id,
                $inputName,
                $textareaDescription,
            );

            if (submitResult === null) {
                return;
            }

            if (submitResult) {
                Toast.success("Categoria atualizada com sucesso.");
                closeModal($modal);
                table.draw(false);
            }
        } finally {
            $btnSave.text("Salvar").prop("disabled", false);
        }
    });
}
