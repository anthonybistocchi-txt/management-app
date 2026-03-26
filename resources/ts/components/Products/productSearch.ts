import { initRemoteTomSelect } from "../TomSelect/initTomSelect";
import type TomSelect from "tom-select";

type TomSelectSize = "sm" | "md" | "lg";

export function initProductSearch(selectEl: HTMLSelectElement, size?: TomSelectSize): TomSelect {
    return initRemoteTomSelect(selectEl, {
        url: "/api/products/search",
        placeholder: "Buscar produto",
        size,
        preloadOptions: [{ value: "all", text: "Todos" }],
        noResultsText: "Nenhum produto encontrado",
        mapResult: (p: { id: number; name: string }) => ({
            value: String(p.id),
            text: p.name,
        }),
    });
}
