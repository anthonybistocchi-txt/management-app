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

    public function get(int $id): Product|null
    {
        return Product::find($id);
    }

    public function getByIds(array $ids): Collection
    {
        return Product::whereIn('id', $ids)->get();
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(array $data): Product
    {
        $product = $this->get($data['id']);
        $product->update($data);
            
        return $product;
    }

    public function delete(int $id): bool
    {
        $product = $this->get($id);

        return $product->delete();
        
    }
}