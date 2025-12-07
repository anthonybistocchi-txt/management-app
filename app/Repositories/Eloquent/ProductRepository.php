<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductRepository
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        return $this->model->all();
    }

    public function find($id): Collection|Product|null
    {
        return $this->model->find($id); // Retorna null se não achar, ou use findOrFail
    }

    public function create(array $data): Product
    {
        return $this->model->create($data);
    }

    public function update($id, array $data): Collection|Product|null
    {
        $product = $this->find($id);
        if ($product) {
            $product->update($data);
            return $product;
        }
        return null;
    }

    public function delete($id): bool|null
    {
        $product = $this->find($id);
        if ($product) {
            return $product->delete();
        }
        return false;
    }

    public function findByIds(array $ids): Collection
    {
        return $this->model->whereIn('id', $ids)->get();
    }
}