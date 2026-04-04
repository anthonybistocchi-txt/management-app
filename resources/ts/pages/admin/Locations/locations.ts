import $ from "jquery";
import { openModal } from "../../../utils/openModal";
import { closeModal } from "../../../utils/CloseModal";
import { maskCep } from "../../../utils/cepMask";
import { bindCepAutoFill } from "../../../utils/cepAutoFill";
import { CepController } from "../../../Controllers/CEP/CepController";
import { Toast } from "../../../components/Swal/swal";
import { showLocationsTable } from "../../../components/Locations/TableLocations";
import { ShowModalCreateLocation } from "../../../components/Locations/ModalCreateLocation";
import { showUserLogged } from "../../../components/User/ShowUserLogged";
import { syncLocalTomSelectGroup } from "../../../components/TomSelect/initTomSelect";
import { LocationController } from "../../../Controllers/Locations/LocationController";

async function populateLocationFilters(
    $selectState: JQuery<HTMLElement>,
    $selectCity: JQuery<HTMLElement>,
): Promise<void> {
    const locations = await LocationController.getLocations();
    const states = Array.from(new Set(locations.map((l) => String(l.state ?? "").trim()).filter(Boolean)));
    const cities = Array.from(new Set(locations.map((l) => String(l.city ?? "").trim()).filter(Boolean)));

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

$(document).ready(async () => {
    const $textHeaderUsername = $("#text-header-username");
    const $textHeaderTypeUser = $("#text-header-type-user");

    const $btnOpenCreate = $("#btn-open-create-location");
    const $btnSubmitSearch = $("#btn-submit-search-location");
    const $inputSearch = $("#input-search-location");
    const $filterState = $("#select-filter-location-state");
    const $filterCity = $("#select-filter-location-city");

    const $table = $("#table-locations");

    const $modalCreate = $("#modal-create-location");
    const $btnModalClose = $("#btn-modal-close-location");
    const $btnModalCancel = $("#btn-modal-cancel-location");
    const $btnModalSave = $("#btn-modal-save-location");

    const $inputName = $("#input-create-location-name");
    const $inputAddress = $("#input-create-location-address");
    const $inputCity = $("#input-create-location-city");
    const $inputState = $("#input-create-location-state");
    const $inputCep = $("#input-create-location-cep");

    const $inputEditAddress = $("#input-edit-location-address");
    const $inputEditCity    = $("#input-edit-location-city");
    const $inputEditState   = $("#input-edit-location-state");
    const $inputEditCep     = $("#input-edit-location-cep");

    await showUserLogged($textHeaderUsername, $textHeaderTypeUser);

    await populateLocationFilters($filterState, $filterCity);

    const filterSelects = [
        { $el: $filterState, size: "sm" as const },
        { $el: $filterCity, size: "sm" as const },
    ];

    syncLocalTomSelectGroup(filterSelects.map(({ $el, size }) => ({ $el, size, allowEmpty: true })));

    await showLocationsTable($table, $inputSearch, $filterState, $filterCity, $btnSubmitSearch);

    $inputCep.on("input", (event) => {
        const target = event.currentTarget as HTMLInputElement;
        target.value = maskCep(target.value);
    });

    $inputEditCep.on("input", (event) => {
        const target = event.currentTarget as HTMLInputElement;
        target.value = maskCep(target.value);
    });

    const bindLocationCep = (
        $cep:     JQuery<HTMLElement>,
        $address: JQuery<HTMLElement>,
        $city:    JQuery<HTMLElement>,
        $state:   JQuery<HTMLElement>,
    ) => {
        bindCepAutoFill($cep, {
            mask: maskCep,
            onCepReady: async (cepValue) => {
                const address = await CepController.getAddress(cepValue);

                if (!address || address.erro) {
                    Toast.info("CEP nao encontrado.");
                    return;
                }

                if (address.logradouro) {
                    $address.val(address.logradouro);
                }

                if (address.localidade) {
                    $city.val(address.localidade);
                }

                if (address.uf) {
                    $state.val(address.uf);
                }
            },
        });
    };

    bindLocationCep($inputCep, $inputAddress, $inputCity, $inputState);
    bindLocationCep($inputEditCep, $inputEditAddress, $inputEditCity, $inputEditState);

    $btnOpenCreate.on("click", () => {
        openModal($modalCreate);
    });

    $btnModalSave.on("click", async (event) => {
        event.preventDefault();
        await ShowModalCreateLocation(
            $inputName,
            $inputAddress,
            $inputCity,
            $inputState,
            $inputCep,
            $btnModalSave,
            $modalCreate,
            $table,
        );
    });

    $btnModalClose.on("click", () => closeModal($modalCreate));
    $btnModalCancel.on("click", () => closeModal($modalCreate));
});
