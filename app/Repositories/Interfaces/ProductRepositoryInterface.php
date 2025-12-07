<?php

// app/Repositories/Interfaces/ProductRepositoryInterface.php
namespace App\Repositories\Interfaces;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function create(array $data): Product;
    public function update(int $id, array $data): Product;
    public function delete(int $id): bool;
    public function find(int $id): ?Product;
    public function findByIds(array $ids): Collection;
    public function getAll(): Collection;
    // public function updateLocation(Product $product, int $locationId): void;
}