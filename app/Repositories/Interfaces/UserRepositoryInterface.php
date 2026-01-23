<?php 

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Support\Collection;

interface UserRepositoryInterface 
{
   public function getAll(): Collection;
    public function get(array $id): ?Collection;
    public function create(array $data): User;
    public function update(array $data): User;
    public function delete(int $id): bool;
}