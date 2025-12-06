<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(int $id, array $data): User
    {
        $user = User::findOrFail($id);
        $user->update($data);
        
        return $user;
    }

    public function delete(int $id): bool
    {
        $user = User::findOrFail($id);
        $user->is_active = 0;
        $user->save();
        $user->delete();
        
        return true;
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function findByIds(array $ids): Collection
    {
        return User::whereIn('id', $ids)->get();
    }

    public function findAllActive(): array
    {
        return User::where('active', '1')->get()->toArray();
    }
}
