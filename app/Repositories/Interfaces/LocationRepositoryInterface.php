<?php

namespace App\Repositories\Interfaces;

use App\Models\Location;
use Illuminate\Support\Collection;


interface LocationRepositoryInterface
{
    public function getAll(): Collection;
    public function get(array $id): ?Collection;
    public function create(array $data): Location;
    public function update(array $data): Location;
    public function delete(int $id): bool;
}