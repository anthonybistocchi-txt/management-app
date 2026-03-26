import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.default.css";

type TomSelectSize = "sm" | "md" | "lg";

interface LocalTomSelectOptions {
    placeholder?: string;
    size?: TomSelectSize;
    allowEmpty?: boolean;
}

interface RemoteTomSelectOptions extends LocalTomSelectOptions {
    url: string;
    mapResult: (item: any) => { value: string; text: string };
    preloadOptions?: { value: string; text: string }[];
    noResultsText?: string;
}

/**
 * Wraps a native <select> with Tom Select for local filtering.
 * Reads existing <option> elements from the DOM.
 */
export function initLocalTomSelect(
    selectEl: HTMLSelectElement,
    opts: LocalTomSelectOptions = {},
): TomSelect {
    const ts = new TomSelect(selectEl, {
        placeholder: opts.placeholder,
        allowEmptyOption: opts.allowEmpty ?? true,
        closeAfterSelect: true,
        maxOptions: 50,
    });

    if (opts.size) {
        ts.wrapper.classList.add(`ts-size-${opts.size}`);
    }

    return ts;
}

/**
 * Wraps a native <select> with Tom Select for remote search-as-you-type.
 */
export function initRemoteTomSelect(
    selectEl: HTMLSelectElement,
    opts: RemoteTomSelectOptions,
): TomSelect {
    const preload = (opts.preloadOptions ?? []) as Array<{ value: string; text: string }>;

    const ts = new TomSelect(selectEl, {
        valueField: "value",
        labelField: "text",
        searchField: ["text"],
        placeholder: opts.placeholder,
        options: preload,
        items: [],

        load(query: string, callback: (results: Array<{ value: string; text: string }>) => void) {
            if (!query.length) return callback([]);

            fetch(`${opts.url}?q=${encodeURIComponent(query)}`)
                .then((res) => res.json())
                .then((items: any[]) => callback(items.map(opts.mapResult)))
                .catch(() => callback([]));
        },

        loadThrottle: 300,
        closeAfterSelect: true,
        maxOptions: 20,

        render: {
            no_results() {
                return `<div class="ts-no-results">${opts.noResultsText ?? "Nenhum resultado encontrado"}</div>`;
            },
        },
    });

    if (opts.size) {
        ts.wrapper.classList.add(`ts-size-${opts.size}`);
    }

    return ts;
}

/**
 * Retrieves TomSelect instance from a jQuery element (stored via $.data).
 */
export function getTomSelectInstance($el: JQuery<HTMLElement>): TomSelect | undefined {
    return $el.data("tomSelect") as TomSelect | undefined;
}

/**
 * Helper: init + store on jQuery data for later retrieval.
 */
export function initAndStore(
    $el: JQuery<HTMLElement>,
    factory: (el: HTMLSelectElement) => TomSelect,
): TomSelect {
    const el = $el[0] as HTMLSelectElement;
    if (!el) throw new Error("Select element not found");
    const ts = factory(el);
    $el.data("tomSelect", ts);
    return ts;
}
