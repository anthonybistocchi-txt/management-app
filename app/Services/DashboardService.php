<?php 

namespace App\Services;

use App\DTOs\DashboardData;
use App\Repositories\Eloquent\DashboardRepository;

class DashboardService 
{
    public function __construct(protected DashboardRepository $dashboardRepository){}

    public function getDashboardData(array $filters = []): DashboardData
    {
        $dateFrom = $filters['date_from'] . ' 00:00:00';
        $dateTo   = $filters['date_to']   . ' 23:59:59'; 

        return $this->dashboardRepository->getDashboardData($dateFrom, $dateTo);

    }
}