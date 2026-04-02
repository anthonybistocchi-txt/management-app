import { Toast } from "../../Swal/swal";
import { UserController } from "../../../Controllers/User/UserController";

export async function submitCreateUserForm(
    $inputCreateName:      JQuery<HTMLElement>,
    $inputCreateEmail:     JQuery<HTMLElement>,
    $selectCreateTypeUser: JQuery<HTMLElement>,
    $inputCreatePassword:  JQuery<HTMLElement>,
    $inputCreateCpf:       JQuery<HTMLElement>,
    $inputCreateUsername:  JQuery<HTMLElement>,
): Promise<boolean | null> {
    const createNameValue     = String($inputCreateName.val()).trim();
    const createEmailValue    = String($inputCreateEmail.val()).trim().toLowerCase();
    const createIdRoleValue   = Number($selectCreateTypeUser.val() as string);
    const createPasswordValue = String($inputCreatePassword.val()).trim();
    const createCpfValue      = String($inputCreateCpf.val()).trim();
    const createUsernameValue = String($inputCreateUsername.val()).trim();

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