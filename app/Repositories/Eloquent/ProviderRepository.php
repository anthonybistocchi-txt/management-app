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

    public function getByIds(array $ids): Collection
    {
        return Provider::whereIn('id', $ids)->get();
    }

    public function getAllActives(): Collection
    {
        return Provider::where('active', 1)->get();
    }

    public function get(int $id): ?Provider
    {
        return Provider::find($id);
    }

}