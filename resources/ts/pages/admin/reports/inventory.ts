import $ from "jquery";
import { showUserLogged } from "../../../components/User/ShowUserLogged";
import { showTableInventory } from "../../../components/Reports/inventory/showTable";
import { showCategories } from "../../../components/ProductCategories/showCategories";
import { showLocations } from "../../../components/Locations/showLocations";
import { syncLocalTomSelectGroup } from "../../../components/TomSelect/initTomSelect";
import { initReportDownload } from "../../../components/Reports/shared/initReportDownload";
import type { InventoryFilters } from "../../../types/Reports/InventoryReport";

$(document).ready(async () => {
    const $username     = $("#text-header-username");
    const $typeUser     = $("#text-header-type-user");

    const $filterCategory = $("#filter-inventory-category");
    const $filterLocation = $("#filter-inventory-location");
    const $btnSearch      = $("#btn-search-inventory");
    const $table          = $("#table-inventory");

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

    const buildFilters = (): InventoryFilters => ({
        category_id: getSelectValue($filterCategory),
        location_id: getSelectValue($filterLocation),
    });

    await showTableInventory($table, buildFilters());

    $btnSearch.on("click", async (event) => {
        event.preventDefault();
        await showTableInventory($table, buildFilters());
    });

    initReportDownload({
        baseEndpoint: "reports/inventory",
        fileNameBase: "relatorio-inventario",
        buildFilters,
        $csvTrigger: $("#btn-download-inventory-csv"),
        $pdfTrigger: $("#btn-download-inventory-pdf"),
    });
});
