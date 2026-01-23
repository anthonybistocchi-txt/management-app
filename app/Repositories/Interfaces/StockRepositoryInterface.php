<?php 

namespace App\Repositories\Interfaces;

interface StockRepositoryInterface 
{
    public function in(array $data): bool;
    public function out(array $data): bool;
    public function transfer(array $data): bool;
}