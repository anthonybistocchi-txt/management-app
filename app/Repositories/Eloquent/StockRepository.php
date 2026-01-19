<?php 

namespace App\Repositories\Eloquent;

use App\Models\Stock;
class StockRepository
{
    public function __construct(protected Stock $model){}

    public function incrementStock($productId, $locationId, $quantity): Stock
    {
        $stock = Stock::firstOrCreate(
            ['product_id' => $productId, 'location_id' => $locationId],
            ['quantity' => 0]
        );
        
        //  garante que pega o dado mais recente após o firstOrCreate
        $stock->refresh(); 
        
        $stock->quantity += $quantity;
        $stock->save();
        
        return $stock;
    }



    public function stockOut(array $data): Stock
    {
        $stock = Stock::where('product_id', $data['product_id'])
            ->where('location_id', $data['location_id'])
            ->firstOrFail();

        if ($stock->quantity < $data['quantity']) {
            throw new \Exception('Insufficient stock for the requested operation.');
        }

        $stock->quantity -= $data['quantity'];
        $stock->save();

        return $stock;
    }
    public function stockTransfer(array $data): array
    {
        $transferOutStock = $this->stockOut([
            'product_id'  => $data['product_id'],
            'location_id' => $data['from_location_id'],
            'quantity'    => $data['quantity'],
        ]);

        $transferInStock = $this->incrementStock(
            $data['product_id'],
            $data['to_location_id'],
            $data['quantity']
        );

        return [
            'from' => $transferOutStock,
            'to'   => $transferInStock,
        ];
    }
}