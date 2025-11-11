<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductLocation;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function __construct(protected StockService $stockService) {}

    public function createProduct(Request $request)
    {
        $validatedProduct = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|integer|min:0',
            'provider_id' => 'required|exists:providers,id',
            'quantity'    => 'nullable|integer|min:0',
            'location_id' => 'nullable|exists:product_locations,id',
            'address'     => 'nullable|string|max:255',
            'city'        => 'nullable|string|max:255',
            'state'       => 'nullable|string|max:255',
            'cep'         => 'nullable|string|max:20',
        ]);

        return DB::transaction(function () use ($validatedProduct) {
            $product = Product::create($validatedProduct);

            if (!empty($validatedProduct['address'])) {
                ProductLocation::create([
                    'product_id' => $product->id,
                    'address'    => $validatedProduct['address'],
                    'city'       => $validatedProduct['city'],
                    'state'      => $validatedProduct['state'],
                    'cep'        => $validatedProduct['cep'],
                ]);
            }

            if (!empty($validatedProduct['quantity']) && $validatedProduct['quantity'] > 0) {
                $this->stockService->in( [
                    'product_id'  => $product->id,
                    'quantity'    => $validatedProduct['quantity'],
                    'location_id' => $validatedProduct['location_id'] ?? null,
                    'description' => $validatedProduct['description'] ?? '',
                    'type'        => 'in',
                    'provider_id' => $validatedProduct['provider_id'],
                ]);
            }

            return $product->load('location');
        });
    }

    public function updateProduct($id, Request $request)
    {
        $validatedData = $request->validate([
            'name'        => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price'       => 'sometimes|integer|min:0',
            'provider_id' => 'sometimes|exists:providers,id',
            'quantity'    => 'nullable|integer|min:0',
            'location_id' => 'nullable|exists:product_locations,id',
            'address'     => 'nullable|string|max:255',
            'city'        => 'nullable|string|max:255',
            'state'       => 'nullable|string|max:255',
            'cep'         => 'nullable|string|max:20',
        ]);

        return DB::transaction(function () use ($id, $validatedData) {
            $product = Product::findOrFail($id);
            $product->update($validatedData);

            if (!empty($validatedData['address'])) {
                $productLocation = ProductLocation::where('product_id', $product->id)->first();

                if ($productLocation) {
                    $productLocation->update([
                        'address' => $validatedData['address'],
                        'city'    => $validatedData['city'],
                        'state'   => $validatedData['state'],
                        'cep'     => $validatedData['cep'],
                    ]);
                } else {
                    ProductLocation::create([
                        'product_id' => $product->id,
                        'address'    => $validatedData['address'],
                        'city'       => $validatedData['city'],
                        'state'      => $validatedData['state'],
                        'cep'        => $validatedData['cep'],
                    ]);
                }
            }

            if (!empty($validatedData['quantity']) && $validatedData['quantity'] > 0) {
                $this->stockService->in( [
                    'product_id'  => $product->id,
                    'quantity'    => $validatedData['quantity'],
                    'location_id' => $validatedData['location_id'] ?? null,
                    'description' => $validatedData['description'] ?? '',
                    'type'        => 'in',
                    'provider_id' => $validatedData['provider_id'] ?? $product->provider_id,
                ]);
            }

            return $product->load('location');
        });
    }

    public function deleteProduct($id): bool
    {
        return DB::transaction(function () use ($id) {
            $product = Product::findOrFail($id);
            $product->location()->delete();
            $product->stock()->delete();
            $product->delete();

            return true;
        });
    }

    public function getProduct(string $data): Collection
    {
        return Product::whereIn('id', explode(',', $data))->get();
    }

    public function getAllProducts(): array
    {
        return Product::all()->toArray();
    }
}
