<?php

namespace App\Repositories\Eloquent;

use App\Models\Provider;
use Illuminate\Support\Collection;

class ProviderRepository
{
    protected $model;

    public function __construct(Provider $model)
    {
        $this->model = $model;
    }


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

    public function updateProvider($id, array $data): Collection|Provider
    {
        $provider = $this->model->findOrFail($id);

        $provider->update($data);

        return $provider;
    }

    public function getProvider(array $ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    public function getAllProviders(): Collection
    {
        return $this->model->where('active', 1)->get();
    }

}