<?php

namespace App\Repositories\Eloquent;
use App\Models\StockMovements;

class StockMovementsReposytory
{
    protected $model;
    public function __construct(StockMovements $model)
    {
        $this->model = $model;
    }
    

    public function logEntry($stock, $quantity, $data, $userId): StockMovements
    {
        return StockMovements::create([
                'product_id'        => $stock->product_id,
                'location_id'       => $stock->location_id,
                'quantity_moved'    => $quantity,
                'movement_type'     => 'in',
                'description'       => $data['description'] ?? null,
                'provider_id'       => $data['provider_id'] ?? null,
                'created_by'        => $userId,
        ]);
    }

    public function logExit($stock, $quantity, $data, $userId): StockMovements
    {
        return StockMovements::create([
                'product_id'        => $stock->product_id,
                'location_id'       => $stock->location_id,
                'quantity_moved'    => $quantity,
                'movement_type'     => 'out',
                'description'       => $data['description'] ?? null,
                'created_by'        => $userId,
        ]);
    }

    public function logTransfer($stock, $quantity, $data, $userId): StockMovements
    {
        return StockMovements::create([
                'product_id'        => $stock->product_id,
                'location_id'       => $data['to_location_id'],
                'quantity_moved'    => $quantity,
                'movement_type'     => 'transfer',
                'description'       => $data['description'] ?? null,
                'created_by'        => $userId,
        ]);
    }
}