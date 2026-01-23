<?php 

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface 
{
   public function getAll(): Collection;
    public function getByIds(array $ids): Collection;
    public function get(int $id): ?User;
    public function create(array $data): User;
    public function update(array $data): User;
    public function delete(int $id): bool;
}