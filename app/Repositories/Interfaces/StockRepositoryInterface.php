<?php 

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface StockRepositoryInterface 
{
    public function in(array $data): bool;
    public function out(array $data): bool;
    public function transfer(array $data): bool;
    public function getStockValuationData(): Collection;
}