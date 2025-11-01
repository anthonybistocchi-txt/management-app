import $ from "jquery";

interface ModalErrorProps {
    message: string;
    subMessage?: string; // opcional
}

export const modalError = ({ message, subMessage }: ModalErrorProps) => {
    const modal = $("#modalError");
    const messageError = $("#modalErrorMsg");
    const subMessageError = $("#modalSubMessage");

    modal.css("display", "block");

    messageError.text(message).show();

    if (subMessage) {
        subMessageError.text(subMessage).show();
    } else {
        subMessageError.hide();
    }

    setTimeout(() => {
        modal.hide();
    }, 3000);
};
