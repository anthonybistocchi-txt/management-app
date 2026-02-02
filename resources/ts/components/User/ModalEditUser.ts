import { UserController } from "../../Controllers/User/UserController";
import { modalEditUser } from "../../pages/admin/Users/modalEditUser";
import { openModal } from "../../utils/openModal";
import { Toast } from "../Swal/swal";

export async function ShowModalEditUser(userId: number[], table: any) {
    try {
        const $inputEditName     = $('#input-edit-name');
        const $inputEditUsername = $('#input-edit-username');
        const $inputEditEmail    = $('#input-edit-email');
        const $selectEditRole    = $('#select-edit-role');
        const $modalEdit         = $('#modal-edit-user');
        const $inputEditPassword = $('#input-edit-password');
        const $inputEditCpf      = $('#input-edit-cpf');
        const $btnSave           = $('#btn-save-edit');

        const response = await UserController.getUserById(userId);

        if (!response || !response.data) {
            Toast.error("Usuário não encontrado.");
            return;
        }
        
        openModal($modalEdit);

        $inputEditName.val(response.data.name);
        $inputEditEmail.val(response.data.email);
        $inputEditUsername.val(response.data.username);
        $selectEditRole.val(response.data.type_user_id);
        $inputEditCpf.val(response.data.cpf);
        $btnSave.off('click').on('click', async () => {
             await modalEditUser.handleEditUserSubmit(
                $inputEditName,
                $inputEditEmail,
                $selectEditRole,
                $inputEditPassword,
                $inputEditCpf,
                $inputEditUsername,
            );

            table.draw(false); // Recarrega a tabela sem resetar a página
        });

    } catch (error) {
        Toast.error("Não foi possível carregar os dados do usuário.");
    }
}