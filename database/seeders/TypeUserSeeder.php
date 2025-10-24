<?php

namespace Database\Seeders;

use App\Models\TypeUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeUser::truncate();

        TypeUser::create([
            'name' => 'Admin'
        ]);

        TypeUser::create([
            'name' => 'Gestor'
        ]);

        TypeUser::create([
            'name' => 'User'
        ]);
    }
}
