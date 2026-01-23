<?php
namespace App\Repositories\Eloquent;

use App\Models\Location;
use App\Repositories\Interfaces\LocationRepositoryInterface;
use Illuminate\Support\Collection;

class LocationRepository implements LocationRepositoryInterface
{
    public function getAll(): Collection
    {
        return Location::all();
    }

    public function get(array $id): ?Collection
    {
        return Location::whereIn('id', $id)->get();
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