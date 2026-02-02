import { Toast } from "../../../components/Swal/swal";
import { UserController } from "../../../Controllers/User/UserController";

export const modalEditUser = {
    async handleEditUserSubmit(
        $inputEditName:      JQuery<HTMLElement>,
        $inputEditEmail:     JQuery<HTMLElement>,
        $selectEditTypeUser: JQuery<HTMLElement>,
        $inputEditPassword:  JQuery<HTMLElement>,
        $inputEditCpf:       JQuery<HTMLElement>,
        $inputEditUsername:  JQuery<HTMLElement>,
    ): Promise<boolean> 
    {
        const editNameValue     = String($inputEditName.val())                as string;
        const editEmailValue    = String($inputEditEmail.val()).toLowerCase() as string;
        const editTypeUserValue = Number($selectEditTypeUser.val()            as number);
        const editPasswordValue = $inputEditPassword
            ? (String($inputEditPassword.val()) as string)
            : null;

        const editCpfValue      = String($inputEditCpf.val())       as string;
        const editUsernameValue = String($inputEditUsername.val())  as string;

        if (!editNameValue || !editEmailValue || !editTypeUserValue || !editPasswordValue || !editCpfValue || !editUsernameValue) 
        {
            Toast.info("Por favor, preencha todos os campos obrigatórios.");
                return false;
        }
        
        if (editPasswordValue.length < 8) 
        {
            Toast.info("A senha deve ter pelo menos 8 caracteres.");
                return false;
        }
        
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(editEmailValue)) 
        {
            Toast.info("Por favor, insira um email válido.");
            return false;
        }

        const request = await UserController.editUser(
            editNameValue,
            editEmailValue,
            editUsernameValue,
            editPasswordValue,
            editTypeUserValue,
        );

       if (request) 
        {
            Toast.success("Usuário editado com sucesso.");
            return true;
        }

        Toast.error("Não foi possível editar o usuário.");
            return false;
    },
};
