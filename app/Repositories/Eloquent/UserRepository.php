<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserRepository implements UserRepositoryInterface
{
    public function getByIds(array $id): Collection
    {
        return User::whereIn('id', $id)
            ->where('active', 1)
            ->get();
    }

    public function getById(int $id): ?User
    {
        return User::find($id);
    }

    public function getAll(array $data): Builder
    {
        return User::query()
        ->when($data['operator_type'] !== 'all', function($query) use ($data) {
            $query->where('type_user_id', $data['operator_type']);
        })
        ->when($data['active'] !== 'all', function($query) use ($data) {
            $query->where('active', $data['active']);
        })
        ->when(!empty($data['search']), function($query) use ($data) {
            $searchTerm = $data['search'];
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('email', 'LIKE', "%{$searchTerm}%");
            });
        });
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