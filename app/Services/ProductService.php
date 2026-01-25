<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Eloquent\ProductRepository;
use Illuminate\Support\Collection;

class ProductService
{
    public function __construct(protected ProductRepository $productRepository){}

    public function create(array $data): Product
    {
        return $this->productRepository->create($data);
    }

    public function getAll(): Collection
    {
        return $this->productRepository->getAll();
    }

    public function get(array $id): Collection
    {
        return $this->productRepository->get($id);
    }
    
    public function update(array $data): Product
    {
        return $this->productRepository->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->productRepository->delete($id);
    }
}