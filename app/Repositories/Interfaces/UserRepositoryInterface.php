<?php 

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface UserRepositoryInterface 
{
    public function getAll(array $data): Builder;
    public function getByIds(array $id): ?Collection;
    public function getById(int $id): ?User;
    public function create(array $data): User;
    public function update(array $data): User;
    public function delete(int $id): bool;
}