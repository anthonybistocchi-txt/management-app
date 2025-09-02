import axios from "axios";
import { getInputsLogin, formLogin } from "../headerContents";
import { modalError } from "../../modals/modalError";
import { isValidEmail } from "./validations/isValidEmail";
import { isStrongPassword } from "./validations/isStrongPassaword";

export async function handleSubmitForm(e: Event) {
    e.preventDefault();

    const data: formLogin = getInputsLogin();

    if (data.email === "" || data.password === "") {
        modalError({
            message: "Erro ao tentar enviar o formulário.",
            subMessage: "Todos os campos são obrigatórios."
        });
        return;
    }

    if (data.password.length < 6) {
        modalError({
            message: "Erro ao enviar formulario, a senha deve ter pelo menos 6 caracteres.",
            subMessage: "Por favor, insira uma senha mais longa."

        });
        return;
    }

    if (!isValidEmail(data.email)) {
        modalError({
            message: "Erro ao enviar formulario email inválido",
            subMessage: "Por favor, insira um email válido."

        });
    }

    if (!isStrongPassword(data.password)) {
        modalError({
            message: "Erro ao enviar formulario, senha fraca",
            subMessage: "A senha deve conter pelo menos uma letra maiúscula e um caractere especial."
        });
        return;
    }

    try {
        const response = await axios.post("url", data); // falta criar rota no laravel

        if (response.status === 200) {
            // modalSuccess("Login realizado com sucesso!");
        }
    } catch (error) {
        modalError({
            message: "Erro ao enviar o formulário. Tente novamente mais tarde.",
            subMessage: "Se o problema persistir, contate o suporte." // Apenas mova para dentro do objeto
        });
        console.error("Erro na requisição:", error);
    }
}
