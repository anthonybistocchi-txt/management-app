<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Repositories\Eloquent\StockRepository;
use App\Repositories\Eloquent\StockMovementsRepository;

class StockService
{
    public function __construct(
        protected StockRepository $stockRepository,
        protected StockMovementsRepository $stockMovementsRepository
    ) {}

    public function inputStock(array $data)
    {
        return DB::transaction(function () use ($data) {
            $insertStock = $this->stockRepository->incrementStock(
                $data
            );

            $this->stockMovementsRepository->logEntry(
                $data, 
                Auth::id()
            );

            return $insertStock;
        });
    }

            
    public function outStock(array $data)
    {
        return DB::transaction(function () use ($data) {
            $stock = $this->stockRepository->stockOut($data);

            $this->stockMovementsRepository->logExit(
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
                $data, 
                Auth::id()
            );

            return $stock;
        });
    }
}
