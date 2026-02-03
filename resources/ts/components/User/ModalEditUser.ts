import { UserController } from "../../Controllers/User/UserController";
import { modalEditUser } from "../../pages/admin/Users/modalEditUser";
import { closeModal } from "../../utils/CloseModal";
import { maskCpf } from "../../utils/cpfMask";
import { openModal } from "../../utils/openModal";
import { Toast } from "../Swal/swal";

export async function ShowModalEditUser(userId: number, table: any) {
    try {
        const $inputEditName      = $('#input-edit-name');
        const $inputEditUsername  = $('#input-edit-username');
        const $inputEditEmail     = $('#input-edit-email');
        const $selectEditTypeUser = $('#select-edit-type-user');
        const $modalEdit          = $('#modal-edit-user');
        const $inputEditPassword  = $('#input-edit-password');
        const $inputEditCpf       = $('#input-edit-cpf');
        const $btnModalClose      = $('#btn-modal-edit-close');
        const $btnModalCancel     = $('#btn-modal-edit-cancel');
        const $btnSave            = $('#btn-modal-edit-save');

        const response = await UserController.getUserById(userId);
        if (!response || !response.data) {
            Toast.error("Usuário não encontrado.");
            return;
        }

        openModal($modalEdit);

        $inputEditCpf.on('input', function() {
            const typedValue = $(this).val() as string;   // mask cpf
            $(this).val(maskCpf(typedValue));
        });

        $btnModalCancel.off('click').on('click', () => {
           closeModal($modalEdit);
        });

        $btnModalClose.off('click').on('click', () => {
            closeModal($modalEdit);
        });

        $inputEditName.val(response.data.name);
        $inputEditEmail.val(response.data.email);
        $inputEditUsername.val(response.data.username);
        $selectEditTypeUser.val(response.data.type_user_id);
        $inputEditCpf.val(response.data.cpf);

        $btnSave.on('click', async () => {
            const result = await modalEditUser.handleEditUserSubmit(
                userId,
                $inputEditName,
                $inputEditEmail,
                $selectEditTypeUser,
                $inputEditPassword,
                $inputEditCpf,
                $inputEditUsername,
            );

            // if (result) closeModal($modalEdit);
            
            // table.draw(false); // Recarrega a tabela sem resetar a página

        });


    } catch (error) {
        Toast.error("Não foi possível carregar os dados do usuário.");
    }
}