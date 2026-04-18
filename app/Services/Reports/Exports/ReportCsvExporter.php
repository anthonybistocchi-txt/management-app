<?php

namespace App\Services\Reports\Exports;

use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Gera o download de um relatório em CSV, em streaming, a partir
 * de um {@see ReportExportPayload}.
 *
 * - Usa `;` como separador (Excel pt-BR abre direto com duplo clique).
 * - Adiciona BOM UTF-8 para preservar acentos no Excel.
 */
class ReportCsvExporter
{
    private const CSV_SEPARATOR = ';';
    private const UTF8_BOM      = "\xEF\xBB\xBF";

    public function download(ReportExportPayload $payload): StreamedResponse
    {
        $fileName = $payload->fileNameBase . '-' . now()->format('Ymd-His') . '.csv';

        $response = new StreamedResponse(function () use ($payload) {
            $output = fopen('php://output', 'wb');

            fwrite($output, self::UTF8_BOM);

            $headerCells = array_map(
                static fn ($column) => $column->label,
                $payload->columns,
            );
            fputcsv($output, $headerCells, self::CSV_SEPARATOR);

            foreach ($payload->rows as $row) {
                $rowCells = array_map(
                    static fn ($column) => $column->format($row),
                    $payload->columns,
                );
                fputcsv($output, $rowCells, self::CSV_SEPARATOR);
            }

            fclose($output);
        });

        $response->headers->set('Content-Type', 'text/csv; charset=UTF-8');
        $response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $fileName));
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');

        return $response;
    }
}
