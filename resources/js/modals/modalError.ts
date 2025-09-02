import $ from "jquery";

interface ModalErrorProps {
    message: string;
    subMessage?: string; // opcional
}

export const modalError = ({ message, subMessage }: ModalErrorProps) => {
    const modal = $("#modalError");
    const messageError = $("#modalErrorMsg");
    const subMessageError = $("#modalSubMessage");

    modal.modal("show");


    messageError.text(message);

    if (subMessage) {
        subMessageError.text(subMessage).show();
    } else {
        subMessageError.hide();
    }

    setTimeout(() => {
        modal.modal("hide");
    }, 3000);
};
