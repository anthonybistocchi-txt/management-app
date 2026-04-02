import { submitCreateLocationForm } from "./helpers/submitCreateLocationForm";
import { showLocationsTable } from "./TableLocations";
import { closeModal } from "../../utils/CloseModal";
import { Toast } from "../Swal/swal";

export async function ShowModalCreateLocation(
    $inputName:    JQuery<HTMLElement>,
    $inputAddress: JQuery<HTMLElement>,
    $inputCity:    JQuery<HTMLElement>,
    $inputState:   JQuery<HTMLElement>,
    $inputCep:     JQuery<HTMLElement>,
    $btnSave:      JQuery<HTMLElement>,
    $modal:        JQuery<HTMLElement>,
    $table:        JQuery<HTMLElement>,
): Promise<void> {

    $btnSave.text("Salvando...").prop("disabled", true);

    try {
        const requestCreate = await submitCreateLocationForm(
            $inputName,
            $inputAddress,
            $inputCity,
            $inputState,
            $inputCep,
        );

        if (requestCreate === null) 
        {
            return;
        }

        if (requestCreate) 
        {
            Toast.success("Local criado com sucesso.");
            closeModal($modal);
            await showLocationsTable($table);
        }
    } finally {
        $btnSave.text("Salvar").prop("disabled", false);
    }
}
