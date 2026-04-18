import $ from "jquery";
import { Toast } from "../../components/Swal/swal";
import { showUserLogged } from "../../components/User/ShowUserLogged";
import { ProviderController } from "../../Controllers/Providers/ProviderController";
import { showUfs } from "../../components/Locations/showUfs";
import { showCities } from "../../components/Locations/showCities";
import { getTomSelectInstance, syncLocalTomSelect, syncLocalTomSelectGroup } from "../../components/TomSelect/initTomSelect";
import { CepController } from "../../Controllers/CEP/CepController";
import { CitiesController } from "../../Controllers/Cities/CitiesController";
import { bindCepAutoFill } from "../../utils/cepAutoFill";
import { maskCnpj } from "../../utils/cnpjMask";
import { maskCep } from "../../utils/cepMask";
import { maskPhone } from "../../utils/phoneMask";
import { normalizeText } from "../../utils/normalizeText";

$(document).ready(async () => {
    await showUserLogged($("#text-header-username"), $("#text-header-type-user"));

    const $form     = $("#form-register-provider");
    const $name     = $("#input-provider-name");
    const $cnpj     = $("#input-provider-cnpj");
    const $phone    = $("#input-provider-phone");
    const $email    = $("#input-provider-email");
    const $cep      = $("#input-provider-cep");
    const $street   = $("#input-provider-street");
    const $number   = $("#input-provider-number");
    const $city     = $("#input-provider-city");
    const $state    = $("#input-provider-state");
    const $btnSave  = $("#btn-provider-save");
    const ufIdBySigla = new Map<string, number>();

    await showUfs($state);
    await showCities($city);

    $state.find("option[data-uf-id]").each((_, option) => {
        const element = option as HTMLOptionElement;
        const sigla = element.value;
        const ufId = Number(element.dataset.ufId);
        if (sigla && !Number.isNaN(ufId)) {
            ufIdBySigla.set(sigla, ufId);
        }
    });

    syncLocalTomSelectGroup([
        { $el: $state, size: "lg" },
        { $el: $city, size: "lg" },
    ]);

    const refreshCities = async (ufId: number, selectedCity?: string) => {
        await showCities($city, ufId);
        const tsCity = syncLocalTomSelect($city, { size: "lg" });

        if (selectedCity) {
            const normalizedSelected = normalizeText(selectedCity);
            const match = $city.find("option").toArray().find((option) => {
                const opt = option as HTMLOptionElement;
                return normalizeText(opt.value) === normalizedSelected
                    || normalizeText(opt.textContent ?? "") === normalizedSelected;
            });

            if (match) {
                tsCity?.setValue((match as HTMLOptionElement).value, true);
            }
        }
    };

    const loadAllCities = async () => {
        await showCities($city);
        syncLocalTomSelect($city, { size: "lg" });
    };

    $state.on("change", async () => {
        const selected = $state.find("option:selected");
        const selectedUfId = Number(selected.data("ufId"));
        const selectedSigla = String($state.val() ?? "");
        const ufId = Number.isNaN(selectedUfId) ? ufIdBySigla.get(selectedSigla) : selectedUfId;
        if (ufId) {
            await refreshCities(ufId);
        }
    });

    $cnpj.on("input", (event) => {
        const target = event.currentTarget as HTMLInputElement;
        target.value = maskCnpj(target.value);
    });

    bindCepAutoFill($cep, {
        mask: maskCep,
        onCepReady: async (cepValue) => {
            const cepInfo = await CitiesController.getCityByCep(cepValue);
            const address = await CepController.getAddress(cepValue);

            if (!address || address.erro) {
                Toast.info("CEP nao encontrado.");
                return;
            }

            if (address.logradouro) {
                $street.val(address.logradouro);
            }

            if (address.uf) {
                const ufOption = $state.find(`option[value="${address.uf}"]`);
                const ufOptionId = Number(ufOption.data("ufId"));
                const ufId = Number.isNaN(ufOptionId) ? ufIdBySigla.get(address.uf) : ufOptionId;
                const tsState = getTomSelectInstance($state);

                if (tsState) {
                    tsState.setValue(address.uf, true);
                } else {
                    $state.val(address.uf);
                }

                if (ufId) {
                    await refreshCities(ufId, address.localidade ?? undefined);
                } else {
                    await loadAllCities();
                }
            }

            if (cepInfo?.city && !address.localidade) {
                await loadAllCities();
                const tsCity = getTomSelectInstance($city);
                if (tsCity) tsCity.setValue(cepInfo.city, true);
            }
        },
    });

    $phone.on("input", (event) => {
        const target = event.currentTarget as HTMLInputElement;
        target.value = maskPhone(target.value);
    });

    $city.off("focus").on("focus", async () => {
        await loadAllCities();
    });

    $form.on("submit", async (event) => {
        event.preventDefault();

        const name   = String($name.val()).trim();
        const cnpj   = String($cnpj.val()).trim();
        const phone  = String($phone.val()).trim();
        const email  = String($email.val()).trim().toLowerCase();
        const cep    = String($cep.val()).trim();
        const street = String($street.val()).trim();
        const number = String($number.val()).trim();
        const city   = String($city.val()).trim();
        const state  = String($state.val()).trim().toUpperCase();

        if (!name || !cnpj || !email || !cep || !street || !number || !city || !state) {
            Toast.info("Preencha todos os campos obrigatorios.");
            return;
        }

        $btnSave.prop("disabled", true).text("Salvando...");

        const result = await ProviderController.createProvider({
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
            Toast.success("Fornecedor cadastrado com sucesso.");
            $form.trigger("reset");
        } else {
            Toast.error(result.message ?? "Nao foi possivel cadastrar o fornecedor.");
        }

        $btnSave.prop("disabled", false).text("Salvar fornecedor");
    });
});
