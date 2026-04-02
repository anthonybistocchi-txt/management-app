import $ from "jquery";
import { showUserLogged } from "../../../components/User/ShowUserLogged";
import { DatePicker } from "../../../components/DatePicker/flatpickr";
import { showTableStockTurnover } from "../../../components/Reports/stock-turnover/showTable";
import { showCategories } from "../../../components/ProductCategories/showCategories";
import { showLocations } from "../../../components/Locations/showLocations";
import { syncLocalTomSelectGroup } from "../../../components/TomSelect/initTomSelect";
import type { StockTurnoverFilters } from "../../../types/Reports/StockTurnoverReport";

$(document).ready(async () => {
    const $username     = $("#text-header-username");
    const $typeUser     = $("#text-header-type-user");

    const $filterCategory = $("#filter-turnover-category");
    const $filterLocation = $("#filter-turnover-location");
    const $filterDate     = $("#filter-turnover-date-range");
    const $btnSearch      = $("#btn-search-turnover");
    const $table          = $("#table-stock-turnover");

    let dateFrom = "";
    let dateTo   = "";

    DatePicker.initRange($filterDate, (start, end) => {
        dateFrom = start;
        dateTo   = end;
    });

    await showUserLogged($username, $typeUser);

    await Promise.allSettled([
        showCategories($filterCategory),
        showLocations($filterLocation),
    ]);

    syncLocalTomSelectGroup([
        { $el: $filterCategory, size: "sm" as const },
        { $el: $filterLocation, size: "sm" as const },
    ]);

    const getSelectValue = ($element: JQuery<HTMLElement>, fallback = "all"): string => {
        const selectedValue = ($element.val() as string | null | undefined)?.toString().trim();
        return selectedValue ? selectedValue : fallback;
    };

    const buildFilters = (): StockTurnoverFilters => ({
        category_id: getSelectValue($filterCategory),
        location_id: getSelectValue($filterLocation),
        date_from:   dateFrom,
        date_to:     dateTo,
    });

    await showTableStockTurnover($table, buildFilters());

    $btnSearch.on("click", async (event) => {
        event.preventDefault();
        await showTableStockTurnover($table, buildFilters());
    });
});
