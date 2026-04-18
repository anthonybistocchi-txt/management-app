import { AxiosError } from "axios";
import {
    ReportExportService,
    type ReportExportFormat,
    type ReportExportMetadata,
} from "../../services/Reports/ReportExportService";

export interface ReportExportRequest<TFilters extends object> {
    /** Caminho relativo (sem `/api/`) do endpoint base do relatório, ex.: `reports/in-out`. */
    baseEndpoint: string;
    /** Filtros aplicados na tabela; serão enviados ao backend tal e qual. */
    filters:      TFilters;
    /** Formato pretendido pelo utilizador. */
    format:       ReportExportFormat;
    /** Prefixo do nome do ficheiro final (ex.: `relatorio-entrada-saida`). */
    fileNameBase: string;
}

export interface ReportExportResult {
    success: boolean;
    message?: string;
    /** Metadados devolvidos pelo backend (apenas em sucesso). */
    metadata?: ReportExportMetadata;
}

/**
 * Camada fina entre as páginas de relatórios e o serviço de export.
 *
 * - Centraliza a montagem do endpoint final (`{base}/export/{format}`).
 * - Trata erros de Axios devolvendo um resultado tipado para a UI
 *   poder mostrar feedback (toasts, etc.) sem precisar conhecer o axios.
 */
export const ReportExportController = {
    async download<TFilters extends object>(
        request: ReportExportRequest<TFilters>,
    ): Promise<ReportExportResult> {
        const endpointPath = `${request.baseEndpoint}/export/${request.format}`;

        try {
            const metadata = await ReportExportService.download(
                endpointPath,
                request.filters,
                request.format,
                request.fileNameBase,
            );

            return { success: true, metadata };
        } catch (error) {
            const message = await extractErrorMessage(error, request.format);
            console.error("Falha ao exportar relatório:", message, error);

            return { success: false, message };
        }
    },
};

async function extractErrorMessage(error: unknown, format: ReportExportFormat): Promise<string> {
    if (error instanceof AxiosError) {
        const status = error.response?.status;

        // O backend devolveu uma mensagem JSON, mas como pedimos `responseType: "blob"`
        // o axios entrega a resposta como Blob. Tentamos extrair a mensagem real.
        const detailedMessage = await readErrorMessageFromBlob(error);
        if (detailedMessage) {
            return detailedMessage;
        }

        if (status === 422) {
            return "Filtros inválidos para a exportação. Reveja os campos e tente novamente.";
        }
        if (status === 401 || status === 403) {
            return "Sem permissão para exportar este relatório.";
        }
        if (status === 413) {
            return "O relatório é demasiado grande para exportar. Refine os filtros e tente novamente.";
        }
    }

    return `Não foi possível gerar o download ${format.toUpperCase()}. Tente novamente em instantes.`;
}

/**
 * Lê a `error.response.data` (que vem como Blob por causa do `responseType: "blob"`)
 * e tenta extrair uma mensagem legível: prioriza `message` JSON do Laravel; se for
 * 422, junta os erros de validação; caso contrário devolve `null`.
 */
async function readErrorMessageFromBlob(error: AxiosError): Promise<string | null> {
    const data = error.response?.data;
    if (!(data instanceof Blob) || data.size === 0) return null;

    try {
        const text = await data.text();
        const parsed = JSON.parse(text) as {
            message?: string;
            errors?:  Record<string, string[]>;
        };

        if (parsed.errors && typeof parsed.errors === "object") {
            const firstField = Object.keys(parsed.errors)[0];
            const firstError = firstField ? parsed.errors[firstField]?.[0] : undefined;
            if (firstError) return firstError;
        }

        if (parsed.message) return parsed.message;
    } catch {
        // Não é JSON; ignora silenciosamente para devolver mensagem genérica.
    }

    return null;
}
