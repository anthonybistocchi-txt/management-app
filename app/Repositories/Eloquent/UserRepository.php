<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserRepository implements UserRepositoryInterface
{
    public function get(array $id): Collection
    {
        return User::whereIn('id', $id)
            ->where('active', 1)
            ->get();
    }

    public function getAll(): Collection
    {
        return User::where('active', 1)
            ->get();
    }

    public function create(array $data): User
    {
        $data['password']   = Hash::make($data['password']);
        $data['created_by'] = Auth::id(); 

        return User::create($data);
    }

    public function update(array $data): User
    {
        $user = User::findOrFail($data['id']);
        
        $data['updated_by'] = Auth::id();
        
        $user->update($data);
        
        return $user->refresh(); 
    }

    public function delete(int $id): bool
    {
        $user = User::findOrFail($id);

        $user->deleted_by = Auth::id();
        $user->active = 0;
        $user->save();

        return $user->delete();
    }

}