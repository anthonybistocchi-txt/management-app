<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserService
{
    public function createUser($request): User
    {
        $request['password'] = Hash::make($request['password']);

        $user = User::create($request);

        return $user;
    }

    public function deleteUser(int $id): bool
    {
        $user = User::findOrFail($id);

        $user->is_active = 0;
        $user->save();

        $user->delete();

        return true;
    }

    public function updateUser($id, $request): User
    {
        $user = User::findOrFail($id);


        if (isset($request['password']) && $request['password']) {
            $request['password'] = Hash::make($request['password']);
        } else {
            unset($request['password']); // remove do array
        }

        $user->update($request);

        return $user;
    }

    public function getUser(string $request): Collection
    {
        $ids = explode(',', $request);
        $users = User::whereIn('id', $ids)->get();
        return $users;
    }

    public function getAllUsers(): array
    {
        $users = User::where('active', '1')
        ->get()
        ->toArray();
        return $users;
    }
}
