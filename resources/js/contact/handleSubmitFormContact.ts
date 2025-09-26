import { formContact, getInputsContact } from "./contactContents";
import { isValidEmail } from "../login/actions/validations/isValidEmail";
import { modalError } from "../modals/modalError";
import axios from "axios";

export async function handleSubmitFormContact(e: Event) {
    e.preventDefault();

    const data: formContact = await getInputsContact();

    if (data.email == "" || data.name == "" || data.message == "") {
        modalError({
            message: "Erro ao tentar enviar o formulário de contato.",
            subMessage: "Todos os campos são obrigatórios."
        });
        return;
    }

    if (data.message.length > 200) {
        modalError({
            message: "Erro ao enviar formulário, a mensagem deve ter no máximo 200 caracteres.",
        })
        return;
    }

    if (data.name.length < 3 && data.name.length > 20) {
        modalError({
            message: "Erro ao enviar formulário, o nome deve ter pelo menos 3 caracteres.",
            subMessage:"E no máximo 20 caracteres.",
        })
        return;
    }


    if (!isValidEmail(data.email)) {
        modalError({
            message: "Erro ao enviar formulario email inválido",
            subMessage: "Por favor, insira um email válido."

        });
        return;
    }

    try {
        const response = await axios.post("url", data); // falta criar rota no laravel

        if (response.status === 200) {
            // modalSuccess("form enviado com sucesso!");
        }
    } catch (error) {
        modalError({
            message: "Erro ao enviar o formulário. Tente novamente mais tarde.",
            subMessage: "Se o problema persistir, contate o suporte."
        });
        console.error("Erro na requisição:", error);
    }

}