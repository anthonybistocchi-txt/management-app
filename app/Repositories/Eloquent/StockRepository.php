<?php 

namespace App\Repositories\Eloquent;

use App\Models\Stock;
use App\Repositories\Interfaces\StockRepositoryInterface;
class StockRepository implements StockRepositoryInterface
{
    public function __construct(protected Stock $model){}

    public function in(array $data): bool
    {
        $stock = Stock::firstOrCreate(
            ['product_id' => $data['product_id'], 'location_id' => $data['location_id']],
            ['quantity' => 0]
        );
        
        //  garante que pega o dado mais recente após o firstOrCreate
        $stock->refresh(); 
        
        $stock->quantity += $data['quantity'];
        $stock->save();
        
        return true;
    }

    public function out(array $data): bool
    {
        $stock = Stock::where('product_id', $data['product_id'])
            ->where('location_id', $data['location_id'])
            ->firstOrFail();

        if ($stock->quantity < $data['quantity']) {
            throw new \Exception('Insufficient stock for the requested operation.');
        }

        $stock->quantity -= $data['quantity'];
        $stock->save();

        return true;
    }

    public function transfer(array $data): bool
    {
        $this->out([
            'product_id'  => $data['product_id'],
            'location_id' => $data['from_location_id'],
            'quantity'    => $data['quantity'],
        ]);
        $this->in([
            'product_id'  => $data['product_id'],
            'location_id' => $data['to_location_id'],
            'quantity'    => $data['quantity'],
        ]);

        return true;
    }
}