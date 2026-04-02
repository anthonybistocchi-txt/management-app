import { Toast } from "../../Swal/swal";
import { ProviderController } from "../../../Controllers/Providers/ProviderController";

export async function submitEditProviderForm(
    id: number,
    $inputName: JQuery<HTMLElement>,
    $inputCnpj: JQuery<HTMLElement>,
    $inputPhone: JQuery<HTMLElement>,
    $inputEmail: JQuery<HTMLElement>,
    $inputCep: JQuery<HTMLElement>,
    $inputStreet: JQuery<HTMLElement>,
    $inputNumber: JQuery<HTMLElement>,
    $selectCity: JQuery<HTMLElement>,
    $selectState: JQuery<HTMLElement>,
): Promise<boolean | null> {
    const name   = String($inputName.val()).trim();
    const cnpj   = String($inputCnpj.val()).trim();
    const phone  = String($inputPhone.val()).trim();
    const email  = String($inputEmail.val()).trim().toLowerCase();
    const cep    = String($inputCep.val()).trim();
    const street = String($inputStreet.val()).trim();
    const number = String($inputNumber.val()).trim();
    const city   = String($selectCity.val()).trim();
    const state  = String($selectState.val()).trim().toUpperCase();

    if (!name || !cnpj || !email || !cep || !street || !number || !city || !state) {
        Toast.info("Preencha todos os campos obrigatorios.");
        return null;
    }

    const result = await ProviderController.updateProvider(id, {
        name,
        cnpj,
        phone: phone || undefined,
        email,
        street,
        number,
        city,
        state,
        cep,
    });

    if (result.success) {
        return true;
    }

    Toast.error(result.message ?? "Nao foi possivel atualizar o fornecedor.");
    return false;
}