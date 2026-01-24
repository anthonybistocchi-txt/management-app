<?php 

namespace App\Repositories\Eloquent;

use App\DTOs\DashboardData;
use App\Models\StockMovements;
use App\Repositories\Interfaces\DashboardRepositoryInterface;
use App\Models\StockMovement; // Importando o Model
use Illuminate\Support\Facades\DB;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function getDashboardData($dateFrom, $dateTo): DashboardData
    {
        return new DashboardData(
            $this->getProductTopSale($dateFrom, $dateTo),
            $this->getMovimentsSales($dateFrom, $dateTo),
            $this->getTotalSales($dateFrom, $dateTo),
            $this->getSalesCategorys($dateFrom, $dateTo),
        );
    }

    private function getProductTopSale($dateFrom, $dateTo)
    {
        return StockMovements::select(
                'products.id', 
                'products.name', 
                DB::raw('SUM(stock_movements.quantity_moved) as total_sold')
            )
            ->join('products', 'stock_movements.product_id', '=', 'products.id') 
            ->where('stock_movements.type', 'out') 
            ->whereBetween('stock_movements.created_at', [$dateFrom, $dateTo])
            ->groupBy('products.id', 'products.name') 
            ->orderByDesc('total_sold')
            ->first();
    }

    private function getMovimentsSales($dateFrom, $dateTo)
    {
        return StockMovements::select(
                DB::raw('DATE(stock_movements.created_at) as sell_date'),
                'products.name',
                DB::raw('SUM(stock_movements.quantity_moved) as total_sold')
            )
            ->join('products', 'stock_movements.product_id', '=', 'products.id')
            ->whereBetween('stock_movements.created_at', [$dateFrom, $dateTo])
            ->where('stock_movements.type', 'out')
            ->groupBy(DB::raw('DATE(stock_movements.created_at)'), 'products.name')
            ->orderBy('sell_date', 'asc')
            ->get();
    }

    private function getTotalSales($dateFrom, $dateTo)
    {
        return StockMovements::where('stock_movements.type', 'out')
            ->join('products', 'stock_movements.product_id', '=', 'products.id') 
            ->whereBetween('stock_movements.created_at', [$dateFrom, $dateTo])
            ->sum(DB::raw('products.price * stock_movements.quantity_moved'));
    }

    private function getSalesCategorys($dateFrom, $dateTo)
    {
        return StockMovements::select(
                'category_products.name as category_name',
                DB::raw('SUM(stock_movements.quantity_moved) as total_quantity'),
                DB::raw('SUM(products.price * stock_movements.quantity_moved) as total_sales')
            )
            ->join('products', 'stock_movements.product_id', '=', 'products.id') 
            ->join('category_products', 'products.category_products_id', '=', 'category_products.id') 
            ->whereBetween('stock_movements.created_at', [$dateFrom, $dateTo])
            ->where('stock_movements.type', 'out')
            ->groupBy('category_products.name')
            ->orderByDesc('total_sales')
            ->get();
    }
}