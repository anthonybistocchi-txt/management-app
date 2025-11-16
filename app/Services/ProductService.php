<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductLocation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function __construct(protected StockService $stockService) {}

    public function createProduct($request)
    {

        return DB::transaction(function () use ($request) {
            $product = Product::create($request);

            if (!empty($request['address'])) {
                ProductLocation::create([
                    'product_id' => $product->id,
                    'address'    => $request['address'],
                    'city'       => $request['city'],
                    'state'      => $request['state'],
                    'cep'        => $request['cep'],
                ]);
            }

            if (!empty($request['quantity']) && $request['quantity'] > 0) {
                $this->stockService->in( [
                    'product_id'  => $product->id,
                    'quantity'    => $request['quantity'],
                    'location_id' => $request['location_id'] ?? null,
                    'description' => $request['description'] ?? '',
                    'type'        => 'in',
                    'provider_id' => $request['provider_id'],
                ]);
            }

            return $product->load('location');
        });
    }

    public function updateProduct($id, $request)
    {

        return DB::transaction(function () use ($id, $request) {
            $product = Product::findOrFail($id);
            $product->update($request);

            if (!empty($request['address'])) {
                $productLocation = ProductLocation::where('product_id', $product->id)->first();

                if ($productLocation) {
                    $productLocation->update([
                        'address' => $request['address'],
                        'city'    => $request['city'],
                        'state'   => $request['state'],
                        'cep'     => $request['cep'],
                    ]);
                } else {
                    ProductLocation::create([
                        'product_id' => $product->id,
                        'address'    => $request['address'],
                        'city'       => $request['city'],
                        'state'      => $request['state'],
                        'cep'        => $request['cep'],
                    ]);
                }
            }

            if (!empty($request['quantity']) && $request['quantity'] > 0) {
                $this->stockService->in( [
                    'product_id'  => $product->id,
                    'quantity'    => $request['quantity'],
                    'location_id' => $request['location_id'] ?? null,
                    'description' => $request['description'] ?? '',
                    'type'        => 'in',
                    'provider_id' => $request['provider_id'] ?? $product->provider_id,
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
