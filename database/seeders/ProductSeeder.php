<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Provider;
use App\Models\User;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::truncate();

        $adminId     = User::first()->id;
        $providerIds = Provider::all()->pluck('id'); // Pega todos os IDs de fornecedores

        if ($providerIds->isEmpty()) {
            $this->command->error('Nenhum fornecedor encontrado. Rode o ProviderSeeder primeiro.');
            return;
        }

        // Criar 50 produtos de exemplo
        for ($i = 0; $i < 50; $i++) {
            Product::create([
                'name' => fake()->productName(), 
                'sku' => fake()->unique()->ean13(),
                'description' => fake()->sentence(),
                'price' => fake()->numberBetween(1000, 100000), 
                'provider_id' => $providerIds->random(), 
                'created_by' => $adminId,
                'updated_by' => $adminId,
            ]);
        }
    }
}