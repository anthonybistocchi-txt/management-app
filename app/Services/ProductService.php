<?php

// app/Services/ProductService.php
namespace App\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductService
{
    // Injeção de Dependência da INTERFACE, não da classe concreta
    public function __construct(
        protected ProductRepositoryInterface $productRepository,
        protected StockService $stockService
    ) {}

    public function createProduct(array $data)
    {
        return DB::transaction(function () use ($data) {
            // 1. Cria o produto via repositório
            $product = $this->productRepository->create($data);

            // 2. Regra de Negócio: Se tem quantidade inicial, move estoque
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
            $product = $this->productRepository->find($id);

            if (!$product) {
                throw new ModelNotFoundException("Product not found");
            }

            // Atualiza dados básicos
            $this->productRepository->update($id, $data);

            // Atualiza Localização (delegado ao repository)
            if (!empty($data['location_id'])) {
                $this->productRepository->updateLocation($product, $data['location_id']);
            }

            // Regra de Estoque
            if (!empty($data['quantity']) && $data['quantity'] > 0) {
                $this->stockService->in([
                    'product_id'  => $product->id,
                    'quantity'    => $data['quantity'],
                    'location_id' => $data['location_id'] ?? null,
                    'description' => $data['description'] ?? 'Update adjustment',
                    'type'        => 'in',
                    'provider_id' => $data['provider_id'] ?? $product->provider_id,
                ]);
            }

            return $product->refresh()->load('location');
        });
    }

    public function deleteProduct(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            $deleted = $this->productRepository->delete($id);
            
            if (!$deleted) {
                throw new ModelNotFoundException("Product not found");
            }
            return true;
        });
    }

    public function getProduct(string $ids)
    {
        $idArray = explode(',', $ids);
        return $this->productRepository->findByIds($idArray);
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAll();
    }
}