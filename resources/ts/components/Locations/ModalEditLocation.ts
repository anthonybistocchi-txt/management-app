import { modalEditLocation } from "../../pages/admin/Locations/modalEditLocation";
import { openModal } from "../../utils/openModal";
import { closeModal } from "../../utils/CloseModal";
import { Toast } from "../Swal/swal";

export async function ShowModalEditLocation(
    location: LocationData,
    table: { draw: (resetPaging?: boolean) => void },
): Promise<void> {
    const $modal = $("#modal-edit-location");
    const $btnClose = $("#btn-modal-close-location-edit");
    const $btnCancel = $("#btn-modal-cancel-location-edit");
    const $btnSave = $("#btn-modal-save-location-edit");

    const $inputId = $("#input-edit-location-id");
    const $inputName = $("#input-edit-location-name");
    const $inputAddress = $("#input-edit-location-address");
    const $inputCity = $("#input-edit-location-city");
    const $inputState = $("#input-edit-location-state");
    const $inputCep = $("#input-edit-location-cep");

    $inputId.val(String(location.id));
    $inputName.val(location.name ?? "");
    $inputAddress.val(location.address ?? "");
    $inputCity.val(location.city ?? "");
    $inputState.val(location.state ?? "");
    $inputCep.val(location.cep ?? "");

    openModal($modal);

    $btnCancel.off("click").on("click", () => closeModal($modal));
    $btnClose.off("click").on("click", () => closeModal($modal));

    $btnSave.off("click").on("click", async (e) => {
        e.preventDefault();
        $btnSave.text("Salvando...").prop("disabled", true);

        try {
            const submitResult = await modalEditLocation.handleEditLocationSubmit(
                location.id,
                $inputName,
                $inputAddress,
                $inputCity,
                $inputState,
                $inputCep,
            );

            if (submitResult === null) {
                return;
            }

            if (submitResult) {
                Toast.success("Local atualizado com sucesso.");
                closeModal($modal);
                table.draw(false);
            }
        } finally {
            $btnSave.text("Salvar").prop("disabled", false);
        }
    });
}
