<?php
namespace App\Repositories\Interfaces;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function getAll(): Collection;
    public function get(array $id): ?Collection;
    public function create(array $data): Product;
    public function update(array $data): Product;
    public function delete(int $id): bool;
}