<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $locais = [
            'Depósito Central', 'Almoxarifado A', 'Prateleira B3', 'Loja Frente',
            'Showroom', 'Depósito Externo', 'Armário 01', 'Armário 02',
            'Caminhão Entrega', 'Recepção'
        ];

        foreach ($locais as $nome) {
            DB::table('locations')->insert([
                'name' => $nome,
                'address' => 'Rua Exemplo, 123',
                'city' => 'São Paulo',
                'state' => 'SP',
                'cep' => '00000-000',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}