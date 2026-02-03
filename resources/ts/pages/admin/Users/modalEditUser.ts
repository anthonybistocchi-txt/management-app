import { Toast } from "../../../components/Swal/swal";
import { UserController } from "../../../Controllers/User/UserController";

export const modalEditUser = {
    async handleEditUserSubmit(
        id:                  number,
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
            : '';

        const editCpfValue      = String($inputEditCpf.val())       as string;
        const editUsernameValue = String($inputEditUsername.val())  as string;

        if (!editNameValue || !editEmailValue || !editTypeUserValue  || !editCpfValue || !editUsernameValue) 
        {
            Toast.info("Por favor, preencha todos os campos obrigatórios.");
                
        }
        
        if (editPasswordValue && editPasswordValue.length < 8) 
        {
            Toast.info("A senha deve ter pelo menos 8 caracteres.");
                
        }
        
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(editEmailValue)) 
        {
            Toast.info("Por favor, insira um email válido.");
            
        }

        const request = await UserController.editUser(
            id,
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
