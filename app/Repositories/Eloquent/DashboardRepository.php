<?php 

namespace App\Repositories\Eloquent;

use App\Models\StockMovements;
use Illuminate\Support\Facades\DB;

class DashboardRepository 
{
    public function getDashboardData($dateFrom, $dateTo): array
    {
        return [
            'product_top_sale' => $this->getProductTopSale($dateFrom, $dateTo),
            'moviments_sales'  => $this->getMovimentsSales($dateFrom, $dateTo),
            'total_sales'      => $this->getTotalSales($dateFrom, $dateTo),
        ];
    }


private function getProductTopSale($dateFrom, $dateTo)
{
    // TROCAMOS: StockMovements::join POR DB::table('stock_movements')->join
    // Isso evita que o Laravel tente criar Models e estoure a memória.
    
    return DB::table('stock_movements')
        ->join('products', 'stock_movements.product_id', '=', 'products.id') // O '=' é obrigatório!
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
        // Retorna a soma (int/float) ou 0 se não houver nada
        return DB::table('stock_movements')
        ->join('products', 'stock_movements.product_id', '=', 'products.id') 
        ->select('products.name',
            'stock_movements.quantity_moved',
            'stock_movements.created_at')
        ->whereBetween('stock_movements.created_at', [$dateFrom, $dateTo])
        ->where('stock_movements.type', '=', 'out')
        ->orderBy('stock_movements.created_at', 'asc')
        ->get()
        ->toArray();
        
    }

    private function getTotalSales($dateFrom, $dateTo)
    {
        // Retorna a soma (int/float) ou 0 se não houver nada
        return DB::table('stock_movements')
        ->whereBetween('created_at', [$dateFrom, $dateTo])
        ->where('type', '=', 'out')
        ->sum('quantity_moved');
    }
}