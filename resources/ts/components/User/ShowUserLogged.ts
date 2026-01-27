import { UserController } from "../../Controllers/User/UserController";

export async function showUserLogged($inputUsername: JQuery<HTMLElement>, $inputTypeUserId: JQuery<HTMLElement>): Promise<void> {
    const userLogged = await UserController.getUserLogged();

    $inputUsername.text(userLogged.username);

    switch (userLogged.type_user_id) 
    {
        case 1:
            $inputTypeUserId.text('Administrador');
            break;
        case 2:
            $inputTypeUserId.text('Gestor');
            break;
        default:
            $inputTypeUserId.text('Operador');
    }

    if (!userLogged) 
    {
        $inputUsername.text('Usuário');
        $inputTypeUserId.text('');
        console.error("Erro ao obter dados do usuário logado.");
    }

}