<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TypeUser; // Opcional, se você tiver o Model

class TypeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa a tabela antes de popular
        DB::table('type_user')->truncate();

        // Insere os tipos de usuário
        DB::table('type_user')->insert([
            ['name' => 'Admin'],
            ['name' => 'Gerente'],
            ['name' => 'Estoquista'],
        ]);
    }
}