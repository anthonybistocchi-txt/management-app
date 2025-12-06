<?php

namespace App\Services;

use App\Models\Provider;
use App\Repositories\Contracts\ProviderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProviderService
{
    public function __construct(
        protected ProviderRepositoryInterface $providerRepository
    ) {}

    public function createProvider(array $data): Provider
    {
        return $this->providerRepository->create($data);
    }

    public function deleteProvider(int $id): bool
    {
        return $this->providerRepository->delete($id);
    }

    public function updateProvider(int $id, array $data): Provider
    {
        return $this->providerRepository->update($id, $data);
    }

    public function getProvider(string $idsString): Collection
    {
        $ids = explode(',', $idsString);
        return $this->providerRepository->findByIds($ids);
    }

    public function getAllProviders(): array
    {
        return $this->providerRepository->findAll();
    }
}

