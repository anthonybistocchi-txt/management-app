<?php 

namespace App\Repositories\Eloquent;

use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\StockRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

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
            throw new \Exception('Insufficient stock for the requested operation.', 400);
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

    public function getStockValuationData(): Collection
    {
        return Stock::query()
            ->select(
                'products.id as id',
                'stock.id as stock_id',
                'stock.product_id',
                'stock.location_id',
                'stock.quantity',
                'products.name',
                'products.description',
                'products.price',
                'products.product_category_id',
                'product_categories.name as category_name',
                'locations.name as location_name',
            )
            ->selectSub(
                DB::table('stock_movements as sm')
                    ->select('sm.provider_id')
                    ->whereColumn('sm.product_id', 'stock.product_id')
                    ->whereColumn('sm.location_id', 'stock.location_id')
                    ->whereNotNull('sm.provider_id')
                    ->orderByDesc('sm.movement_date')
                    ->orderByDesc('sm.id')
                    ->limit(1),
                'provider_id',
            )
            ->selectSub(
                DB::table('stock_movements as sm')
                    ->join('providers as p', 'sm.provider_id', '=', 'p.id')
                    ->select('p.name')
                    ->whereColumn('sm.product_id', 'stock.product_id')
                    ->whereColumn('sm.location_id', 'stock.location_id')
                    ->whereNotNull('sm.provider_id')
                    ->orderByDesc('sm.movement_date')
                    ->orderByDesc('sm.id')
                    ->limit(1),
                'provider_name',
            )
            ->join('products', 'stock.product_id', '=', 'products.id')
            ->leftJoin('product_categories', 'products.product_category_id', '=', 'product_categories.id')
            ->leftJoin('locations', 'stock.location_id', '=', 'locations.id')
            ->orderBy('products.name')
            ->get();
    }
}