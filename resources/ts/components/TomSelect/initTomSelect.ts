import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.default.css";

type TomSelectSize = "sm" | "md" | "lg";

interface LocalTomSelectOptions {
    placeholder?: string;
    size?: TomSelectSize;
    allowEmpty?: boolean;
}

interface RemoteTomSelectOptions<TItem extends Record<string, unknown> = Record<string, unknown>> extends LocalTomSelectOptions {
    url: string;
    mapResult: (item: TItem) => { value: string; text: string };
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
export function initRemoteTomSelect<TItem extends Record<string, unknown>>(
    selectEl: HTMLSelectElement,
    opts: RemoteTomSelectOptions<TItem>,
): TomSelect {
    const preload: Array<{ value: string; text: string }> = opts.preloadOptions ?? [];

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
                .then((items: TItem[]) => callback(items.map(opts.mapResult)))
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
export function getTomSelectInstance($el: JQuery<HTMLElement>): TomSelect | null {
    return ($el.data("tomSelect") as TomSelect | null) ?? null;
}

/**
 * Helper: init + store on jQuery data for later retrieval.
 */
export function initAndStore(
    $el: JQuery<HTMLElement>,
    factory: (el: HTMLSelectElement) => TomSelect,
): TomSelect {
    const el = $el.get(0);

    if (!(el instanceof HTMLSelectElement)) {
        throw new Error("Select element not found");
    }

    const ts = factory(el);
    $el.data("tomSelect", ts);
    return ts;
}

export function syncLocalTomSelect(
    $el: JQuery<HTMLElement>,
    opts: LocalTomSelectOptions = {},
): TomSelect | null {
    const existing = getTomSelectInstance($el);

    if (existing) {
        existing.destroy();
    }

    const el = $el.get(0);
    if (!(el instanceof HTMLSelectElement)) {
        return null;
    }

    const ts = initLocalTomSelect(el, opts);
    $el.data("tomSelect", ts);

    return ts;
}

export function syncLocalTomSelectGroup(
    selects: Array<{ $el: JQuery<HTMLElement>; size?: TomSelectSize; allowEmpty?: boolean }>,
): void {
    selects.forEach(({ $el, size, allowEmpty }) => {
        syncLocalTomSelect($el, { size, allowEmpty });
    });
}
