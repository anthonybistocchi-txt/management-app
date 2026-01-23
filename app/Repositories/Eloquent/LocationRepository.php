<?php

use App\Models\Location;
use App\Repositories\Interfaces\LocationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class LocationRepository implements LocationRepositoryInterface
{
    public function getAll(): Collection
    {
        return Location::all();
    }

    public function getByIds(array $ids): Collection
    {
        return Location::whereIn('id', $ids)->get();
    }
    public function get(int $id): ?Location
    {
        return Location::find($id);
    }

    public function create(array $data): Location
    {
        return Location::create($data);
    }

    public function update(array $data): Location
    {
        $location = Location::findOrFail($data['id']);
        $location->update($data);
        return $location;
    }

    public function delete(int $id): bool
    {
        $location = Location::findOrFail($id);
        return $location->delete();
    }

}