<?php 

namespace App\Http\Requests\Stock;

interface StockRepositoryInterface 
{
    public function stockIn(array $data);
    public function stockOut(array $data);
    public function stockTransfer(array $data);
}