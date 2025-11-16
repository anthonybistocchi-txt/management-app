<?php

namespace App\Services;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProviderService
{
    public function createProvider($request): Provider
    {
        $provider = Provider::create($request);

        return $provider;
    }

    public function deleteProvider(array $request): bool
    {
        $provider = Provider::findOrFail($request['id']);
        $provider->delete();

        return true;
    }

    public function updateProvider($id, $request): Provider
    {
        $provider = Provider::findOrFail($id);


        $provider->update($request);

        return $provider;
    }

    public function getProvider(string $request): Collection
    {
        $ids = explode(',', $request);
        $providers = Provider::whereIn('id', $ids)->get();
        return $providers;
    }

    public function getAllProviders(): array
    {
        $providers = Provider::where('active', '1')
        ->get()
        ->toArray();

        return $providers;
    }
}
