<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll(): Collection
    {
        return Product::all();
    }

    public function get(array $id): Collection
    {
        return Product::whereIn('id', $id)
            ->get();
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(array $data): Product
    {
        $id = $data['id'];
        unset($data['id']);

        $product = Product::findOrFail($id);
        $product->update($data);

        return $product->fresh();
    }

    public function delete(int $id): bool
    {
        $product = Product::findOrFail($id);

        return $product->delete();
    }

    public function search(string $query, int $limit = 15): Collection
    {
        return Product::where('name', 'like', "%{$query}%")
            ->select('id', 'name')
            ->limit($limit)
            ->get();
    }
}