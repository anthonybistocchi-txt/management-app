<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(array $data): User|bool
    {
        $user = User::where('id', $data['id'])->first();

        if ($user) {
            return false;
        }

        $data['created_at'] = date_format(now(), 'd-m-Y H:i:s');

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

        $data['deleted_at'] = date_format(now(), 'd-m-Y H:i:s');
        $user->delete();

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

    public function getUser(int $id): User
    {
        $columns = ['id', 'name', 'email', 'cpf', 'created_at', 'updated_at'];

        $user = User::findOrFail($id, $columns);

        return $user;
    }
}
