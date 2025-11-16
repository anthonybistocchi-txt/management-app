<?php

namespace Database\Seeders;

use App\Models\StockMovements;
use Illuminate\Database\Seeder;
use App\Models\StockMovement;
use App\Models\Stock;
use App\Models\User;
use App\Models\Provider; // Precisamos para associar a entrada

class StockMovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StockMovements::truncate();

        $adminId     = User::first()->id;
        $stocks      = Stock::all();
        $providerIds = Provider::all()->pluck('id');

        if ($stocks->isEmpty()) {
            $this->command->error('Nenhum registro de estoque encontrado. Rode o StockSeeder primeiro.');
            return;
        }

        foreach ($stocks as $stock) {
            StockMovements::create([
                'product_id'        => $stock->product_id,
                'location_id'       => $stock->location_id,
                'provider_id'       => $providerIds->random(),
                'type'              => 'in', // Entrada
                'quantity_moved'    => $stock->quantity,
                'previous_quantity' => 0,
                'new_quantity'      => $stock->quantity,
                'description'       => 'Carga inicial via Seeder',
                'created_by'        => $adminId,
            ]);
        }
    }
}