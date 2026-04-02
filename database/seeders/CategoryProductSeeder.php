<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $categories = [
            ['name' => 'Notebooks e PCs', 'description' => 'Computadores portáteis e desktops'],
            ['name' => 'Monitores e Displays', 'description' => 'Monitores LED, OLED e acessórios'],
            ['name' => 'Periféricos', 'description' => 'Teclados, mouses, webcams e headsets'],
            ['name' => 'Armazenamento', 'description' => 'SSD, HD, NVMe e pendrives'],
            ['name' => 'Memória RAM', 'description' => 'Módulos DDR4, DDR5 e notebooks'],
            ['name' => 'Placas-mãe e GPUs', 'description' => 'Placas de vídeo e mainboards'],
            ['name' => 'Fontes e Energia', 'description' => 'Fontes ATX, no-breaks e filtros'],
            ['name' => 'Gabinetes e Refrigeração', 'description' => 'Cases, coolers e pasta térmica'],
            ['name' => 'Redes e Wi-Fi', 'description' => 'Roteadores, switches e access points'],
            ['name' => 'Cabos e Adaptadores', 'description' => 'HDMI, USB-C, energia e rede'],
            ['name' => 'Impressão e Scanner', 'description' => 'Impressoras, toners e multifuncionais'],
            ['name' => 'Mobiliário Office', 'description' => 'Cadeiras, mesas e suportes'],
            ['name' => 'Iluminação', 'description' => 'Luminárias LED e fitas'],
            ['name' => 'Áudio profissional', 'description' => 'Interfaces, microfones e monitores de campo'],
            ['name' => 'Software e Licenças', 'description' => 'SO, office e antivírus'],
            ['name' => 'Servidores e Rack', 'description' => 'Servidores, PDUs e organização'],
            ['name' => 'Backup e NAS', 'description' => 'Storage em rede e fitas'],
            ['name' => 'Segurança eletrônica', 'description' => 'Câmeras IP, DVRs e sensores'],
            ['name' => 'Controle de acesso', 'description' => 'Catracas, leitores e fechaduras'],
            ['name' => 'Energia solar', 'description' => 'Inversores, painéis e estruturas'],
            ['name' => 'Automação e IoT', 'description' => 'Relés inteligentes, hubs e sensores'],
            ['name' => 'Ferramentas e Bancada', 'description' => 'Estações de solda e kits'],
            ['name' => 'Componentes passivos', 'description' => 'Resistores, capacitores e conectores'],
            ['name' => 'Smartphones e Tablets', 'description' => 'Aparelhos móveis e capas'],
            ['name' => 'Wearables', 'description' => 'Smartwatches e pulseiras'],
            ['name' => 'Games e Console', 'description' => 'Consoles, controles e jogos'],
            ['name' => 'Papelaria tech', 'description' => 'Etiquetadoras e organizadores'],
            ['name' => 'Higiene e EPI', 'description' => 'Limpeza de equipamentos e EPIs'],
            ['name' => 'Logística e Embalagem', 'description' => 'Caixas, fitas e envelopes'],
            ['name' => 'Peças de reposição', 'description' => 'Baterias, telas e flex'],
        ];

        foreach ($categories as $cat) {
            DB::table('product_categories')->insert([
                'name' => $cat['name'],
                'description' => $cat['description'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
