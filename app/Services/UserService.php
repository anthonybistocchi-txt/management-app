<?php

namespace App\Services;

use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function __construct(protected UserRepository $userRepository) {}

    public function createUser(array $data): void
    {
        $this->userRepository->createUser($data);
    }

    public function deleteUser(int $id): void
    {
        $this->userRepository->deleteUser($id);
    }
    
    public function updateUser(int $id, array $data): void
    {
        $this->userRepository->updateUser($id, $data);
    }

    public function getUsers(array $ids): array
    {
        return $this->userRepository->getUsers($ids)->toArray();
    }

    public function getAllUsers(): array
    {
        return $this->userRepository->getAllUsers()->toArray();
    }

    public function getUserLogged(): array 
    {
        $user = Auth::user();

        return [
            'username'      => $user->username,
            'type_user_id'  => $user->type_user_id,
        ];
    }
}
