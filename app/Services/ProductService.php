<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Collection;

class ProductService
{
    public function __construct(protected ProductRepositoryInterface $productRepository) {}

    public function create(array $data): Product
    {
        return $this->productRepository->create($this->normalizePriceToCentavos($data));
    }

    public function getAll(): Collection
    {
        return $this->productRepository->getAll();
    }

    public function get(array $id): Collection
    {
        return $this->productRepository->get($id);
    }
    
    public function update(array $data): Product
    {
        return $this->productRepository->update($this->normalizePriceToCentavos($data));
    }

    /**
     * A API recebe preço em reais (ex.: 1999.99); o banco armazena inteiro em centavos.
     */
    private function normalizePriceToCentavos(array $data): array
    {
        if (! array_key_exists('price', $data) || $data['price'] === null) {
            return $data;
        }

        $data['price'] = (int) round((float) $data['price'] * 100);

        return $data;
    }

    public function delete(int $id): bool
    {
        return $this->productRepository->delete($id);
    }

    public function search(string $query, int $limit = 15): Collection
    {
        return $this->productRepository->search($query, $limit);
    }
}