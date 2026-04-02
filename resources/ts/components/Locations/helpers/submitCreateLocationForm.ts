import { Toast } from "../../Swal/swal";
import { LocationController } from "../../../Controllers/Locations/LocationController";

export async function submitCreateLocationForm(
    $inputName:    JQuery<HTMLElement>,
    $inputAddress: JQuery<HTMLElement>,
    $inputCity:    JQuery<HTMLElement>,
    $inputState:   JQuery<HTMLElement>,
    $inputCep:     JQuery<HTMLElement>,
): Promise<boolean | null> {

    const name    = String($inputName.val()).trim();
    const address = String($inputAddress.val()).trim();
    const city    = String($inputCity.val()).trim();
    const state   = String($inputState.val()).trim().toUpperCase();
    const cep     = String($inputCep.val()).trim();

    if (!name) {
        Toast.info("Preencha o nome do local.");
        return null;
    }

    const result = await LocationController.createLocation({
        name,
        address: address || undefined,
        city:    city    || undefined,
        state:   state   || undefined,
        cep:     cep     || undefined,
    });

    if (result.success) {
        return true;
    }

    Toast.error(result.message ?? "Nao foi possivel criar o local.");
    return false;
}