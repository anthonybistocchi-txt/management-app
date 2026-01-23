<?php

namespace App\Repositories\Interfaces;

use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;

interface LocationRepositoryInterface
{
    public function getAll(): Collection;
    public function getByIds(array $ids): Collection;
    public function get(int $id): ?Location;
    public function create(array $data): Location;
    public function update(array $data): Location;
    public function delete(int $id): bool;
}