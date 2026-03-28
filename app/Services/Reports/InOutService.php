<?php

namespace App\Services\Reports;

use App\Repositories\Interfaces\StockMovementsRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class InOutService
{
    public function __construct(protected StockMovementsRepositoryInterface $stockMovementsRepository){}

    public function getInOutReportData(array $data): array
    {
        $allRows = $this->stockMovementsRepository->getInOutReportData($data);

        $start  = (int) ($data['start'] ?? 0);
        $length = (int) ($data['length'] ?? 10);

        $recordsTotal = $allRows->count();
        $pageRows = $allRows
            ->skip($start)
            ->take($length)
            ->values()
            ->all();

        return [
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data'            => $pageRows,
        ];
    }
}