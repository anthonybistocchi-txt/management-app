<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Use Hash::make

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::truncate();

        // Seus usuários manuais (corrigi bcrypt para Hash::make)
        User::create([
            'name'          => 'Admin',
            'email'         => 'admin.dev@gmail.com',
            'password'      => Hash::make('password123'),
            'cpf'           => '12345678901',
            'is_active'     => 1,
            'id_type_user'  => 1
        ]);
        // ... (Gestor e User) ...
        User::create([
            'name'          => 'Gestor',
            'email'         => 'gestor.dev@gmail.com',
            'password'      => Hash::make('password123'),
            'cpf'           => '10987654321',
            'is_active'     => 1,
            'id_type_user'  => 2
        ]);
        User::create([
            'name'          => 'User',
            'email'         => 'user@gmail.com',
            'password'      => Hash::make('password123'),
            'cpf'           => '19283746500',
            'is_active'     => 1,
            'id_type_user'  => 3
        ]);

        
        // 👇 SEU FACTORY CALL, AGORA MUITO MAIS LIMPO 👇
        // A factory vai cuidar do name, email, cpf, etc.
        // O state() vai cuidar APENAS das variações.
        User::factory()
            ->count(50) 
            ->state(new Sequence(
                fn(Sequence $sequence) => [
                    // Apenas o que você quer variar
                    'is_active'     => fake()->numberBetween(0, 1),
                    'id_type_user'  => fake()->numberBetween(1, 3),
                ]
            ))
            ->create();
    }
}