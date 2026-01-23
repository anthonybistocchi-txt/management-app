<?php 

namespace App\Repositories\Interfaces;

interface StockRepositoryInterface 
{
    public function stockIn(array $data,int $userId): bool;
    public function stockOut(array $data,int $userId): bool;
    public function stockTransfer(array $data,int $userId): bool;
}