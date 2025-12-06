<?php

namespace App\Repositories\Contracts;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Collection;

interface ProviderRepositoryInterface
{
    public function create(array $data): Provider;
    
    public function update(int $id, array $data): Provider;
    
    public function delete(int $id): bool;
    
    public function findById(int $id): ?Provider;
    
    public function findByIds(array $ids): Collection;
    
    public function findAll(): array;
}
