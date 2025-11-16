<?php

namespace Database\Seeders;

use App\Models\ProductLocation;
use Illuminate\Database\Seeder;
use App\Models\Stock;
use App\Models\User;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Stock::truncate();

        $adminId   = User::first()->id;
        $locations = ProductLocation::all();

        if ($locations->isEmpty()) {
            $this->command->error('Nenhuma localização de produto encontrada. Rode o ProductsLocationSeeder primeiro.');
            return;
        }

        foreach ($locations as $location) {
            Stock::create([
                'product_id'  => $location->product_id,
                'location_id' => $location->id,
                'quantity'    => 100, // Vamos popular o próximo seeder com base nisso
                'created_by'  => $adminId,
                'updated_by'  => $adminId,
            ]);
        }
    }
}