import $ from "jquery";

export const modalError = (mesage) => {
    const modal = $("#modalError");
    const mesageError = $("#modalErrorMsg");
    const subMesage = $("#odalSubMessage");


    modal.modal("show");

    mesageError.text(mesage);

    setTimeout(() => {
        modal.modal("hide");
    }, 3000);

}