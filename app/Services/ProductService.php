<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProductService
{
    public function createProduct(Request $request): Product
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',
            'price'          => 'required|integer|min:0',
            'provider_id'    => 'required|exists:providers,id',
        ]);

        $product = Product::create($data);

        return $product;
    }

    public function deleteProduct($id): bool
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return true;
    }

    public function updateProduct($id, Request $request): Product
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name'           => 'sometimes|string|max:255',
            'description'    => 'sometimes|string',
            'price'          => 'sometimes|integer|min:0',
            'stock_quantity' => 'sometimes|integer|min:0',
            'provider_id'    => 'sometimes|exists:products,id',
            'updated_by'     => 'required|exists:users,id',
        ]);

        $product->update($data);

        return $product;
    }

    public function getProduct(string $data): Collection
    {
        $ids = explode(',', $data);
        $product = Product::whereIn('id', $ids)->get();
        return $product;
    }

    public function getAllProducts(): array
    {
        $products = Product::all();
        return $products->toArray();    
    }
}
