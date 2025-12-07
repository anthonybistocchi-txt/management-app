<?php

namespace App\Services;

use App\Models\Provider;
use App\Repositories\Eloquent\ProviderRepository;
use Illuminate\Database\Eloquent\Collection;

class ProviderService
{

    protected $providerRepository;

    public function __construct(ProviderRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    
    public function createProvider($data): Provider
    {
        return $this->providerRepository->createProvider($data);
    }

    public function deleteProvider(int $id): bool
    {
        return $this->providerRepository->deleteProvider($id);
    }

    public function updateProvider($id, $data): Provider
    {
        return $this->providerRepository->updateProvider($id, $data);
    }

    public function getProvider(array $data): Collection
    {
        return $this->providerRepository->getProvider($data);
    }

    public function getAllProviders(): Collection
    {
        return $this->providerRepository->getAllProviders();
    }
}
