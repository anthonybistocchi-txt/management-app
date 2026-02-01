import { modalCreateUser } from "../../pages/admin/Users/modalCreateUser";
import { showUsersTable } from "../../pages/admin/Users/tableUsers";
import { closeModal } from "../../utils/CloseModal";
import { Toast } from "../Swal/swal";

export async function ShowModalCreateUser($inputCreateName: JQuery<HTMLElement>,
                $inputCreateEmail:     JQuery<HTMLElement>,
                $selectCreateTypeUser: JQuery<HTMLElement>,
                $inputCreatePassword:  JQuery<HTMLElement>,
                $inputCreateCpf:       JQuery<HTMLElement>,
                $inputCreateUsername:  JQuery<HTMLElement>,
                $btnModalSave:         JQuery<HTMLElement>,
                $modalCreateUser:      JQuery<HTMLElement>,
                $tableUsers:           JQuery<HTMLElement>
): Promise<void> 
{
    const requestCreateUser = await modalCreateUser.handleCreateUserSubmit(
                    $inputCreateName,
                    $inputCreateEmail,
                    $selectCreateTypeUser,
                    $inputCreatePassword,
                    $inputCreateCpf,
                    $inputCreateUsername
    );
    
    $btnModalSave.html('Salvando...').prop('disabled', true);
    
    if (requestCreateUser) 
    {
        Toast.success("Usuário criado com sucesso.");
        $btnModalSave.html('Salvar').prop('disabled', false);
        $modalCreateUser.empty();
        closeModal($modalCreateUser);
        showUsersTable($tableUsers);
    } 
    else 
    {
        Toast.error("Erro ao criar usuário. Por favor, tente novamente.");
        $btnModalSave.html('Salvar').prop('disabled', false);
    }
}