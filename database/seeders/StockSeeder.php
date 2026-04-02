<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    public function run(): void
    {
        $productIds = DB::table('products')->pluck('id')->all();
        $locationIds = DB::table('locations')->pluck('id')->all();

        if ($productIds === [] || $locationIds === []) {
            $this->command?->warn('StockSeeder: sem produtos ou locais.');

            return;
        }

        $pairs = [];

        foreach ($productIds as $pid) {
            shuffle($locationIds);
            $numLocs = random_int(1, min(3, count($locationIds)));
            for ($i = 0; $i < $numLocs; $i++) {
                $key = $pid.'-'.$locationIds[$i];
                if (isset($pairs[$key])) {
                    continue;
                }
                $pairs[$key] = [
                    'product_id' => $pid,
                    'location_id' => $locationIds[$i],
                    'quantity' => random_int(5, 420),
                ];
            }
        }

        foreach ($pairs as $row) {
            DB::table('stock')->insert($row);
        }
    }
}
