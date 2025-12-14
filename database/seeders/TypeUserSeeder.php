<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeUserSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        // Atenção: Se sua tabela for 'type_users' (plural), mude abaixo.
        DB::table('type_user')->insert([
            ['id' => 1, 'name' => 'Admin', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'Gestor', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'Colaborador', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
