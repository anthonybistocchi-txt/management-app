<?php

namespace App\Repositories\Eloquent;

use App\Models\Provider;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
class ProviderRepository implements ProviderRepositoryInterface
{
    public function create(array $data): Provider
    {
        return Provider::create($data);
    }
    
    public function delete(int $id): bool
    {
        $provider = Provider::findOrFail($id);

        $provider->active = 0;
        $provider->save();

        return $provider->delete();
    }

    public function update(array $data): Provider
    {
        $provider = Provider::findOrFail($data['id']);

        $provider->update($data);

        return $provider;
    }

    public function getAll(): Collection
    {
        return Provider::where('active', 1)
            ->get();
    }

    public function get(array $id): ?Collection
    {
        return Provider::whereIn('id', $id)
            ->get();
    }

}