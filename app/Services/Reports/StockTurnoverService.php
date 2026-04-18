<?php

namespace App\Services\Reports;

use App\Repositories\Interfaces\StockMovementsRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class StockTurnoverService
{
    public function __construct(protected StockMovementsRepositoryInterface $stockMovementsRepository) {}

    public function getStockTurnoverData(array $data): array
    {
        $allRows = $this->stockMovementsRepository->getStockTurnoverData($data);

        $start  = (int) ($data['start'] ?? 0);
        $length = (int) ($data['length'] ?? 10);

        $recordsTotal = $allRows->count();
        $pageRows     = $allRows->skip($start)->take($length)->values()->all();

        return [
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data'            => $pageRows,
        ];
    }

    /**
     * Devolve todas as linhas (sem paginação) para serem usadas
     * pelas exportações de CSV/PDF.
     */
    public function getStockTurnoverForExport(array $data): Collection
    {
        return $this->stockMovementsRepository->getStockTurnoverData($data);
    }
}
