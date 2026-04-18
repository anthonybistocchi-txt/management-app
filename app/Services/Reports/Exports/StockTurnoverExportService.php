<?php

namespace App\Services\Reports\Exports;

use App\Services\Reports\StockTurnoverService;

/**
 * Responsável por montar o {@see ReportExportPayload} do relatório
 * "Giro de Estoque". Define colunas e formata o valor numérico do giro
 * no padrão pt-BR (vírgula como separador decimal).
 */
class StockTurnoverExportService
{
    public function __construct(protected StockTurnoverService $stockTurnoverService) {}

    public function buildPayload(array $filters): ReportExportPayload
    {
        $rows    = $this->stockTurnoverService->getStockTurnoverForExport($filters);
        $columns = $this->buildColumns();

        return new ReportExportPayload(
            title:        'Giro de Estoque',
            subtitle:     ReportFormatter::periodSubtitle($filters['date_from'] ?? null, $filters['date_to'] ?? null),
            filterLines:  [
                'Categoria'         => $this->describeIdFilter($filters['category_id'] ?? 'all'),
                'Localização'       => $this->describeIdFilter($filters['location_id'] ?? 'all'),
                'Total de registos' => (string) $rows->count(),
            ],
            columns:      $columns,
            rows:         $rows,
            fileNameBase: 'giro-de-estoque',
        );
    }

    /** @return array<int, ReportExportColumn> */
    private function buildColumns(): array
    {
        return [
            new ReportExportColumn('Produto',    fn ($row) => ReportFormatter::orDash($row->product_name ?? null),                            widthPercent: 38),
            new ReportExportColumn('Categoria',  fn ($row) => ReportFormatter::orDash($row->category_name ?? null),                           widthPercent: 24),
            new ReportExportColumn('Entradas',   fn ($row) => (string) ($row->total_in  ?? 0),                  align: 'right', widthPercent: 12),
            new ReportExportColumn('Saídas',     fn ($row) => (string) ($row->total_out ?? 0),                  align: 'right', widthPercent: 12),
            new ReportExportColumn('Giro',       fn ($row) => $this->formatTurnover($row->turnover ?? 0),       align: 'right', widthPercent: 14),
        ];
    }

    private function formatTurnover(mixed $value): string
    {
        return number_format((float) $value, 2, ',', '.');
    }

    private function describeIdFilter(string $value): string
    {
        return $value === 'all' ? 'Todos' : '#' . $value;
    }
}
