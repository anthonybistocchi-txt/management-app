import { Toast } from "../../Swal/swal";

export async function submitCreateCategoryForm(
    $inputName: JQuery<HTMLElement>,
    $textareaDescription: JQuery<HTMLElement>,
): Promise<boolean | null> {
    const name = String($inputName.val()).trim();

    if (!name) {
        Toast.info("Preencha o nome da categoria.");
        return null;
    }

    Toast.info("API de categorias ainda nao implementada.");
    return false;
}