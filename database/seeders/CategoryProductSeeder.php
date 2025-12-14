<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoryProductSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        // Vamos criar 5 categorias para usar nos produtos
        $categories = [
            ['name' => 'Eletrônicos', 'description' => 'Dispositivos e gadgets'],
            ['name' => 'Periféricos', 'description' => 'Teclados, mouses, etc'],
            ['name' => 'Cabos', 'description' => 'Cabos de rede e energia'],
            ['name' => 'Monitores', 'description' => 'Telas e suportes'],
            ['name' => 'Cadeiras', 'description' => 'Ergonomia e escritório'],
            ['name' => 'Impressoras', 'description' => 'Laser e Jato de Tinta'],
            ['name' => 'Servidores', 'description' => 'Racks e peças'],
            ['name' => 'Softwares', 'description' => 'Licenças Windows/Office'],
            ['name' => 'Redes', 'description' => 'Roteadores e Switchs'],
            ['name' => 'Segurança', 'description' => 'Câmeras e Alarmes'],
        ];

        foreach ($categories as $cat) {
            DB::table('category_products')->insert([ // Atenção ao nome da tabela
                'name' => $cat['name'],
                'description' => $cat['description'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}