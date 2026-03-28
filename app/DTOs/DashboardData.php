<?php
namespace App\DTOs;

use Illuminate\Support\Collection;

readonly class DashboardData
{
    public function __construct(
        public ?object $topSellingProduct, 
        
        public Collection $salesMovements, 

        public Collection $salesMovementsPrevious,
        
        public int $totalSalesValue, 

        public int $totalSalesValuePrevious,

        public int $totalOrders,

        public Collection $topProducts,

        public Collection $recentSales,

        public int $lowStockCount,
        
        public Collection $salesByCategory
    ) {}
}