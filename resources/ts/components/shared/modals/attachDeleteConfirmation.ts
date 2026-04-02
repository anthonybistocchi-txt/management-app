import { closeModal } from "../../../utils/CloseModal";
import { openModal } from "../../../utils/openModal";
import { Toast } from "../../Swal/swal";

export interface AttachDeleteConfirmationConfig {
    modal:         JQuery<HTMLElement>;
    confirmButton: JQuery<HTMLElement>;
    cancelButton:  JQuery<HTMLElement>;
    closeButton:   JQuery<HTMLElement>;
    itemIdInput:   JQuery<HTMLElement>;
    entityLabel:   string;
    loadingLabel?: string;
    confirmLabel?: string;
    failureMessage?: string;
    onConfirm: () => Promise<{ success: boolean; message?: string }>;
    onSuccess: () => void | Promise<void>;
}

export function attachDeleteConfirmation({
    modal,
    confirmButton,
    cancelButton,
    closeButton,
    itemIdInput,
    entityLabel,
    loadingLabel = "Excluindo...",
    confirmLabel = "Excluir",
    failureMessage,
    onConfirm,
    onSuccess,
}: AttachDeleteConfirmationConfig): void {
    openModal(modal);

    cancelButton.off("click").on("click", () => closeModal(modal));
    closeButton.off("click").on("click", () => closeModal(modal));

    confirmButton.off("click").on("click", async (event) => {
        event.preventDefault();
        confirmButton.text(loadingLabel).prop("disabled", true);

        try {
            const result = await onConfirm();

            if (result.success) {
                Toast.success(`${entityLabel} excluído com sucesso.`);
                closeModal(modal);
                await onSuccess();
                return;
            }

            Toast.error(result.message ?? failureMessage ?? `Nao foi possivel excluir o ${entityLabel.toLowerCase()}.`);
        } finally {
            confirmButton.text(confirmLabel).prop("disabled", false);
            itemIdInput.val("");
        }
    });
}