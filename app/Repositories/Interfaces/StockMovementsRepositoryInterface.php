<?php 
namespace App\Repositories\Interfaces;

interface StockMovementsRepositoryInterface
{
    public function logEntry(array $data);
    public function logExit(array $data);
    public function logTransfer(array $data);
}