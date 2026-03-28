<?php

namespace App\Repositories\Eloquent;

use App\Models\ProductCategory;
use App\Repositories\Interfaces\ProductCategoriesRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductCategoriesRepository implements ProductCategoriesRepositoryInterface
{
    public function getAll(): Collection
    {
        return ProductCategory::all();
    }
}