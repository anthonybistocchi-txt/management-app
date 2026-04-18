import $ from "jquery";
import { ReportExportController } from "../../../Controllers/Reports/ReportExportController";
import type { ReportExportFormat } from "../../../services/Reports/ReportExportService";
import { Toast } from "../../Swal/swal";

export interface InitReportDownloadOptions<TFilters extends object> {
    /** Caminho relativo do endpoint base (ex.: `reports/in-out`). */
    baseEndpoint: string;
    /** Prefixo do nome do ficheiro (ex.: `relatorio-entrada-saida`). */
    fileNameBase: string;
    /** Função que devolve os filtros vigentes no momento do clique. */
    buildFilters: () => TFilters;
    /** Botão (ou âncora) responsável por baixar em CSV. */
    $csvTrigger:  JQuery<HTMLElement>;
    /** Botão (ou âncora) responsável por baixar em PDF. */
    $pdfTrigger:  JQuery<HTMLElement>;
}

/**
 * Liga os botões "CSV" e "PDF" presentes no cabeçalho dos relatórios
 * ao {@link ReportExportController}, fazendo:
 *
 * - prevenção do comportamento default do anchor;
 * - feedback visual de "A gerar...";
 * - bloqueio contra múltiplos cliques enquanto o download está em curso;
 * - reabertura do `<details>` (dropdown) após o término.
 *
 * Mantém o callsite das páginas (`in-out.ts`, etc.) muito enxuto.
 */
export function initReportDownload<TFilters extends object>(
    options: InitReportDownloadOptions<TFilters>,
): void {
    bindTrigger(options.$csvTrigger, "csv", options);
    bindTrigger(options.$pdfTrigger, "pdf", options);
}

function bindTrigger<TFilters extends object>(
    $trigger:  JQuery<HTMLElement>,
    format:    ReportExportFormat,
    options:   InitReportDownloadOptions<TFilters>,
): void {
    if ($trigger.length === 0) return;

    let isDownloading = false;
    const originalLabel = $trigger.text();

    $trigger.on("click", async (event) => {
        event.preventDefault();

        if (isDownloading) return;
        isDownloading = true;

        $trigger.text("A gerar...").addClass("opacity-60 pointer-events-none");

        const result = await ReportExportController.download({
            baseEndpoint: options.baseEndpoint,
            filters:      options.buildFilters(),
            format,
            fileNameBase: options.fileNameBase,
        });

        $trigger.text(originalLabel).removeClass("opacity-60 pointer-events-none");
        isDownloading = false;

        // Fecha o dropdown <details> que envolve os botões, se existir,
        // independentemente do resultado para manter a UI limpa.
        $trigger.closest("details").removeAttr("open");

        if (!result.success) {
            Toast.error(result.message ?? "Falha ao exportar relatório.");
            return;
        }

        Toast.success(`Download ${format.toUpperCase()} gerado com sucesso.`);

        // Quando o PDF é capado por motivos de performance, avisa o utilizador
        // logo a seguir ao toast de sucesso para que perceba que precisa do CSV
        // se quiser o dataset integral.
        if (format === "pdf" && result.metadata?.isTruncated) {
            const total = result.metadata.totalRows ?? 0;
            const limit = result.metadata.rowLimit  ?? 0;
            window.setTimeout(() => {
                Toast.info(
                    `PDF limitado a ${limit.toLocaleString("pt-PT")} de ${total.toLocaleString("pt-PT")} linhas. ` +
                    "Use CSV para o dataset completo.",
                );
            }, 600);
        }
    });
}
