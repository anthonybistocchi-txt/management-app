<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data): User
    {
        $user = User::findOrFail($data['id']);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return $user;
    }

    public function deleteUser(array $data): bool
    {
        $user = User::findOrFail($data['id']);

        if (!$user) {
            return false;
        }

        $user->is_active = 0;

        return true;
    }

    public function updateUser(int $id, array $data): User
    {
        $user = User::findOrFail($id);

        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // remove do array
        }

        $user->update($data);

        return $user;
    }

    public function getUser(string $data): Collection
    {
        $ids = explode(',', $data);
        $users = User::whereIn('id', $ids)->get();
    
        return $users;
    }

    public function getAllUsers(): array
    {
        $users = User::get()->toArray();
        return $users;
    }
}
