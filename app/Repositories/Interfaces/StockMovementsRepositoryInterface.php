<?php 
namespace App\Repositories\Interfaces;

interface StockMovementsRepositoryInterface
{
    public function logEntry(array $data,int $userId);
    public function logExit(array $data,int $userId);
    public function logTransfer(array $data,int $userId);
}