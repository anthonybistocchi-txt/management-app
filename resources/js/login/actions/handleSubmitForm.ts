import $ from "jquery";
import axios from "axios";
import { getInputsLogin, formLogin } from "../headerContents";
import { modalError } from "../../modals/modalError";
import { isValidEmail } from "./validations/isValidEmail";
import { isStrongPassword } from "./validations/isStrongPassaword";

export async function handleSubmitForm(e: Event) {
    e.preventDefault();

    const datas: formLogin = getInputsLogin();

    if (datas.email === "" || datas.password === "") {
        modalError("Por favor, preencha todos os campos.");
        return;
    }

    if (datas.password.length < 6) {
        modalError("A senha deve ter pelo menos 6 caracteres.");
        return;
    }

    if (!isValidEmail(datas.email)) {
        modalError("Por favor, insira um email válido.");
    }

    if (!isStrongPassword(datas.password)) {
        modalError("A senha deve conter pelo menos uma letra maiúscula e um caractere especial.");
        return;
    }

    try {
        const response = await axios.post("url", datas); // falta criar rota no laravel

        if (response.status === 200) {
            console.log("Login efetuado:", response.data);
        }
    } catch (error) {
        modalError("Erro ao enviar o formulário. Tente novamente mais tarde.");
        console.error("Erro na requisição:", error);
    }
}
