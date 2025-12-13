<?php

namespace Database\Seeders;

use Auth;
use Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

        DB::table('users')->insert([
            [
                'name' => 'Ana Silva',
                'username' => 'ana.silva',
                'email' => 'ana.silva@example.com',
                'password' => $password,
                'type_user_id' => 1,
                'cpf' => '00000000001',
                'active' => 1,
                'deleted_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Bruno Costa',
                'username' => 'bruno.costa',    
                'email' => 'bruno.costa@example.com',
                'password' => $password,
                'type_user_id' => 1,
                'cpf' => '00000000002',
                'active' => 1,
                'deleted_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Carla Dias',
                'username' => 'carla.dias',
                'email' => 'carla.dias@example.com',
                'password' => $password,
                'type_user_id' => 2,
                'cpf' => '00000000003',
                'active' => 1,
                'deleted_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Anthony Bistocchi',
                'username' => 'anthony.bistocchi',
                'email' => 'anthony.bistocchi@example.com',
                'password' => Hash::make('123456'),
                'type_user_id' => 2,
                'cpf' => '44444121866',
                'active' => 1,
                'deleted_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
