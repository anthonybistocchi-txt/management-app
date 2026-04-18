<?php

namespace App\Services\Reports\Exports;

use App\Services\Reports\InventoryService;

/**
 * Responsável por montar o {@see ReportExportPayload} do relatório
 * "Inventário". Não faz I/O HTTP — só recebe filtros já validados,
 * busca os dados via {@see InventoryService} e devolve o payload pronto.
 */
class InventoryExportService
{
    public function __construct(protected InventoryService $inventoryService) {}

    public function buildPayload(array $filters): ReportExportPayload
    {
        $rows                 = $this->inventoryService->getInventoryForExport($filters);
        $totalInventoryValue  = (int) $rows->sum(fn ($row) => (int) ($row->total_value ?? 0));
        $columns              = $this->buildColumns();

        return new ReportExportPayload(
            title:        'Relatório de Inventário',
            subtitle:     'Posição atual do estoque',
            filterLines:  [
                'Categoria'            => $this->describeIdFilter($filters['category_id'] ?? 'all'),
                'Localização'          => $this->describeIdFilter($filters['location_id'] ?? 'all'),
                'Total de registos'    => (string) $rows->count(),
                'Valor total apurado'  => ReportFormatter::priceFromCents($totalInventoryValue),
            ],
            columns:      $columns,
            rows:         $rows,
            fileNameBase: 'relatorio-inventario',
        );
    }

    /** @return array<int, ReportExportColumn> */
    private function buildColumns(): array
    {
        return [
            new ReportExportColumn('Produto',     fn ($row) => ReportFormatter::orDash($row->product_name ?? null),                                widthPercent: 30),
            new ReportExportColumn('Categoria',   fn ($row) => ReportFormatter::orDash($row->category_name ?? null),                               widthPercent: 18),
            new ReportExportColumn('Local',       fn ($row) => ReportFormatter::orDash($row->location_name ?? null),                               widthPercent: 18),
            new ReportExportColumn('Quantidade',  fn ($row) => (string) ($row->quantity ?? 0),                          align: 'right', widthPercent: 10),
            new ReportExportColumn('Preço unit.', fn ($row) => ReportFormatter::priceFromCents($row->price ?? 0),       align: 'right', widthPercent: 12),
            new ReportExportColumn('Valor total', fn ($row) => ReportFormatter::priceFromCents($row->total_value ?? 0), align: 'right', widthPercent: 12),
        ];
    }

    private function describeIdFilter(string $value): string
    {
        return $value === 'all' ? 'Todos' : '#' . $value;
    }
}
