<?php

namespace App\Services\Reports\Exports;

use App\Services\Reports\StockCardService;

/**
 * Responsável por montar o {@see ReportExportPayload} do relatório
 * "Ficha de Estoque". Concentra a definição de colunas e a lógica
 * de formatação de quantidade com sinal (+/-) por tipo de movimentação.
 */
class StockCardExportService
{
    public function __construct(protected StockCardService $stockCardService) {}

    public function buildPayload(array $filters): ReportExportPayload
    {
        $rows    = $this->stockCardService->getStockCardForExport($filters);
        $columns = $this->buildColumns();

        return new ReportExportPayload(
            title:        'Ficha de Estoque',
            subtitle:     ReportFormatter::periodSubtitle($filters['date_from'] ?? null, $filters['date_to'] ?? null),
            filterLines:  [
                'Produto'           => $this->describeIdFilter($filters['product_id']  ?? 'all'),
                'Localização'       => $this->describeIdFilter($filters['location_id'] ?? 'all'),
                'Total de registos' => (string) $rows->count(),
            ],
            columns:      $columns,
            rows:         $rows,
            fileNameBase: 'ficha-de-estoque',
        );
    }

    /** @return array<int, ReportExportColumn> */
    private function buildColumns(): array
    {
        return [
            new ReportExportColumn('Data',        fn ($row) => ReportFormatter::dateTime($row->movement_date ?? null),                                widthPercent: 12),
            new ReportExportColumn('Tipo',        fn ($row) => ReportFormatter::movementType($row->type ?? null),                                     widthPercent:  9),
            new ReportExportColumn('Quantidade',  fn ($row) => $this->renderSignedQuantity($row),                       align: 'right', widthPercent:  9),
            new ReportExportColumn('Saldo antes', fn ($row) => (string) ($row->quantity_before ?? '—'),                 align: 'right', widthPercent: 10),
            new ReportExportColumn('Saldo após',  fn ($row) => (string) ($row->quantity_after  ?? '—'),                 align: 'right', widthPercent: 10),
            new ReportExportColumn('Local',       fn ($row) => ReportFormatter::orDash($row->location_name ?? null),                                  widthPercent: 14),
            new ReportExportColumn('Fornecedor',  fn ($row) => ReportFormatter::orDash($row->provider_name ?? null),                                  widthPercent: 14),
            new ReportExportColumn('Descrição',   fn ($row) => ReportFormatter::orDash($row->description ?? null),                                    widthPercent: 22),
        ];
    }

    private function renderSignedQuantity(mixed $row): string
    {
        $quantity = (int) ($row->quantity_moved ?? 0);
        $type     = strtolower((string) ($row->type ?? ''));

        return match ($type) {
            'in'    => '+' . $quantity,
            'out'   => '-' . $quantity,
            default => (string) $quantity,
        };
    }

    private function describeIdFilter(string $value): string
    {
        return $value === 'all' ? 'Todos' : '#' . $value;
    }
}
