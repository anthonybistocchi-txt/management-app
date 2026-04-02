export interface DashboardDateRangeValidationResult {
    message: string;
    kind: "info" | "error";
}

export function validateDashboardDateRange(startFilter: string, endFilter: string): DashboardDateRangeValidationResult | null {
    if (!startFilter || !endFilter) {
        return {
            kind: "info",
            message: "Selecione uma data completa"
        };
    }

    const startDate = new Date(startFilter);
    const endDate = new Date(endFilter);
    const today = new Date();

    if (Number.isNaN(startDate.getTime()) || Number.isNaN(endDate.getTime())) {
        return {
            kind: "error",
            message: "Selecione uma data válida"
        };
    }

    if (startDate > endDate) {
        return {
            kind: "error",
            message: "A data de início não pode ser posterior à data de fim."
        };
    }

    if (startDate > today) {
        return {
            kind: "error",
            message: "A data de início não pode ser no futuro."
        };
    }

    if (endDate > today) {
        return {
            kind: "error",
            message: "A data de fim não pode ser no futuro."
        };
    }

    return null;
}