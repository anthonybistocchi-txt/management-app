<?php 

namespace App\Repositories\Eloquent;

use App\Models\Stock;
use App\Models\StockMovements;
use Auth;

class StockRepository
{
    protected $model;
    public function __construct(Stock $model)
    {
        $this->model = $model;
    }

    public function incrementStock($productId, $locationId, $quantity): Stock
    {
        // Busca ou cria
        $stock = Stock::firstOrCreate(
            ['product_id' => $productId, 'location_id' => $locationId],
            ['quantity' => 0]
        );
        
        // Dica: refresh() garante que pegamos o dado mais recente após o firstOrCreate
        $stock->refresh(); 
        
        $stock->quantity += $quantity;
        $stock->save();
        
        return $stock;
    }



    public function stockOut(array $data)
    {
        //
    }
    // public function stockTransfer(array $data)
    // {
    //     //
    // }
}