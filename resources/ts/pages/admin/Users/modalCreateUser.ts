import { Toast } from "../../../components/Swal/swal";
import { UserController } from "../../../Controllers/User/UserController";

export const modalCreateUser = {
    async handleCreateUserSubmit(
        $inputCreateName: JQuery, $inputCreateEmail: JQuery, $selectCreateTypeUser: JQuery, $inputCreatePassword: JQuery, $inputCreateCpf: JQuery, $inputCreateUsername: JQuery
    ): Promise<boolean | null> {

        const createNameValue     = String($inputCreateName.val()) as string;
        const createEmailValue    = String($inputCreateEmail.val()).toLowerCase() as string;
        const createIdRoleValue   = Number($selectCreateTypeUser.val() as string);
        const createPasswordValue = String($inputCreatePassword.val()) as string;
        const createCpfValue      = String($inputCreateCpf.val()) as string;
        const createUsernameValue = String($inputCreateUsername.val()) as string;

        if (!createNameValue || !createEmailValue || !createIdRoleValue || !createPasswordValue || !createCpfValue || !createUsernameValue) {
            Toast.info("Por favor, preencha todos os campos obrigatórios.");
            return null;
        }

        if (createPasswordValue.length < 8) {
            Toast.info("A senha deve ter pelo menos 8 caracteres.");
            return null;
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(createEmailValue)) {
            Toast.info("Por favor, insira um email válido.");
            return null;
        }

        const result = await UserController.createUser(
            createNameValue,
            createUsernameValue,
            createEmailValue,
            createIdRoleValue,
            createPasswordValue,
            createCpfValue
        );

        if (result.success) {
            return true;
        }

        Toast.error(result.message ?? "Erro ao criar usuário.");
        return false;
    }
};