<?php 

namespace App\Services;

use App\Repositories\Eloquent\DashboardRepository;

class DashboardService 
{
    protected $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function getDashboardData(array $filters = []): array
    {
        $dateFrom = $filters['date_from'] . ' 00:00:00';
        $dateTo   = $filters['date_to']   . ' 23:59:59'; 

        return $this->dashboardRepository->getDashboardData($dateFrom, $dateTo);

    }
}