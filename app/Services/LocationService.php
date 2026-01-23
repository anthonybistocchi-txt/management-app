<?php

namespace App\Services;

use App\Models\Location;
use App\Repositories\Eloquent\LocationRepository;
use Illuminate\Support\Collection;


class LocationService
{
    public function __construct(protected LocationRepository $repository) {}
    
    public function getAllLocations(): Collection
    {
        return $this->repository->getAll();
    }

    public function create(array $data): Location
    {
        return $this->repository->create($data);
    }

    public function update(array $data): Location
    {
        return $this->repository->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function get(array $id): Collection
    {
        return $this->repository->get($id);
    }

}