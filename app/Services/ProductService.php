<?php

namespace App\Services;

use App\Models\ProductLocation;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
        protected StockService $stockService
    ) {}

    public function createProduct(array $data)
    {
        return DB::transaction(function () use ($data) {
            $product = $this->productRepository->create($data);

            if (!empty($data['quantity']) && $data['quantity'] > 0) {
                $this->stockService->in([
                    'product_id'  => $product->id,
                    'quantity'    => $data['quantity'],
                    'location_id' => $data['location_id'] ?? null,
                    'description' => $data['description'] ?? '',
                    'type'        => 'in',
                    'provider_id' => $data['provider_id'],
                ]);
            }

            return $product->load('location');
        });
    }

    public function updateProduct(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $product = $this->productRepository->update($id, $data);

            if (!empty($data['location_id'])) {
                $productLocation = ProductLocation::where('product_id', $product->id)->first();

                $productLocation->update([
                    'location_id' => $data['location_id'],
                ]);

                if (!empty($data['quantity']) && $data['quantity'] > 0) {
                    $this->stockService->in([
                        'product_id'  => $product->id,
                        'quantity'    => $data['quantity'],
                        'location_id' => $data['location_id'] ?? null,
                        'description' => $data['description'] ?? '',
                        'type'        => 'in',
                        'provider_id' => $data['provider_id'] ?? $product->provider_id,
                    ]);
                }

                return $product->load('location');
            }
        });
    }
    
    public function deleteProduct(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            return $this->productRepository->delete($id);
        });
    }

    public function getProduct(string $idsString): Collection
    {
        $ids = explode(',', $idsString);
        return $this->productRepository->findByIds($ids);
    }

    public function getAllProducts(): array
    {
        return $this->productRepository->findAll();
    }
}

