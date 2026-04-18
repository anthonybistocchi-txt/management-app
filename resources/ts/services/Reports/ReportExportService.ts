import api from "../../utils/api";

/**
 * Formato suportado pelo backend para exportação de relatórios.
 * Cada formato tem o seu MIME type e extensão de ficheiro associados.
 */
export type ReportExportFormat = "csv" | "pdf";

interface ExportFormatDescriptor {
    mimeType:  string;
    extension: string;
}

const EXPORT_FORMAT_DESCRIPTORS: Record<ReportExportFormat, ExportFormatDescriptor> = {
    csv: { mimeType: "text/csv",         extension: "csv" },
    pdf: { mimeType: "application/pdf",  extension: "pdf" },
};

/**
 * Metadata devolvida pelo backend nos headers do PDF para informar
 * o utilizador quando a tabela foi capada por motivos de performance.
 */
export interface ReportExportMetadata {
    isTruncated: boolean;
    totalRows:   number | null;
    rowLimit:    number | null;
}

/**
 * Serviço responsável por chamar os endpoints de exportação dos
 * relatórios e disparar o download do ficheiro recebido como blob.
 *
 * Mantém-se agnóstico ao relatório concreto: quem chama passa o
 * caminho relativo (ex.: `reports/in-out/export/csv`) e os filtros.
 */
export const ReportExportService = {
    async download<TFilters extends object>(
        endpointPath:    string,
        filters:         TFilters,
        format:          ReportExportFormat,
        fileNameBase:    string,
    ): Promise<ReportExportMetadata> {
        const descriptor = EXPORT_FORMAT_DESCRIPTORS[format];

        const response = await api.post(endpointPath, filters, {
            responseType: "blob",
            headers:      { Accept: descriptor.mimeType },
        });

        const blob       = new Blob([response.data], { type: descriptor.mimeType });
        const objectUrl  = URL.createObjectURL(blob);
        const fileName   = `${fileNameBase}-${buildTimestamp()}.${descriptor.extension}`;

        triggerBrowserDownload(objectUrl, fileName);
        URL.revokeObjectURL(objectUrl);

        return extractMetadataFromHeaders(response.headers);
    },
};

function extractMetadataFromHeaders(headers: unknown): ReportExportMetadata {
    const raw = headers as Record<string, string | undefined> | undefined;

    const truncated = raw?.["x-pdf-truncated"];
    const total     = raw?.["x-pdf-total-rows"];
    const limit     = raw?.["x-pdf-row-limit"];

    return {
        isTruncated: truncated === "1",
        totalRows:   total ? Number.parseInt(total, 10) : null,
        rowLimit:    limit ? Number.parseInt(limit, 10) : null,
    };
}

/** "20260418-153022" — usado para diferenciar ficheiros baixados em sequência. */
function buildTimestamp(): string {
    const now = new Date();
    const pad = (value: number): string => value.toString().padStart(2, "0");

    return [
        now.getFullYear(),
        pad(now.getMonth() + 1),
        pad(now.getDate()),
    ].join("") + "-" + [
        pad(now.getHours()),
        pad(now.getMinutes()),
        pad(now.getSeconds()),
    ].join("");
}

function triggerBrowserDownload(objectUrl: string, fileName: string): void {
    const anchor = document.createElement("a");
    anchor.href     = objectUrl;
    anchor.download = fileName;
    anchor.style.display = "none";

    document.body.appendChild(anchor);
    anchor.click();
    document.body.removeChild(anchor);
}
