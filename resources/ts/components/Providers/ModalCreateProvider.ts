import { submitCreateProviderForm } from "./helpers/submitCreateProviderForm";
import { showProvidersTable } from "./TableProviders";
import { closeModal } from "../../utils/CloseModal";
import { Toast } from "../Swal/swal";

export async function ShowModalCreateProvider(
    $inputName:   JQuery<HTMLElement>,
    $inputCnpj:   JQuery<HTMLElement>,
    $inputPhone:  JQuery<HTMLElement>,
    $inputEmail:  JQuery<HTMLElement>,
    $inputCep:    JQuery<HTMLElement>,
    $inputStreet: JQuery<HTMLElement>,
    $inputNumber: JQuery<HTMLElement>,
    $selectCity:  JQuery<HTMLElement>,
    $selectState: JQuery<HTMLElement>,
    $btnSave:     JQuery<HTMLElement>,
    $modal:       JQuery<HTMLElement>,
    $table:       JQuery<HTMLElement>,
): Promise<void> {
    $btnSave.text("Salvando...").prop("disabled", true);

    try {
        const requestCreate = await submitCreateProviderForm(
            $inputName,
            $inputCnpj,
            $inputPhone,
            $inputEmail,
            $inputCep,
            $inputStreet,
            $inputNumber,
            $selectCity,
            $selectState,
        );

        if (requestCreate === null) {
            return;
        }

        if (requestCreate) {
            Toast.success("Fornecedor criado com sucesso.");
            closeModal($modal);
            await showProvidersTable($table);
        }
    } finally {
        $btnSave.text("Salvar").prop("disabled", false);
    }
}
