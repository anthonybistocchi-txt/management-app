<?php

namespace App\Repositories\Eloquent;

use App\Models\Provider;
use App\Repositories\Contracts\ProviderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProviderRepository implements ProviderRepositoryInterface
{
    public function create(array $data): Provider
    {
        return Provider::create($data);
    }

    public function update(int $id, array $data): Provider
    {
        $provider = Provider::findOrFail($id);
        $provider->update($data);
        
        return $provider;
    }

    public function delete(int $id): bool
    {
        $provider = Provider::findOrFail($id);
        $provider->is_active = 0;
        $provider->save();
        $provider->delete();
        
        return true;
    }

    public function findById(int $id): ?Provider
    {
        return Provider::find($id);
    }

    public function findByIds(array $ids): Collection
    {
        return Provider::whereIn('id', $ids)->get();
    }

    public function findAll(): array
    {
        return Provider::where('active', '1')->get()->toArray();
    }
}
