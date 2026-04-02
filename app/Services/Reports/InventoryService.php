<?php

namespace App\Services\Reports;

use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class InventoryService
{
    public function getInventoryData(array $data): array
    {
        $query = Stock::select(
                'stock.id',
                'products.name as product_name',
                'product_categories.name as category_name',
                'locations.name as location_name',
                'stock.quantity',
                'products.price',
                DB::raw('stock.quantity * products.price as total_value'),
            )
            ->join('products', 'stock.product_id', '=', 'products.id')
            ->leftJoin('product_categories', 'products.product_category_id', '=', 'product_categories.id')
            ->leftJoin('locations', 'stock.location_id', '=', 'locations.id')
            ->when(($data['category_id'] ?? 'all') !== 'all', function ($q) use ($data) {
                $q->where('product_categories.id', $data['category_id']);
            })
            ->when(($data['location_id'] ?? 'all') !== 'all', function ($q) use ($data) {
                $q->where('stock.location_id', $data['location_id']);
            })
            ->orderBy('products.name')
            ->get();

        $start  = (int) ($data['start'] ?? 0);
        $length = (int) ($data['length'] ?? 10);

        $recordsTotal = $query->count();
        $pageRows     = $query->skip($start)->take($length)->values()->all();

        return [
            'recordsTotal'    => $recordsTotal,
            'recordsFiltered' => $recordsTotal,
            'data'            => $pageRows,
        ];
    }
}
