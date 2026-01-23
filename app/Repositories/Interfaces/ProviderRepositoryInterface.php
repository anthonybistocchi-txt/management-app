<?php

namespace App\Repositories\Interfaces;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Collection;

interface ProviderRepositoryInterface
{
    public function getAll(): Collection;
    public function get(array $id): ?Collection;
    public function create(array $data): Provider;
    public function update(array $data): Provider;
    public function delete(int $id): bool;
}