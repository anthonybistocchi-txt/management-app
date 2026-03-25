import { Toast } from "../../../components/Swal/swal";
import { UserController } from "../../../Controllers/User/UserController";

export const modalEditUser = {
    async handleEditUserSubmit(
        id: number,
        $inputEditName:      JQuery<HTMLElement>,
        $inputEditEmail:     JQuery<HTMLElement>,
        $selectEditTypeUser: JQuery<HTMLElement>,
        $inputEditPassword:  JQuery<HTMLElement>,
        $inputEditCpf:       JQuery<HTMLElement>,
        $inputEditUsername:  JQuery<HTMLElement>
    ): Promise<boolean | null> {
        const editNameValue     = String($inputEditName.val()) as string;
        const editEmailValue    = String($inputEditEmail.val()).toLowerCase() as string;
        const editTypeUserValue = Number($selectEditTypeUser.val() as string);
        const editPasswordValue = String($inputEditPassword.val() ?? "");
        const editCpfValue      = String($inputEditCpf.val()) as string;
        const editUsernameValue = String($inputEditUsername.val()) as string;

        if (!editNameValue || !editEmailValue || !editTypeUserValue || !editCpfValue || !editUsernameValue) {
            Toast.info("Por favor, preencha todos os campos obrigatórios.");
            return null;
        }

        if (editPasswordValue.length > 0 && editPasswordValue.length < 8) {
            Toast.info("A senha deve ter pelo menos 8 caracteres.");
            return null;
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(editEmailValue)) {
            Toast.info("Por favor, insira um email válido.");
            return null;
        }

        const result = await UserController.editUser(
            id,
            editNameValue,
            editEmailValue,
            editUsernameValue,
            editPasswordValue,
            editTypeUserValue,
            editCpfValue
        );

        if (result.success) {
            return true;
        }

        Toast.error(result.message ?? "Erro ao editar usuário.");
        return false;
    },
};
