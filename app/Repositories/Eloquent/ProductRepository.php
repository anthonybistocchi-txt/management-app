<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use Illuminate\Support\Collection;
class ProductRepository
{
    public function __construct(protected Product $model){}

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

    public function update($id, array $data): bool
    {
        $product = $this->find($id);
        $product->update($data);
            
        return true;
    }

    public function delete($id): bool
    {
        $product = $this->find($id);

        return $product->delete();
        
    }

    public function findByIds(array $ids): Collection
    {
        return $this->model->whereIn('id', $ids)->get();
    }
}