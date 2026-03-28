<?php

namespace App\Services;

use App\Models\Provider;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProviderService
{
    public function __construct(protected ProviderRepositoryInterface $providerRepository) {}

    public function create(array $data): Provider
    {
        return $this->providerRepository->create($data);
    }

    public function delete(int $id): bool
    {
        return $this->providerRepository->delete($id);
    }

    public function update(array $data): Provider
    {
        return $this->providerRepository->update($data);
    }

    public function get(array $data): Collection
    {
        return $this->providerRepository->get($data);
    }

    public function getAll(): Collection
    {
        return $this->providerRepository->getAll();
    }
}
