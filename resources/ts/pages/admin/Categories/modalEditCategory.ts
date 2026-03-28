import { Toast } from "../../../components/Swal/swal";

export const modalEditCategory = {
    async handleEditCategorySubmit(
        _id: number,
        $inputName: JQuery<HTMLElement>,
        $textareaDescription: JQuery<HTMLElement>,
    ): Promise<boolean | null> {
        const name = String($inputName.val()).trim();
        const description = String($textareaDescription.val()).trim();

        if (!name) {
            Toast.info("Preencha o nome da categoria.");
            return null;
        }

        Toast.info("API de categorias ainda nao implementada.");
        return false;
    },
};
