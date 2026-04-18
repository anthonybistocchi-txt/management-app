<?php

namespace App\Services\Reports\Exports;

use App\Services\Reports\InOutService;

/**
 * Responsável por montar o {@see ReportExportPayload} do relatório
 * "Entrada e Saída" — definição de colunas, rótulos de filtros,
 * subtítulo, nome do ficheiro, etc.
 *
 * Mantém os controllers livres de qualquer lógica de apresentação
 * para CSV/PDF: o controller apenas valida a request e delega aqui.
 */
class InOutExportService
{
    public function __construct(protected InOutService $inOutService) {}

    public function buildPayload(array $filters): ReportExportPayload
    {
        $rows    = $this->inOutService->getInOutReportForExport($filters);
        $columns = $this->buildColumns();

        return new ReportExportPayload(
            title:        'Relatório de Entrada e Saída',
            subtitle:     ReportFormatter::periodSubtitle($filters['date_from'] ?? null, $filters['date_to'] ?? null),
            filterLines:  [
                'Tipo de movimentação' => $this->describeMovementType($filters['type']        ?? 'all'),
                'Categoria'            => $this->describeIdFilter   ($filters['category_id'] ?? 'all'),
                'Localização'          => $this->describeIdFilter   ($filters['location_id'] ?? 'all'),
                'Fornecedor'           => $this->describeIdFilter   ($filters['provider_id'] ?? 'all'),
                'Produto'              => $this->describeIdFilter   ($filters['product_id']  ?? 'all'),
                'Total de registos'    => (string) $rows->count(),
            ],
            columns:      $columns,
            rows:         $rows,
            fileNameBase: 'relatorio-entrada-saida',
        );
    }

    /** @return array<int, ReportExportColumn> */
    private function buildColumns(): array
    {
        return [
            new ReportExportColumn('Produto',     fn ($row) => ReportFormatter::orDash($row->product_name ?? null),                widthPercent: 18),
            new ReportExportColumn('Tipo',        fn ($row) => ReportFormatter::movementType($row->type ?? null),                  widthPercent:  8),
            new ReportExportColumn('Quantidade',  fn ($row) => (string) ($row->quantity_moved ?? 0),                align: 'right', widthPercent:  8),
            new ReportExportColumn('Data',        fn ($row) => ReportFormatter::dateTime($row->movement_date ?? null),             widthPercent: 11),
            new ReportExportColumn('Categoria',   fn ($row) => ReportFormatter::orDash($row->category_name ?? null),               widthPercent: 12),
            new ReportExportColumn('Local',       fn ($row) => ReportFormatter::orDash($row->location_name ?? null),               widthPercent: 11),
            new ReportExportColumn('Fornecedor',  fn ($row) => ReportFormatter::orDash($row->provider_name ?? null),               widthPercent: 12),
            new ReportExportColumn('Descrição',   fn ($row) => ReportFormatter::orDash($row->description ?? null),                 widthPercent: 20),
        ];
    }

    private function describeMovementType(string $value): string
    {
        if ($value === 'all') return 'Todos';

        return ReportFormatter::movementType($value);
    }

    private function describeIdFilter(string $value): string
    {
        return $value === 'all' ? 'Todos' : '#' . $value;
    }
}
