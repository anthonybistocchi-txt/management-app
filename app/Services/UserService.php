<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

use function Symfony\Component\Clock\now;

class UserService
{
    public function createUser(Request $request): User
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|string|email|max:255|unique:users',
            'password'     => 'required|string|min:8',
            'type_user_id' => 'required|integer|exists:type_user,id',
            'cpf'          => 'required|string|max:14|unique:users',
        ]);

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

        $user->is_active  = 0;
        $user->deleted_at = now();

        return true;
    }

    public function updateUser($id, Request $request): User
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name'         => 'sometimes|required|string|max:255',
            'email'        => [
                'sometimes',
                'required',
                'string',
                'email',
                'max:255',
                // ignora o email do ID deste usuário
                Rule::unique('users')->ignore($user->id)
            ],
            'password'     => 'sometimes|nullable|string|min:8',
            'type_user_id' => 'sometimes|required|integer|exists:type_user,id',
            'is_active'    => ['sometimes', 'required', Rule::in(['0', '1'])],
        ]);


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
        $users = User::where('is_active', '1')
        ->get()
        ->toArray();
        return $users;
    }
}
