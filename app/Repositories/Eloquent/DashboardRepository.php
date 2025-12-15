<?php 

namespace App\Repositories\Eloquent;

use Auth;
use Illuminate\Support\Facades\DB;

class DashboardRepository 
{
    public function getDashboardData($dateFrom, $dateTo): array
    {
        return [
            'product_top_sale' => $this->getProductTopSale($dateFrom, $dateTo),
            'moviments_sales'  => $this->getMovimentsSales($dateFrom, $dateTo),
            'total_sales'      => $this->getTotalSales($dateFrom, $dateTo),
            'sales_categorys'  => $this->getSalesCategorys($dateFrom, $dateTo),
            'user_logged'      => $this->getUser(),
        ];
    }

    private function getProductTopSale($dateFrom, $dateTo)
    {
        return DB::table('stock_movements')
            ->join('products', 'stock_movements.product_id', '=', 'products.id') 
            ->select(
                'products.id', 
                'products.name', 
                DB::raw('SUM(stock_movements.quantity_moved) as total_sold')
            )
            ->where('stock_movements.type', 'out') 
            ->whereBetween('stock_movements.created_at', [$dateFrom, $dateTo])
            ->groupBy('products.id', 'products.name') 
            ->orderByDesc('total_sold')
            ->first();
    }

    private function getMovimentsSales($dateFrom, $dateTo)
    {
        return DB::table('stock_movements')
        ->join('products', 'stock_movements.product_id', '=', 'products.id') 
        ->select('products.name',
            'stock_movements.quantity_moved',
            'stock_movements.created_at')
        ->whereBetween('stock_movements.created_at', [$dateFrom, $dateTo])
        ->where('stock_movements.type', '=', 'out')
        ->orderBy('stock_movements.created_at', 'asc')
        ->get();
    }

    private function getTotalSales($dateFrom, $dateTo)
    {
        return DB::table('stock_movements')
        ->join('products', 'stock_movements.product_id', '=', 'products.id') 
        ->whereBetween('stock_movements.created_at', [$dateFrom, $dateTo])
        ->where('stock_movements.type', '=', 'out')
        ->sum(DB::raw('products.price * stock_movements.quantity_moved'));
    }

    private function getSalesCategorys($dateFrom, $dateTo)
    {
        return DB::table('stock_movements')
        ->join('products', 'stock_movements.product_id', '=', 'products.id') 
        ->join('category_products', 'products.category_products_id', '=', 'category_products.id') 
        ->select(
            'category_products.name as category_name',
            DB::raw('SUM(stock_movements.quantity_moved) as total_quantity'),
            DB::raw('SUM(products.price * stock_movements.quantity_moved) as total_sales')
        )
        ->whereBetween('stock_movements.created_at', [$dateFrom, $dateTo])
        ->where('stock_movements.type', '=', 'out')
        ->groupBy('category_products.name')
        ->orderByDesc('total_sales')
        ->get();
    }

    private function getUser(): array 
    {
        $user     = Auth::user();

        return [
            'username'      => $user->username,
            'type_user_id'  => $user->type_user_id,
        ];
    }
}