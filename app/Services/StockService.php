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

    public function input(array $data)
    {
        return DB::transaction(function () use ($data) {
            $insertStock = $this->stockRepository->in(
                $data
            );

            $this->stockMovementsRepository->logEntry(
                $data, 
                Auth::id()
            );

            return $insertStock;
        });
    }

            
    public function out(array $data)
    {
        return DB::transaction(function () use ($data) {
            $stock = $this->stockRepository->out($data);

            $this->stockMovementsRepository->logExit(
                $data, 
                Auth::id()
            );

            return $stock;
        });
    }

    public function transfer(array $data)
    {
        return DB::transaction(function () use ($data) {
            $stock = $this->stockRepository->transfer($data);

            $this->stockMovementsRepository->logTransfer(
                $data, 
                Auth::id()
            );

            return $stock;
        });
    }
}
