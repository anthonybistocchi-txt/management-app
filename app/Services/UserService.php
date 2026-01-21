<?php

namespace App\Services;

use App\Repositories\Eloquent\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Models\User;

class UserService
{
    public function __construct(protected UserRepository $userRepository) {}

    public function createUser(array $data): User
    {
        return $this->userRepository->createUser($data);
    }

    public function deleteUser(int $id): void
    {
        $this->userRepository->deleteUser($id);
    }

    public function updateUser(int $id, array $data): User
    {
        return $this->userRepository->updateUser($id, $data);
    }

    public function getUser(array $ids): Collection
    {
        return $this->userRepository->getUser($ids);
    }

    public function getAllUsers(): Collection
    {
        return $this->userRepository->getAllUsers();
    }
}
