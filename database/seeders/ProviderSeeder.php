<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provider;
use App\Models\User;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Provider::truncate();

        $adminId = User::first()->id; // Pega o ID do primeiro usuário (Admin)

        // Criar 15 fornecedores de exemplo
        for ($i = 0; $i < 15; $i++) {
            Provider::create([
                'name'       => fake()->company(),
                'cnpj'       => fake()->numerify('##############'), // 14 dígitos
                'phone'      => fake()->phoneNumber(),
                'email'      => fake()->unique()->companyEmail(),
                'active'     => 1,
                'cep'        => fake()->postcode(),
                'street'     => fake()->streetName(),
                'number'     => fake()->buildingNumber(),
                'city'       => fake()->city(),
                'state'      => fake()->stateAbbr(),
                'created_by' => $adminId,
                'updated_by' => $adminId,
            ]);
        }
    }
}