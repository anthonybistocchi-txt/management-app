<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(int $id, array $data): Product
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        
        return $product;
    }

    public function delete(int $id): bool
    {
        $product = Product::findOrFail($id);
        $product->location()->delete();
        $product->stock()->delete();
        $product->delete();
        
        return true;
    }

    public function findById(int $id): ?Product
    {
        return Product::find($id);
    }

    public function findByIds(array $ids): Collection
    {
        return Product::whereIn('id', $ids)->get();
    }

    public function findAll(): array
    {
        return Product::all()->toArray();
    }
}
