<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StockSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Vamos inserir 10 registros de estoque manualmente
        // Produto ID 1 no Local 1, Produto 2 no Local 2, etc.
        for ($i = 1; $i <= 10; $i++) {
            DB::table('stock')->insert([
                'product_id' => $i,
                'location_id' => $i, // Distribuindo um em cada lugar
                'quantity' => rand(10, 100), // Quantidade aleatória
                'created_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}