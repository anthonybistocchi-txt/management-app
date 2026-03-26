<?php

namespace App\Services\Reports;

use App\Repositories\Interfaces\StockMovementsRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class InOutService
{
    public function __construct(protected StockMovementsRepositoryInterface $stockMovementsRepository){}

    public function getInOutReportData(array $data): Collection
    {
        return $this->stockMovementsRepository->getInOutReportData($data);
    }
}