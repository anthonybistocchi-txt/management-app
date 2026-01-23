<?php

namespace App\Repositories\Interfaces;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Collection;

interface ProviderRepositoryInterface
{
   public function getAllActives(): Collection;
    public function getByIds(array $ids): Collection;
    public function get(int $id): ?Provider;
    public function create(array $data): Provider;
    public function update(array $data): Provider;
    public function delete(int $id): bool;
}