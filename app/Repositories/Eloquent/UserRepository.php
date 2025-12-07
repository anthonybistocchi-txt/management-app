<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class UserRepository
{
    public function getUser(array $ids)
    {
        return User::whereIn('id', $ids)->get();
    }

    public function getAllUsers()
    {
        return User::where('active', 1)->get();
       
    }

    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $data['created_by'] = Auth::id(); 

        return User::create($data);
    }

    public function updateUser(int $id, array $data): User
    {
        $user = User::findOrFail($id);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $data['updated_by'] = Auth::id();
        
        $user->update($data);
        
        return $user->refresh(); 
    }

    public function deleteUser($id): bool
    {
        $user = User::findOrFail($id);

        $user->deleted_by = Auth::id();
        $user->active = 0;
        $user->save();
        $user->delete();

        return $user->delete();
    }

}