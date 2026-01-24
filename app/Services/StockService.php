<?php

namespace App\Services;

use App\Repositories\Eloquent\ProductRepository;
use Illuminate\Support\Facades\DB;
use App\Repositories\Eloquent\StockRepository;
use App\Repositories\Eloquent\StockMovementsRepository;

class StockService
{
    public function __construct(
        protected StockRepository          $stockRepository,
        protected StockMovementsRepository $stockMovementsRepository,
    ) {}

    public function input(array $data)
    {
        $data['locations_id'] = env('HAS_SUBSIDIARIES') ? $data['location_id'] : $data['location_id'] == null;
        return DB::transaction(function () use ($data) {
            $this->stockMovementsRepository->logEntry(
                $data, 
            );

            $this->stockRepository->in(
                $data,
            );

            return;
        });
    }

            
    public function out(array $data)
    {
        return DB::transaction(function () use ($data) {
            
            $this->stockMovementsRepository->logExit(
                $data, 
                
            );
                
            $this->stockRepository->out(
                    $data
            );

            return;
        });
    }

    public function transfer(array $data)
    {
        return DB::transaction(function () use ($data) {
            $stock = $this->stockRepository->transfer($data);

            $this->stockMovementsRepository->logTransfer(
                $data, 
            );

            return $stock;
        });
    }
}
