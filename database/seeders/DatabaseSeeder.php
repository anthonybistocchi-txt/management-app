<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // A ordem importa por causa das chaves estrangeiras!
        $this->call([
            TypeUserSeeder::class,      // 1. Tipos de Usuário
            UserSeeder::class,          // 2. Usuários (precisa dos tipos)
            ProviderSeeder::class,      // 3. Fornecedores
            CategoryProductSeeder::class, // 4. Categorias
            LocationSeeder::class,      // 5. Locais
            ProductSeeder::class,       // 6. Produtos (precisa de categoria e fornecedor)
            StockSeeder::class,         // 7. Estoque (precisa de produto e local)
            StockMovementSeeder::class,  // 8. Movimentações de Estoque (precisa de estoque e usuário)
        ]);
    }
}