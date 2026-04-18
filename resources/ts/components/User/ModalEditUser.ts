import { UserController } from "../../Controllers/User/UserController";
import { submitEditUserForm } from "./helpers/submitEditUserForm";
import { closeModal } from "../../utils/CloseModal";
import { openModal } from "../../utils/openModal";
import { Toast } from "../Swal/swal";
import { getTomSelectInstance, syncLocalTomSelect } from "../TomSelect/initTomSelect";

export async function ShowModalEditUser(
    userId: number,
    table: { draw: (resetPaging?: boolean) => void }
): Promise<void> {
    const $inputEditName      = $("#input-edit-name");
    const $inputEditUsername  = $("#input-edit-username");
    const $inputEditEmail     = $("#input-edit-email");
    const $selectEditTypeUser = $("#select-edit-type-user");
    const $modalEdit          = $("#modal-edit-user");
    const $inputEditPassword  = $("#input-edit-password");
    const $inputEditCpf       = $("#input-edit-cpf");
    const $btnModalClose      = $("#btn-modal-edit-close");
    const $btnModalCancel     = $("#btn-modal-edit-cancel");
    const $btnSave            = $("#btn-modal-edit");

    try {
        const response = await UserController.getUserById(userId);
        if (!response?.data) {
            Toast.error("Usuário não encontrado.");
            return;
        }

        $inputEditName.val(response.data.name);
        $inputEditEmail.val(response.data.email);
        $inputEditUsername.val(response.data.username);
        $inputEditCpf.val(response.data.cpf);
        $inputEditPassword.val("");

        let tsEdit = getTomSelectInstance($selectEditTypeUser);
        if (!tsEdit) {
            tsEdit = syncLocalTomSelect($selectEditTypeUser, { size: "md" });
        }
        if (tsEdit) {
            tsEdit.setValue(String(response.data.type_user_id));
        } else {
            $selectEditTypeUser.val(String(response.data.type_user_id));
        }

        openModal($modalEdit);

        $btnModalCancel.off("click").on("click", () => {
            closeModal($modalEdit);
        });

        $btnModalClose.off("click").on("click", () => {
            closeModal($modalEdit);
        });

        $btnSave.off("click").on("click", async (event) => {
            event.preventDefault();

            $btnSave.html("Salvando...").prop("disabled", true);

            try {
                const submitResult = await submitEditUserForm(
                    userId,
                    $inputEditName,
                    $inputEditEmail,
                    $selectEditTypeUser,
                    $inputEditPassword,
                    $inputEditCpf,
                    $inputEditUsername
                );

                if (submitResult === null) {
                    return;
                }

                if (submitResult) {
                    Toast.success("User updated successfully.");
                    closeModal($modalEdit);
                    table.draw(false);
                }
            } finally {
                $btnSave.html("Salvar").prop("disabled", false);
            }
        });
    } catch {
        Toast.error("Não foi possível carregar os dados do usuário.");
    }
}
