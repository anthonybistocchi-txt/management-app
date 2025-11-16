<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TypeUserSeeder::class,
            UserSeeder::class,
            ProviderSeeder::class,
            ProductSeeder::class,
            ProductLocationSeeder::class,
            StockSeeder::class,
            StockMovementSeeder::class,
        ]);
    }
}