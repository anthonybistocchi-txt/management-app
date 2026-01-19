<?php

namespace App\Repositories\Eloquent;

use App\Models\Provider;
use Illuminate\Support\Collection;
class ProviderRepository
{
    public function __construct(protected Provider $model){}

    public function createProvider(array $data): Provider
    {
        return $this->model->create($data);
    }
    
    public function deleteProvider($id): bool
    {
        $provider = $this->model->findOrFail($id);

        $provider->active = 0;
        $provider->save();

        return $provider->delete();
    }

    public function updateProvider($id, array $data): bool
    {
        $provider = $this->model->findOrFail($id);

        $provider->update($data);

        return true;
    }

    public function getProvider(array $ids): Collection
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    public function getAllProviders(): Collection
    {
        return $this->model->where('active', 1)->get();
    }

}