<?php

namespace App\Services\Reports\Exports;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

/**
 * Renderiza um {@see ReportExportPayload} num PDF estilizado e
 * devolve a resposta de download.
 *
 * Usa a view Blade `exports.pdf.report` como template comum
 * (cabeçalho institucional + filtros + tabela + rodapé com paginação),
 * mantendo o layout de todos os relatórios consistente.
 *
 * Como o DomPDF não foi desenhado para tabelas com milhares de
 * linhas (consome memória de forma quadrática ao montar o stylesheet),
 * aplicamos um cap defensivo via {@see self::PDF_MAX_ROWS}. Para
 * dataset completo o utilizador deve usar a exportação CSV.
 */
class ReportPdfExporter
{
    /** Limite de memória PHP elevado durante o request de export. */
    private const PDF_MEMORY_LIMIT = '2048M';

    /** Tempo máximo de render por PDF (em segundos). */
    private const PDF_TIME_LIMIT   = 240;

    /**
     * Número máximo de linhas que entram no PDF.
     *
     * O DomPDF aloca memória de forma ~quadrática a montar o `Cellmap`
     * ({@see vendor/dompdf/dompdf/src/Cellmap.php}). Mesmo com o template
     * optimizado (sem `border-collapse: collapse`, sem borders por
     * célula e com `table-layout: fixed`), valores acima de ~500 linhas
     * arriscam exceder os 2 GB de memória durante o render.
     *
     * 500 oferece um bom equilíbrio: PDF legível (~10 páginas A4 paisagem)
     * e tempo de geração inferior a ~30s. Acima deste valor a tabela é
     * truncada e o template mostra um aviso visível recomendando o CSV
     * para dataset integral.
     */
    public const PDF_MAX_ROWS = 500;

    public function download(ReportExportPayload $payload): Response
    {
        $this->raiseRuntimeLimitsForLargeReports();

        [$rowsForPdf, $totalRows, $isTruncated] = $this->cropRowsForPdf($payload->rows);

        $fileName = $payload->fileNameBase . '-' . now()->format('Ymd-His') . '.pdf';

        $pdf = Pdf::loadView('exports.pdf.report', [
            'payload'         => $payload,
            'rows'            => $rowsForPdf,
            'totalRows'       => $totalRows,
            'isTruncated'     => $isTruncated,
            'pdfMaxRows'      => self::PDF_MAX_ROWS,
            'generatedAt'     => now()->format('d/m/Y H:i'),
        ])
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'defaultFont'          => 'sans-serif',
                'isRemoteEnabled'      => false,
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled'         => false,
                'dpi'                  => 96,
            ]);

        $response = $pdf->download($fileName);

        // Cabeçalhos consumidos pelo frontend para mostrar um toast
        // informativo quando a tabela do PDF foi capada.
        $response->headers->set('X-Pdf-Total-Rows', (string) $totalRows);
        $response->headers->set('X-Pdf-Row-Limit', (string) self::PDF_MAX_ROWS);
        $response->headers->set('X-Pdf-Truncated', $isTruncated ? '1' : '0');
        $response->headers->set('Access-Control-Expose-Headers', 'X-Pdf-Truncated, X-Pdf-Total-Rows, X-Pdf-Row-Limit');

        return $response;
    }

    /**
     * Eleva memory_limit e max_execution_time para o request actual.
     * Sem isto, o DomPDF rebenta em relatórios com muitas linhas
     * (ex.: Entrada/Saída) ao montar o stylesheet em runtime.
     */
    private function raiseRuntimeLimitsForLargeReports(): void
    {
        @ini_set('memory_limit', self::PDF_MEMORY_LIMIT);

        if (function_exists('set_time_limit')) {
            @set_time_limit(self::PDF_TIME_LIMIT);
        }
    }

    /**
     * Aplica o cap de {@see self::PDF_MAX_ROWS} nas linhas a renderizar
     * no PDF e devolve um triplo `[linhasCortadas, totalOriginal, foiTruncado]`.
     *
     * Para o template é mais simples receber sempre uma `Collection`.
     *
     * @param iterable<int, mixed> $rows
     * @return array{0: Collection, 1: int, 2: bool}
     */
    private function cropRowsForPdf(iterable $rows): array
    {
        $allRows    = $rows instanceof Collection ? $rows : Collection::make($rows);
        $totalRows  = $allRows->count();
        $isTruncated = $totalRows > self::PDF_MAX_ROWS;

        $rowsForPdf = $isTruncated
            ? $allRows->take(self::PDF_MAX_ROWS)->values()
            : $allRows;

        return [$rowsForPdf, $totalRows, $isTruncated];
    }
}
