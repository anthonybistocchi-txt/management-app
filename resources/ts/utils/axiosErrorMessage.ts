import { AxiosError } from "axios";

/**
 * Prefer messages returned by the API (English). Client-side fallbacks are in Portuguese for the UI.
 */
export function messageFromAxiosError(error: unknown, fallbackPt = "Erro na requisição."): string {
    if (!(error instanceof AxiosError)) {
        return "Erro inesperado.";
    }

    const status = error.response?.status;
    const data = error.response?.data as {
        message?: string;
        errors?: Record<string, string[] | string>;
    };

    if (data?.errors && typeof data.errors === "object") {
        const first = Object.values(data.errors).flat()[0];
        if (typeof first === "string") {
            return first;
        }
    }

    if (typeof data?.message === "string") {
        return data.message;
    }

    if (status === 419) {
        return "Sessão expirada. Atualize a página e tente novamente.";
    }

    return fallbackPt;
}
