<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Eloquent\ProductRepository;
use Illuminate\Support\Collection;

class ProductService
{
    public function __construct(protected ProductRepository $productRepository){}

    public function createProduct(array $data): Product
    {
        return $this->productRepository->create($data);
    }

    public function getAllProducts(): Collection
    {
        return $this->productRepository->getAll();
    }

    public function getProduct($id): Collection|Product|null
    {
        return $this->productRepository->find($id);
    }
    
    public function updateProduct($id, array $data): bool
    {
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct($id): bool|null
    {
        return $this->productRepository->delete($id);
    }

    public function getProductsByIds(array $ids)
    {
        return $this->productRepository->findByIds($ids);
    }
}