<?php
namespace App\DTOs;

use Illuminate\Support\Collection;

readonly class DashboardData
{
    public function __construct(
        public ?object $topSellingProduct, 
        
        public Collection $salesMovements, 
        
        public int $totalSalesValue, 
        
        public Collection $salesByCategory
    ) {}
}