<?php

namespace App\Repositories\Contracts;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function create(array $data): Product;
    
    public function update(int $id, array $data): Product;
    
    public function delete(int $id): bool;
    
    public function findById(int $id): ?Product;
    
    public function findByIds(array $ids): Collection;
    
    public function findAll(): array;
}
