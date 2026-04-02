export interface RenderSelectOptionItem {
    value: string;
    label: string;
    data?: Record<string, string | number | boolean | null | undefined>;
}

export interface RenderSelectOptionsConfig {
    placeholder?: string;
    includeAllOption?: string;
    disabled?: boolean;
}

function escapeHtml(value: string): string {
    return value
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/\"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

function buildDataAttributes(data?: RenderSelectOptionItem["data"]): string {
    if (!data) {
        return "";
    }

    return Object.entries(data)
        .filter(([, value]) => value !== null && value !== undefined && value !== "")
        .map(([key, value]) => ` data-${key.replace(/[A-Z]/g, (letter) => `-${letter.toLowerCase()}`)}="${escapeHtml(String(value))}"`)
        .join("");
}

export function renderSelectOptions(
    $select: JQuery<HTMLElement>,
    items: RenderSelectOptionItem[],
    config: RenderSelectOptionsConfig = {},
): void {
    $select.empty();

    if (config.placeholder) {
        $select.append(`<option value="" selected disabled>${escapeHtml(config.placeholder)}</option>`);
    }

    if (config.includeAllOption) {
        $select.append(`<option value="all">${escapeHtml(config.includeAllOption)}</option>`);
    }

    items.forEach((item) => {
        const dataAttributes = buildDataAttributes(item.data);
        $select.append(`<option value="${escapeHtml(item.value)}"${dataAttributes}>${escapeHtml(item.label)}</option>`);
    });

    if (typeof config.disabled === "boolean") {
        $select.prop("disabled", config.disabled);
    }
}