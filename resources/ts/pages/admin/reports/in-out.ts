import $ from "jquery";
import { showUserLogged } from "../../../components/User/ShowUserLogged";
import { DatePicker } from "../../../components/DatePicker/flatpickr";
import type { InOutFilters } from "../../../components/Reports/in-out/showTable";
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

    let dateFrom = "";
    let dateTo   = "";

    const productSelectEl = $filterProduct[0] as HTMLSelectElement;
    if (productSelectEl) {
        initProductSearch(productSelectEl, "sm");
    }

    DatePicker.initRange($filterDateRangeInOut, (start, end) => {
        dateFrom = start;
        dateTo   = end;
    });

    await showUserLogged($textHeaderUsername, $textHeaderTypeUser);

    await Promise.allSettled([
        showCategories($filterCategory),
        showProviders($filterProvider),
        showLocations($filterLocation),
    ]);

    const localSelects = [$filterLocation, $filterMovementType, $filterCategory, $filterProvider];
    
    for (const $select of localSelects) 
    {
        const element = $select[0] as HTMLSelectElement;

        if (element) initLocalTomSelect(element, { size: "sm" });
    }

    const getSelectValue = ($element: JQuery<HTMLElement>, fallback = "all"): string => {
        const value = ($element.val() as string | null | undefined)?.toString().trim();
        return value ? value : fallback;
    };

    const buildFilters = (): InOutFilters => ({
        product_id:  getSelectValue($filterProduct),
        location_id: getSelectValue($filterLocation),
        type:        getSelectValue($filterMovementType),
        provider_id: getSelectValue($filterProvider),
        category_id: getSelectValue($filterCategory),
        date_from:   dateFrom,
        date_to:     dateTo,
    });

    // Monta a tabela na inicialização (com filtros padrão e range default do flatpickr).
    await showTableInOutReport($tableInOutReport, buildFilters());

    $btnSearchInOut.on("click", async (e) => {
        e.preventDefault();
        await showTableInOutReport($tableInOutReport, buildFilters());
    });
});
