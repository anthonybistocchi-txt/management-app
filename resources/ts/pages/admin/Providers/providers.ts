import $ from "jquery";
import { openModal } from "../../../utils/openModal";
import { closeModal } from "../../../utils/CloseModal";
import { maskCnpj } from "../../../utils/cnpjMask";
import { maskCep } from "../../../utils/cepMask";
import { maskPhone } from "../../../utils/phoneMask";
import { showProvidersTable } from "../../../components/Providers/TableProviders";
import { ShowModalCreateProvider } from "../../../components/Providers/ModalCreateProvider";
import { showUserLogged } from "../../../components/User/ShowUserLogged";
import { getTomSelectInstance, syncLocalTomSelect, syncLocalTomSelectGroup } from "../../../components/TomSelect/initTomSelect";
import { ProviderController } from "../../../Controllers/Providers/ProviderController";
import { showUfs } from "../../../components/Locations/showUfs";
import { showCities } from "../../../components/Locations/showCities";
import { bindCepAutoFill } from "../../../utils/cepAutoFill";
import { CepController } from "../../../Controllers/CEP/CepController";
import { CitiesController } from "../../../Controllers/Cities/CitiesController";
import { normalizeText } from "../../../utils/normalizeText";
import { Toast } from "../../../components/Swal/swal";

async function populateProviderFilters(
    $selectState: JQuery<HTMLElement>,
    $selectCity: JQuery<HTMLElement>,
): Promise<void> {
    const providers = await ProviderController.getProviders();
    const states = Array.from(new Set(providers.map((provider) => String(provider.state ?? "").trim()).filter(Boolean)));
    const cities = Array.from(new Set(providers.map((provider) => String(provider.city ?? "").trim()).filter(Boolean)));

    $selectState.empty();
    $selectState.append('<option value="all">Estados</option>');
    $selectState.append('<option value="all">Todos</option>');
    states.forEach((state) => {
        $selectState.append(`<option value="${state}">${state}</option>`);
    });

    $selectCity.empty();
    $selectCity.append('<option value="all">Cidades</option>');
    $selectCity.append('<option value="all">Todas</option>');
    cities.forEach((city) => {
        $selectCity.append(`<option value="${city}">${city}</option>`);
    });
}

async function refreshCities(
    $city: JQuery<HTMLElement>,
    ufId: number,
    selectedCity?: string,
): Promise<void> {
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
}

async function loadAllCities($city: JQuery<HTMLElement>): Promise<void> {
    await showCities($city);
    syncLocalTomSelect($city, { size: "lg" });
}

$(document).ready(async () => {
    const $textHeaderUsername = $("#text-header-username");
    const $textHeaderTypeUser = $("#text-header-type-user");

    const $btnOpenCreate = $("#btn-open-create-provider");
    const $btnSubmitSearch = $("#btn-submit-search-provider");
    const $inputSearch = $("#input-search-provider");
    const $filterState = $("#select-filter-provider-state");
    const $filterCity = $("#select-filter-provider-city");

    const $table = $("#table-providers");

    const $modalCreate = $("#modal-create-provider");
    const $btnModalClose = $("#btn-modal-close-provider");
    const $btnModalCancel = $("#btn-modal-cancel-provider");
    const $btnModalSave = $("#btn-modal-save-provider");

    const $inputName = $("#input-create-provider-name");
    const $inputCnpj = $("#input-create-provider-cnpj");
    const $inputPhone = $("#input-create-provider-phone");
    const $inputEmail = $("#input-create-provider-email");
    const $inputCep = $("#input-create-provider-cep");
    const $inputStreet = $("#input-create-provider-street");
    const $inputNumber = $("#input-create-provider-number");
    const $selectCity = $("#select-create-provider-city");
    const $selectState = $("#select-create-provider-state");

    const $inputEditCnpj = $("#input-edit-provider-cnpj");
    const $inputEditPhone = $("#input-edit-provider-phone");
    const $inputEditCep = $("#input-edit-provider-cep");
    const $inputEditStreet = $("#input-edit-provider-street");
    const $selectEditCity = $("#select-edit-provider-city");
    const $selectEditState = $("#select-edit-provider-state");

    await showUserLogged($textHeaderUsername, $textHeaderTypeUser);

    await populateProviderFilters($filterState, $filterCity);

    const filterSelects = [
        { $el: $filterState, size: "sm" as const },
        { $el: $filterCity, size: "sm" as const },
    ];

    syncLocalTomSelectGroup(filterSelects.map(({ $el, size }) => ({ $el, size, allowEmpty: true })));

    await showProvidersTable($table, $inputSearch, $filterState, $filterCity, $btnSubmitSearch);

    $inputCnpj.on("input", (event) => {
        const target = event.currentTarget as HTMLInputElement;
        target.value = maskCnpj(target.value);
    });

    $inputPhone.on("input", (event) => {
        const target = event.currentTarget as HTMLInputElement;
        target.value = maskPhone(target.value);
    });

    $inputEditCnpj.on("input", (event) => {
        const target = event.currentTarget as HTMLInputElement;
        target.value = maskCnpj(target.value);
    });

    $inputEditPhone.on("input", (event) => {
        const target = event.currentTarget as HTMLInputElement;
        target.value = maskPhone(target.value);
    });

    bindCepAutoFill($inputCep, {
        mask: maskCep,
        onCepReady: async (cepValue) => {
            const cepInfo = await CitiesController.getCityByCep(cepValue);
            const address = await CepController.getAddress(cepValue);

            if (!address || address.erro) {
                Toast.info("CEP nao encontrado.");
                return;
            }

            if (address.logradouro) {
                $inputStreet.val(address.logradouro);
            }

            if (address.uf) {
                const ufOption = $selectState.find(`option[value="${address.uf}"]`);
                const ufOptionId = Number(ufOption.data("ufId"));
                const tsState = getTomSelectInstance($selectState);

                if (tsState) {
                    tsState.setValue(address.uf, true);
                } else {
                    $selectState.val(address.uf);
                }

                if (ufOptionId) {
                    await refreshCities($selectCity, ufOptionId, address.localidade ?? undefined);
                } else {
                    await loadAllCities($selectCity);
                }
            }

            if (cepInfo?.city && !address.localidade) {
                await loadAllCities($selectCity);
                const tsCity = getTomSelectInstance($selectCity);
                if (tsCity) tsCity.setValue(cepInfo.city, true);
            }
        },
    });

    bindCepAutoFill($inputEditCep, {
        mask: maskCep,
        onCepReady: async (cepValue) => {
            const cepInfo = await CitiesController.getCityByCep(cepValue);
            const address = await CepController.getAddress(cepValue);

            if (!address || address.erro) {
                Toast.info("CEP nao encontrado.");
                return;
            }

            if (address.logradouro) {
                $inputEditStreet.val(address.logradouro);
            }

            if (address.uf) {
                const ufOption = $selectEditState.find(`option[value="${address.uf}"]`);
                const ufOptionId = Number(ufOption.data("ufId"));
                const tsState = getTomSelectInstance($selectEditState);

                if (tsState) {
                    tsState.setValue(address.uf, true);
                } else {
                    $selectEditState.val(address.uf);
                }

                if (ufOptionId) {
                    await refreshCities($selectEditCity, ufOptionId, address.localidade ?? undefined);
                } else {
                    await loadAllCities($selectEditCity);
                }
            }

            if (cepInfo?.city && !address.localidade) {
                await loadAllCities($selectEditCity);
                const tsCity = getTomSelectInstance($selectEditCity);
                if (tsCity) tsCity.setValue(cepInfo.city, true);
            }
        },
    });

    $btnOpenCreate.on("click", async () => {
        await showUfs($selectState);
        await showCities($selectCity);

        syncLocalTomSelectGroup([
            { $el: $selectState, size: "lg" },
            { $el: $selectCity, size: "lg" },
        ]);

        $selectState.off("change").on("change", async () => {
            const selected = $selectState.find("option:selected");
            const selectedUfId = Number(selected.data("ufId"));
            if (selectedUfId) {
                await refreshCities($selectCity, selectedUfId);
            }
        });

        $selectCity.off("focus").on("focus", async () => {
            await loadAllCities($selectCity);
        });

        openModal($modalCreate);
    });

    $btnModalSave.on("click", async (event) => {
        event.preventDefault();
        await ShowModalCreateProvider(
            $inputName,
            $inputCnpj,
            $inputPhone,
            $inputEmail,
            $inputCep,
            $inputStreet,
            $inputNumber,
            $selectCity,
            $selectState,
            $btnModalSave,
            $modalCreate,
            $table,
        );
    });

    $btnModalClose.on("click", () => closeModal($modalCreate));
    $btnModalCancel.on("click", () => closeModal($modalCreate));
});
