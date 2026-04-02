import $ from "jquery";
import { showUserLogged } from "../../../components/User/ShowUserLogged";
import { DatePicker } from "../../../components/DatePicker/flatpickr";
import { showTableStockCard } from "../../../components/Reports/stock-card/showTable";
import { showLocations } from "../../../components/Locations/showLocations";
import { initProductSearch } from "../../../components/Products/productSearch";
import { syncLocalTomSelectGroup } from "../../../components/TomSelect/initTomSelect";
import type { StockCardFilters } from "../../../types/Reports/StockCardReport";

$(document).ready(async () => {
    const $username     = $("#text-header-username");
    const $typeUser     = $("#text-header-type-user");

    const $filterProduct  = $("#filter-stock-card-product");
    const $filterLocation = $("#filter-stock-card-location");
    const $filterDate     = $("#filter-stock-card-date-range");
    const $btnSearch      = $("#btn-search-stock-card");
    const $table          = $("#table-stock-card");

    let dateFrom = "";
    let dateTo   = "";

    const productEl = $filterProduct[0] as HTMLSelectElement;
    if (productEl) {
        initProductSearch(productEl, "sm");
    }

    DatePicker.initRange($filterDate, (start, end) => {
        dateFrom = start;
        dateTo   = end;
    });

    await showUserLogged($username, $typeUser);
    await showLocations($filterLocation);

    syncLocalTomSelectGroup([
        { $el: $filterLocation, size: "sm" as const },
    ]);

    const getSelectValue = ($element: JQuery<HTMLElement>, fallback = "all"): string => {
        const selectedValue = ($element.val() as string | null | undefined)?.toString().trim();
        return selectedValue ? selectedValue : fallback;
    };

    const buildFilters = (): StockCardFilters => ({
        product_id:  getSelectValue($filterProduct),
        location_id: getSelectValue($filterLocation),
        date_from:   dateFrom,
        date_to:     dateTo,
    });

    await showTableStockCard($table, buildFilters());

    $btnSearch.on("click", async (event) => {
        event.preventDefault();
        await showTableStockCard($table, buildFilters());
    });
});
