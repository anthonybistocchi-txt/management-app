<?php

namespace App\Services;

use App\Models\Stock;
use App\Models\StockMovements;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\Eloquent\StockRepository;
use App\Repositories\Eloquent\StockMovementsReposytory;

class StockService
{
    public function __construct(
        protected StockRepository $stockRepository,
        protected StockMovementsReposytory $stockMovementsRepository
    ) {}

    public function inputStock(array $data)
    {
        return DB::transaction(function () use ($data) {
            $stock = $this->stockRepository->incrementStock(
                $data['product_id'], 
                $data['location_id'], 
                $data['quantity']
            );

            $this->stockMovementsRepository->logEntry(
                $stock, 
                $data['quantity'], 
                $data, 
                Auth::id()
            );

            return $stock;
        });
    }

            
    public function outStock(array $data)
    {
        return DB::transaction(function () use ($data) {
            $stock = $this->stockRepository->stockOut($data);

            $this->stockMovementsRepository->logExit(
                $stock, 
                $data['quantity'], 
                $data, 
                Auth::id()
            );

            return $stock;
        });
    }

    public function transferStock(array $data)
    {
        return DB::transaction(function () use ($data) {
            $stock = $this->stockRepository->stockTransfer($data);

            $this->stockMovementsRepository->logTransfer(
                $stock, 
                $data['quantity'], 
                $data, 
                Auth::id()
            );

            return $stock;
        });
    }
}
