<?php

namespace App\Services;

use App\Repositories\Eloquent\UserRepository;
use Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function __construct(protected UserRepository $userRepository) {}

    public function create(array $data): void
    {
        $this->userRepository->create($data);
    }

    public function delete(int $id): void
    {
        $this->userRepository->delete($id);
    }
    
    public function update(array $data): void
    {
        if(!isset($data['password']) || empty($data['password'])) {
            unset($data['password']);
        }

        $data['password'] = Hash::make($data['password']);

        $this->userRepository->update($data);
    }

    public function get(array $ids): Collection
    {
        return $this->userRepository->get($ids);
    }
    
    public function getAll(array $data): array
    {   

        $query      = $this->userRepository->getAll($data);
        $countUsers = $query->clone()->count();

        $usersPaginated = $query
            ->skip($data['start']  ?? 0)
            ->take($data['length'] ?? 10)
            ->get();

        return [
            'recordsFiltered' => $countUsers,
            'recordsTotal'    => $countUsers,
            'users'           => $usersPaginated,
        ];
           
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
