<?php

namespace App\Repositories\Interfaces;

interface ProviderRepositoryInterface
{
    public function getProvider($id);
    public function getAllProviders();
    public function createProvider(array $data);
    public function updateProvider($id, array $data);
    public function deleteProvider($id);
}