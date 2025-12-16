<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        
        $produtos = [
            ['Mouse Logitech', 15000, 2], // Nome, Preço (centavos), ID Categoria
            ['Teclado Mecânico', 35000, 2],
            ['Monitor Dell 24', 120000, 4],
            ['Cabo HDMI 2m', 2500, 3],
            ['Cadeira Gamer', 90000, 5],
            ['Roteador WiFi 6', 45000, 9],
            ['Windows 11 Pro', 80000, 8],
            ['SSD 1TB Kingston', 40000, 1],
            ['Webcam HD', 18000, 2],
            ['Switch 8 Portas', 12000, 9],
        ];

        foreach ($produtos as $prod) {
            DB::table('products')->insert([
                'name' => $prod[0],
                'price' => $prod[1],
                'category_products_id' => $prod[2], // ID da categoria manual
                'created_by' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}