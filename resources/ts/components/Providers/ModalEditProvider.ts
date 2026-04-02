import { submitEditProviderForm } from "./helpers/submitEditProviderForm";
import { openModal } from "../../utils/openModal";
import { closeModal } from "../../utils/CloseModal";
import { Toast } from "../Swal/swal";
import { showUfs } from "../Locations/showUfs";
import { showCities } from "../Locations/showCities";
import { getTomSelectInstance, syncLocalTomSelect } from "../TomSelect/initTomSelect";
import { normalizeText } from "../../utils/normalizeText";

async function refreshCities(
    $city: JQuery<HTMLElement>,
    ufId: number,
    selectedCity?: string,
): Promise<void> {
    await showCities($city, ufId);
    const nextTsCity = syncLocalTomSelect($city, { size: "md" });

    if (selectedCity) {
        const normalizedSelected = normalizeText(selectedCity);
        const match = $city.find("option").toArray().find((option) => {
            const opt = option as HTMLOptionElement;
            return normalizeText(opt.value) === normalizedSelected
                || normalizeText(opt.textContent ?? "") === normalizedSelected;
        });

        if (match) {
            nextTsCity?.setValue((match as HTMLOptionElement).value, true);
        }
    }
}

export async function ShowModalEditProvider(
    provider: ProviderData,
    table: { draw: (resetPaging?: boolean) => void },
): Promise<void> {
    const $modal     = $("#modal-edit-provider");
    const $btnClose  = $("#btn-modal-close-provider-edit");
    const $btnCancel = $("#btn-modal-cancel-provider-edit");
    const $btnSave   = $("#btn-modal-save-provider-edit");

    const $inputId     = $("#input-edit-provider-id");
    const $inputName   = $("#input-edit-provider-name");
    const $inputCnpj   = $("#input-edit-provider-cnpj");
    const $inputPhone  = $("#input-edit-provider-phone");
    const $inputEmail  = $("#input-edit-provider-email");
    const $inputCep    = $("#input-edit-provider-cep");
    const $inputStreet = $("#input-edit-provider-street");
    const $inputNumber = $("#input-edit-provider-number");
    const $selectCity  = $("#select-edit-provider-city");
    const $selectState = $("#select-edit-provider-state");

    $inputId.val(String(provider.id));
    $inputName.val(provider.name ?? "");
    $inputCnpj.val(provider.cnpj ?? "");
    $inputPhone.val(provider.phone ?? "");
    $inputEmail.val(provider.email ?? "");
    $inputCep.val(provider.cep ?? "");
    $inputStreet.val(provider.street ?? "");
    $inputNumber.val(provider.number ?? "");

    await showUfs($selectState);
    syncLocalTomSelect($selectState, { size: "md" });
    if (provider.state) {
        getTomSelectInstance($selectState)?.setValue(provider.state, true);
    }

    const selectedUf = $selectState.find("option:selected");
    const ufId = Number(selectedUf.data("ufId"));
    if (ufId) {
        await refreshCities($selectCity, ufId, provider.city ?? undefined);
    }

    $selectState.off("change").on("change", async () => {
        const selected = $selectState.find("option:selected");
        const selectedUfId = Number(selected.data("ufId"));
        if (selectedUfId) {
            await refreshCities($selectCity, selectedUfId);
        }
    });

    openModal($modal);

    $btnCancel.off("click").on("click", () => closeModal($modal));
    $btnClose.off("click").on("click", () => closeModal($modal));

    $btnSave.off("click").on("click", async (e) => {
        e.preventDefault();
        $btnSave.text("Salvando...").prop("disabled", true);

        try {
            const submitResult = await submitEditProviderForm(
                provider.id,
                $inputName,
                $inputCnpj,
                $inputPhone,
                $inputEmail,
                $inputCep,
                $inputStreet,
                $inputNumber,
                $selectCity,
                $selectState,
            );

            if (submitResult === null) {
                return;
            }

            if (submitResult) {
                Toast.success("Fornecedor atualizado com sucesso.");
                closeModal($modal);
                table.draw(false);
            }
        } finally {
            $btnSave.text("Salvar").prop("disabled", false);
        }
    });
}
