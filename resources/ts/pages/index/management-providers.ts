import $ from "jquery";
import { showUserLogged } from "../../components/User/ShowUserLogged";

$(document).ready(async () => {
    await showUserLogged($("#text-header-username"), $("#text-header-type-user"));
});
