<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();

        // 1. Criar o usuário Admin principal
        User::create([
            'name'         => 'Admin do Sistema',
            'email'        => 'admin@example.com',
            'password'     => Hash::make('password'), // Mude para uma senha segura
            'type_user_id' => 1, // 'Admin' (do TypeUserSeeder)
            'cpf'          => '00000000000',
            'active'       => 1,
            'created_by'   => 1, // Ele mesmo
            'updated_by'   => 1, // Ele mesmo
        ]);

        // 2. Criar usuários de exemplo
        User::factory()->count(10)->create([
            'type_user_id' => 3, // 'Estoquista'
            'created_by'   => 1,   // Criado pelo Admin
            'updated_by'   => 1,   // Atualizado pelo Admin
        ]);

    }
}