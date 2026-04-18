<?php 
namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface StockMovementsRepositoryInterface
{
    public function logEntry(array $data);
    public function logExit(array $data);
    public function logTransfer(array $data);
    public function getInOutReportData(array $data): Collection;
    public function getStockCardData(array $data): Collection;
    public function getStockTurnoverData(array $data): Collection;
}