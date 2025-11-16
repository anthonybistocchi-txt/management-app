<?php

namespace Database\Seeders;

use App\Models\ProductLocation;
use Illuminate\Database\Seeder;
use App\Models\ProductsLocation;
use App\Models\Product;
use App\Models\User;

class ProductLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductLocation::truncate();

        $adminId  = User::first()->id;
        $products = Product::all();

        if ($products->isEmpty()) {
            $this->command->error('Nenhum produto encontrado. Rode o ProductSeeder primeiro.');
            return;
        }

        // Para cada produto, criar uma localização
        foreach ($products as $product) {
            ProductLocation::create([
                'product_id' => $product->id,
                'address'    => 'Armazém Principal',
                'city'       => 'São Paulo',
                'state'      => 'SP',
                'cep'        => '01000-000',
                'created_by' => $adminId,
                'updated_by' => $adminId,
            ]);

            // Opcional: criar uma segunda localização para alguns produtos
            if (rand(0, 3) == 1) { // 25% de chance
                ProductLocation::create([
                    'product_id' => $product->id,
                    'address'    => 'Estoque Secundário',
                    'city'       => 'Rio de Janeiro',
                    'state'      => 'RJ',
                    'cep'        => '20000-000',
                    'created_by' => $adminId,
                    'updated_by' => $adminId,
                ]);
            }
        }
    }
}