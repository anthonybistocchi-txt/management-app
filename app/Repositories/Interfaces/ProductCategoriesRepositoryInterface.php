<?php 

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ProductCategoriesRepositoryInterface
{
    public function getAll(): Collection;
}