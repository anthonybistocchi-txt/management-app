<?php 

namespace App\Repositories\Eloquent;

use App\Models\Stock;
use App\Repositories\Interfaces\StockRepositoryInterface;
class StockRepository implements StockRepositoryInterface
{
    public function __construct(protected Stock $model){}

    public function in(array $data): bool
    {

        $query = Stock::where('product_id', $data['product_id'])
            ->when($data['location_id'] ?? null, function ($query) use ($data) {
                return $query->where('location_id', $data['location_id']);
            })
            ->first();

        if ($query) {
            $query->increment('quantity', $data['quantity']);

            return true;
        }

        Stock::create([
            'product_id'  => $data['product_id'],
            'location_id' => $data['location_id'] ?? null,
            'quantity'    => $data['quantity'],
        ]); 

        return true;
    }

    public function out(array $data): bool
    {
        $query = Stock::where('product_id', $data['product_id'])
            ->when($data['location_id'] ?? null, function ($query) use ($data) {
                return $query->where('location_id', $data['location_id']);
            })
            ->firstOrFail();

        if ($query->quantity < $data['quantity']) {
            throw new \Exception('Insufficient stock for the requested operation.');
        }

        $query->quantity -= $data['quantity'];
        $query->save();

        return true;
    }

    public function transfer(array $data): bool
    {
        $this->out([
            'product_id'  => $data['product_id'],
            'location_id' => $data['location_id'],
            'quantity'    => $data['quantity'],
        ]);
        $this->in([
            'product_id'  => $data['product_id'],
            'location_id' => $data['location_id'],
            'quantity'    => $data['quantity'],
        ]);

        return true;
    }
}