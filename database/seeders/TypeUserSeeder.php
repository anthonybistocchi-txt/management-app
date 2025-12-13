<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('type_user')->insert([
            ['id' => 1, 'name' => 'Admin'],
            ['id' => 2, 'name' => 'Gestor'],
            ['id' => 3, 'name' => 'Colaborador'],
        ]);
    }
}
