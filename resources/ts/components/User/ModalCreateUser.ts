import { modalCreateUser } from "../../pages/admin/Users/modalCreateUser";
import { showUsersTable } from "./TableUsers";
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
    $btnModalSave.html("Salvando...").prop("disabled", true);

    try {
        const requestCreateUser = await modalCreateUser.handleCreateUserSubmit(
            $inputCreateName,
            $inputCreateEmail,
            $selectCreateTypeUser,
            $inputCreatePassword,
            $inputCreateCpf,
            $inputCreateUsername
        );

        if (requestCreateUser === null) {
            return;
        }

        if (requestCreateUser) {
            Toast.success("Usuário criado com sucesso.");
            closeModal($modalCreateUser);
            await showUsersTable($tableUsers);
        }
    } finally {
        $btnModalSave.html("Salvar").prop("disabled", false);
    }
}
