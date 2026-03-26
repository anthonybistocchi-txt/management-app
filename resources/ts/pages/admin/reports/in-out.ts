import $ from "jquery";
import { showUserLogged } from "../../../components/User/ShowUserLogged";
import { DatePicker } from "../../../components/DatePicker/flatpickr";
import { showTableInOutReport } from "../../../components/Reports/in-out/showTable";
import { showCategories } from "../../../components/ProductCategories/showCategories";
import { showProviders } from "../../../components/Providers/ShowProviders";
import { showLocations } from "../../../components/Locations/showLocations";
import { initProductSearch } from "../../../components/Products/productSearch";
import { initLocalTomSelect } from "../../../components/TomSelect/initTomSelect";

$(document).ready(async () => {
    const $textHeaderUsername = $("#text-header-username");
    const $textHeaderTypeUser = $("#text-header-type-user");

    const $filterDateRangeInOut = $("#filter-in-out-date-range");
    const $tableInOutReport     = $("#table-in-out-report");
    const $filterMovementType   = $("#filter-in-out-movement-type");
    const $filterCategory       = $("#filter-in-out-category");
    const $filterProvider       = $("#filter-in-out-provider");
    const $filterLocation       = $("#filter-in-out-location");
    const $btnSearchInOut       = $("#btn-search-in-out");
    const $filterProduct        = $("#filter-in-out-product");

    const productSelectEl = $filterProduct[0] as HTMLSelectElement;
    if (productSelectEl) {
        initProductSearch(productSelectEl, "sm");
    }

    DatePicker.initRange($filterDateRangeInOut, (_start, _end) => {});

    await showUserLogged($textHeaderUsername, $textHeaderTypeUser);
    showTableInOutReport($tableInOutReport);

    await Promise.allSettled([
        showCategories($filterCategory),
        showProviders($filterProvider),
        showLocations($filterLocation),
    ]);

    const localSelects = [$filterLocation, $filterMovementType, $filterCategory, $filterProvider];
    
    for (const $sel of localSelects) 
    {
        const el = $sel[0] as HTMLSelectElement | undefined;

        if (el) initLocalTomSelect(el, { size: "sm" });
    }

    $btnSearchInOut.on("click", async (e) => {
        e.preventDefault();
        await showTableInOutReport($tableInOutReport);
    });
});
