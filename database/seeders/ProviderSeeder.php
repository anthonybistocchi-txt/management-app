<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProviderSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('providers')->insert([
            [
                'name' => 'TechPower Distribuidora',
                'cnpj' => '12.345.678/0001-90',
                'phone' => '(11) 98888-1111',
                'email' => 'contato@techpower.com',
                'street' => 'Rua das Indústrias',
                'number' => '123',
                'city' => 'São Paulo',
                'state' => 'SP',
                'cep' => '01000-000',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'MegaBaterias LTDA',
                'cnpj' => '98.765.432/0001-22',
                'phone' => '(21) 97777-2222',
                'email' => 'vendas@megabaterias.com',
                'street' => 'Av. Brasil',
                'number' => '45',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'cep' => '20000-000',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Eletronic Parts BR',
                'cnpj' => '23.456.789/0001-55',
                'phone' => '(31) 96666-3333',
                'email' => 'suporte@eparts.com',
                'street' => 'Rua Afonso Pena',
                'number' => '88',
                'city' => 'Belo Horizonte',
                'state' => 'MG',
                'cep' => '30000-000',
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ]);
    }
}
