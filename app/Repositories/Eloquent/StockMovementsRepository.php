<?php

namespace App\Repositories\Eloquent;
use App\Models\Stock;
use App\Models\StockMovements;
use App\Repositories\Interfaces\StockMovementsRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class StockMovementsRepository implements StockMovementsRepositoryInterface
{
    public function __construct(protected StockMovements $model){}
    
    public function logEntry(array $data): StockMovements
    {
   
        $quantityBefore = Stock::select('quantity')
            ->where('product_id', $data['product_id'])
            ->when(env('HAS_SUBSIDIARIES') == true, function ($query) use ($data) {
                $query->where('location_id', $data['location_id']);
            })
            ->first();

        $quantityAfter = $quantityBefore  ? $quantityBefore->quantity + $data['quantity'] : $data['quantity'];

        return StockMovements::create([
                'product_id'        => $data['product_id'],
                'location_id'       => $data['location_id'],
                'type'              => 'in',
                'quantity_moved'    => $data['quantity'],
                'description'       => $data['description'] ?? null,
                'provider_id'       => $data['provider_id'] ?? null,
                'movement_date'     => $data['movement_date'],
                'quantity_before'   => $quantityBefore ? $quantityBefore->quantity : 0,
                'quantity_after'    => $quantityAfter,
        ]);
    }

    public function logExit(array $data): StockMovements
    {
        $quantityBefore = Stock::select('quantity')
            ->where('product_id', $data['product_id'])
            ->when(env('HAS_SUBSIDIARIES') == true, function ($query) use ($data) {
                $query->where('location_id', $data['location_id']);
            })
            ->first();
       
        $quantityAfter = $quantityBefore ? $quantityBefore->quantity - $data['quantity'] : -$data['quantity'];
        
        return StockMovements::create([
                'product_id'        => $data['product_id'],
                'location_id'       => $data['location_id'],
                'type'              => 'out',
                'quantity_moved'    => $data['quantity'],
                'description'       => $data['description'] ?? null,
                'movement_date'     => $data['movement_date'],
                'quantity_before'   => $quantityBefore ? $quantityBefore->quantity : 0,
                'quantity_after'    => $quantityAfter,
        ]);
    }

    public function logTransfer(array $data): StockMovements
    {
        return StockMovements::create([
                'product_id'        => $data['product_id'],
                'location_id'       => $data['to_location_id'],
                'type'              => 'transfer',
                'quantity_moved'    => $data['quantity'],
                'description'       => $data['description'] ?? null,
                'movement_date'     => $data['movement_date'],
                'quantity_before'   => $data['quantity_before']   ?? null,
                'quantity_after'    => $data['quantity_after']    ?? null,
        ]);
    }

    public function getInOutReportData(array $data): Collection
    {
        return StockMovements::select(
                'stock_movements.id',
                'stock_movements.product_id', 
                'stock_movements.location_id', 
                'stock_movements.type', 
                'stock_movements.quantity_moved', 
                'products.name as product_name',
                'locations.name as location_name',
                'providers.name as provider_name',
                'product_categories.name as category_name',
                'stock_movements.description', 
                'stock_movements.movement_date', 
                'stock_movements.quantity_before', 
                'stock_movements.quantity_after', 
                'stock_movements.provider_id'
            )
            ->join('products', 'stock_movements.product_id', '=', 'products.id')
            ->join('locations', 'stock_movements.location_id', '=', 'locations.id')
            ->join('providers', 'stock_movements.provider_id', '=', 'providers.id')
            ->join('product_categories', 'products.product_category_id', '=', 'product_categories.id')
            ->when($data['type'] !== null, function ($query) use ($data) {
                $query->where('type', $data['type']);
            })
            ->when($data['product_id'] !== null, function ($query) use ($data) {
                $query->where('product_id', $data['product_id']);
            })
            ->when($data['location_id'] !== null, function ($query) use ($data) {
                $query->where('location_id', $data['location_id']);
            })
            ->when($data['movement_date'] !== null, function ($query) use ($data) {
                $query->whereBetween('movement_date', [$data['from'], $data['to']]);
            })
            ->when($data['provider_id'] !== null, function ($query) use ($data) {
                $query->where('provider_id', $data['provider_id']);
            })
            ->when($data['category_id'] !== null, function ($query) use ($data) {
                $query->where('product_categories.id', $data['category_id']);
            })
            ->get();
    }
}