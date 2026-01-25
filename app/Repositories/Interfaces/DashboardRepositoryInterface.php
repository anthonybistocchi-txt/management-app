<?php
namespace App\Repositories\Interfaces;

use App\DTOs\DashboardData;

interface DashboardRepositoryInterface
{
    public function getDashboardData($dateFrom, $dateTo): DashboardData;
}