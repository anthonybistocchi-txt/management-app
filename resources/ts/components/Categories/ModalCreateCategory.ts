import { submitCreateCategoryForm } from "./helpers/submitCreateCategoryForm";
import { showCategoriesTable } from "./TableCategories";
import { closeModal } from "../../utils/CloseModal";
import { Toast } from "../Swal/swal";

export async function ShowModalCreateCategory(
    $inputName:           JQuery<HTMLElement>,
    $textareaDescription: JQuery<HTMLElement>,
    $btnSave:             JQuery<HTMLElement>,
    $modal:               JQuery<HTMLElement>,
    $table:               JQuery<HTMLElement>,
): Promise<void> {
    $btnSave.text("Salvando...").prop("disabled", true);

    try {
        const requestCreate = await submitCreateCategoryForm(
            $inputName,
            $textareaDescription,
        );

        if (requestCreate === null) {
            return;
        }

        if (requestCreate) {
            Toast.success("Categoria criada com sucesso.");
            closeModal($modal);
            await showCategoriesTable($table);
        }
    } finally {
        $btnSave.text("Salvar").prop("disabled", false);
    }
}
