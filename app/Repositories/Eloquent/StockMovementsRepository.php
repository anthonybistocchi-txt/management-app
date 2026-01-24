<?php

namespace App\Repositories\Eloquent;
use App\Models\Stock;
use App\Models\StockMovements;
use App\Repositories\Interfaces\StockMovementsRepositoryInterface;

class StockMovementsRepository implements StockMovementsRepositoryInterface
{
    public function __construct(protected StockMovements $model){}
    
    public function logEntry(array $data ): StockMovements
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
                'movement_type'     => 'in',
                'quantity_moved'    => $data['quantity'],
                'description'       => $data['description'] ?? null,
                'provider_id'       => $data['provider_id'] ?? null,
                'quantity_before'   => $quantityBefore ? $quantityBefore->quantity : 0,
                'quantity_after'    => $quantityAfter,
        ]);
    }

    public function logExit(array $data): StockMovements
    {
        $quantityBefore = Stock::select('quantity')
            ->where('product_id', $data['product_id'])
            ->when(env('HAS_SUBSIDIARIES'), function ($query) use ($data) {
                $query->where('location_id', $data['location_id']);
            })
            ->first();

        $quantityAfter = $quantityBefore ? $quantityBefore->quantity - $data['quantity'] : -$data['quantity'];

        return StockMovements::create([
                'product_id'        => $data['product_id'],
                'location_id'       => $data['location_id'],
                'movement_type'     => 'out',
                'quantity_moved'    => $data['quantity'],
                'description'       => $data['description'] ?? null,
                'quantity_before'   => $quantityBefore ? $quantityBefore->quantity : 0,
                'quantity_after'    => $quantityAfter,
        ]);
    }

    public function logTransfer(array $data): StockMovements
    {
        return StockMovements::create([
                'product_id'        => $data['product_id'],
                'location_id'       => $data['to_location_id'],
                'movement_type'     => 'transfer',
                'quantity_moved'    => $data['quantity'],
                'description'       => $data['description'] ?? null,
                'quantity_before'   => $data['quantity_before']   ?? null,
                'quantity_after'    => $data['quantity_after']    ?? null,
        ]);
    }
}