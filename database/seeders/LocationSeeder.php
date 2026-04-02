<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $locais = [
            ['Depósito Central', 'Av. Industrial, 1500', 'Guarulhos', 'SP', '07190-100'],
            ['Almoxarifado A', 'Rua do Comércio, 220', 'São Paulo', 'SP', '01010-000'],
            ['Prateleira B3', 'Rua das Flores, 88', 'Osasco', 'SP', '06010-000'],
            ['Loja Frente', 'Rua XV de Novembro, 400', 'São Paulo', 'SP', '01013-000'],
            ['Showroom', 'Alameda Santos, 700', 'São Paulo', 'SP', '01418-000'],
            ['Depósito Externo', 'Rodovia Presidente Dutra, km 210', 'Arujá', 'SP', '07400-000'],
            ['Armário 01', 'Rua Oscar Freire, 120', 'São Paulo', 'SP', '01426-000'],
            ['Armário 02', 'Rua Haddock Lobo, 595', 'São Paulo', 'SP', '01414-000'],
            ['Caminhão Entrega', 'Rua da Consolação, 2300', 'São Paulo', 'SP', '01302-000'],
            ['Recepção', 'Av. Brigadeiro, 2100', 'São Paulo', 'SP', '01451-000'],
            ['Galpão Norte', 'Rua do Limão, 3400', 'São Paulo', 'SP', '02710-000'],
            ['Estoque Frio', 'Rua Voluntários da Pátria, 450', 'São Paulo', 'SP', '02011-000'],
            ['Loja Filial Campinas', 'Av. Brasil, 1500', 'Campinas', 'SP', '13010-000'],
            ['Hub Logística RJ', 'Av. das Américas, 3000', 'Rio de Janeiro', 'RJ', '22640-100'],
            ['Mini-deposito BH', 'Rua da Bahia, 1200', 'Belo Horizonte', 'MG', '30160-000'],
        ];

        foreach ($locais as $row) {
            DB::table('locations')->insert([
                'name' => $row[0],
                'address' => $row[1],
                'city' => $row[2],
                'state' => $row[3],
                'cep' => $row[4],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
