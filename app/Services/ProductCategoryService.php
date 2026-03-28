<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductCategoriesRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ProductCategoryService
{
    public function __construct(protected ProductCategoriesRepositoryInterface $productCategoriesRepository) {}

    public function getAll(): Collection
    {
        return $this->productCategoriesRepository->getAll();
    }
}