<?php

namespace App\Repositories\Eloquent;
use App\Models\StockMovements;
use App\Repositories\Interfaces\StockMovementsRepositoryInterface;

class StockMovementsRepository implements StockMovementsRepositoryInterface
{
    public function __construct(protected StockMovements $model){}
    
    public function logEntry(array $data,int $userId): StockMovements
    {
        return StockMovements::create([
                'product_id'        => $data['product_id'],
                'location_id'       => $data['location_id'],
                'quantity_moved'    => $data['quantity'],
                'movement_type'     => 'in',
                'description'       => $data['description'] ?? null,
                'provider_id'       => $data['provider_id'] ?? null,
                'created_by'        => $userId,
        ]);
    }

    public function logExit(array $data,int $userId): StockMovements
    {
        return StockMovements::create([
                'product_id'        => $data['product_id'],
                'location_id'       => $data['location_id'],
                'quantity_moved'    => $data['quantity'],
                'movement_type'     => 'out',
                'description'       => $data['description'] ?? null,
                'created_by'        => $userId,
        ]);
    }

    public function logTransfer(array $data,int $userId): StockMovements
    {
        return StockMovements::create([
                'product_id'        => $data['product_id'],
                'location_id'       => $data['to_location_id'],
                'quantity_moved'    => $data['quantity'],
                'movement_type'     => 'transfer',
                'description'       => $data['description'] ?? null,
                'created_by'        => $userId,
        ]);
    }
}