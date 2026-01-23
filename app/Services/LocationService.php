<?php

namespace App\Services;

class LocationService
{
    public function __construct(protected LocationRepository $repository) {}
    
    public function getAllLocations()
    {
        return $this->repository->getAll();
    }
}