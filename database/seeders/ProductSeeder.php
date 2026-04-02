<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Nomes reais por categoria (ordem alinhada ao CategoryProductSeeder).
     */
    private function catalog(): array
    {
        return [
            'Notebooks e PCs' => [
                'Notebook Dell Latitude 5420 14" i5 16GB',
                'Notebook Lenovo ThinkPad E14 Gen 5 Ryzen 7',
                'Notebook HP ProBook 450 G10 15,6" i7',
                'PC Dell OptiPlex Micro i5 512GB SSD',
                'Mini PC Lenovo ThinkCentre M75q Gen 2',
                'Workstation HP Z2 G9 Xeon W3',
            ],
            'Monitores e Displays' => [
                'Monitor Dell P2422H 24" Full HD IPS',
                'Monitor LG UltraWide 29WP500 29" IPS',
                'Monitor Samsung Odyssey G5 27" 144Hz',
                'Monitor BenQ GW2780 27" IPS',
                'Suporte articulado NB North Bayou F80',
                'Monitor portátil Asus ZenScreen MB16AC 15,6"',
            ],
            'Periféricos' => [
                'Mouse Logitech MX Master 3S',
                'Teclado Logitech MX Keys',
                'Headset HyperX Cloud II',
                'Webcam Logitech C920s Pro HD',
                'Mousepad SteelSeries QcK Grande',
                'Kit teclado e mouse Logitech MK270',
            ],
            'Armazenamento' => [
                'SSD Samsung 980 PRO 1TB NVMe M.2',
                'SSD Kingston NV2 500GB NVMe',
                'HD Seagate Barracuda 2TB 7200RPM',
                'Pendrive SanDisk Ultra USB 3.0 128GB',
                'HD externo WD Elements 4TB USB 3.0',
                'SSD Crucial MX500 1TB SATA 2,5"',
            ],
            'Memória RAM' => [
                'Memória Kingston Fury Beast 16GB DDR4 3200',
                'Memória Corsair Vengeance 32GB DDR5 5600',
                'Memória Crucial 8GB DDR4 2666 SODIMM',
                'Kit 2x16GB HyperX Fury DDR4 3200',
                'Memória Kingston ValueRAM 16GB DDR5 4800',
            ],
            'Placas-mãe e GPUs' => [
                'Placa de vídeo NVIDIA GeForce RTX 4060 8GB',
                'Placa de vídeo AMD Radeon RX 7600 8GB',
                'Placa-mãe ASUS TUF B550M-Plus Wi-Fi',
                'Placa-mãe Gigabyte B760M DS3H DDR5',
                'Placa de vídeo NVIDIA RTX 3060 12GB',
            ],
            'Fontes e Energia' => [
                'Fonte Corsair CX750 750W 80 Plus Bronze',
                'Fonte Seasonic Focus GX-850 80 Plus Gold',
                'No-break APC Back-UPS 600VA BZ600',
                'Filtro de linha Clamper iCLAMPER 8 tomadas',
                'Fonte XPG Core Reactor 650W 80 Plus Gold',
            ],
            'Gabinetes e Refrigeração' => [
                'Gabinete NZXT H510 Flow Mid Tower',
                'Cooler CPU Cooler Master Hyper 212 RGB',
                'Pasta térmica Arctic MX-6',
                'Gabinete Corsair 4000D Airflow',
                'Kit ventoinhas Corsair AF120 RGB',
                'Water cooler Corsair H100 RGB 240mm',
            ],
            'Redes e Wi-Fi' => [
                'Roteador TP-Link Archer AX55 Wi-Fi 6',
                'Switch TP-Link TL-SG108 8 portas Gigabit',
                'Access Point Ubiquiti UniFi U6 Lite',
                'Roteador MikroTik hAP ax³',
                'Cabo patch cord Furukawa CAT6 3m azul',
            ],
            'Cabos e Adaptadores' => [
                'Cabo HDMI 2.1 2m certificado 8K',
                'Cabo USB-C para USB-C 100W 2m',
                'Adaptador USB-C para HDMI 4K',
                'Cabo de rede CAT6 5m cinza',
                'Extensor USB 3.0 ativo 5m',
            ],
            'Impressão e Scanner' => [
                'Impressora multifuncional HP LaserJet MFP M236dw',
                'Impressora Epson EcoTank L3250',
                'Toner HP 59A preto compatível',
                'Scanner portátil Brother DS-640',
                'Papel sulfite A4 Chamex 75g resma 500 fls',
            ],
            'Mobiliário Office' => [
                'Cadeira ergonômica Flexform Uni',
                'Mesa para escritório 1,40m reta',
                'Suporte para monitor ergonômico',
                'Gaveteiro volante 3 gavetas',
                'Apoio de pés ergonômico',
            ],
            'Iluminação' => [
                'Luminária de mesa LED articulada',
                'Fita LED RGB 5m com controle',
                'Lâmpada LED bulbo 9W branco frio',
                'Spot LED embutir redondo 7W',
            ],
            'Áudio profissional' => [
                'Interface de áudio Focusrite Scarlett 2i2',
                'Microfone Shure SM58',
                'Monitor de áudio JBL Professional 305P MkII',
                'Fone Audio-Technica ATH-M50x',
                'Mixer Yamaha MG10XU',
            ],
            'Software e Licenças' => [
                'Licença Windows 11 Pro OEM',
                'Microsoft 365 Business Standard (anual)',
                'Antivírus Kaspersky Small Office',
                'Licença Adobe Acrobat Pro (anual)',
                'Backup Acronis Cyber Protect Home',
            ],
            'Servidores e Rack' => [
                'Servidor Dell PowerEdge R650xs (config. base)',
                'Rack fechado 42U 600mm',
                'PDU vertical 16A 8 tomadas',
                'KVM switch 8 portas USB',
                'Bandeja fixa para rack 1U',
            ],
            'Backup e NAS' => [
                'NAS Synology DS224+ 2 baias',
                'HD para NAS Seagate IronWolf 4TB',
                'NAS QNAP TS-233 2 baias',
                'Fita LTO Ultrium limpeza',
            ],
            'Segurança eletrônica' => [
                'Câmera IP Intelbras VIP 1230 D G2',
                'DVR Intelbras 8 canais Full HD',
                'Sensor de presença infravermelho',
                'Fonte chaveada 12V 5A para CFTV',
            ],
            'Controle de acesso' => [
                'Controladora de acesso Intelbras SS 420',
                'Leitor de proximidade RFID 125kHz',
                'Fechadura elétrica inox 12V',
                'Botoeira de saída com acrílico',
            ],
            'Energia solar' => [
                'Inversor solar Growatt 3kW monofásico',
                'Módulo fotovoltaico 550W bifacial',
                'Estrutura fixa para 4 módulos',
                'String box CC 1000V 2 entradas',
            ],
            'Automação e IoT' => [
                'Hub automação Samsung SmartThings',
                'Sensor de temperatura Xiaomi',
                'Tomada inteligente Wi-Fi 16A',
                'Relé inteligente Shelly Plus 1',
            ],
            'Ferramentas e Bancada' => [
                'Estação de solda Hakko FX-888D',
                'Kit ferramentas precisão iFixit Essential',
                'Multímetro digital Minipa ET-2042',
                'Pinça antiestática ESD curva',
            ],
            'Componentes passivos' => [
                'Kit resistor carbono 1/4W 500 unidades',
                'Capacitor eletrolítico 1000µF 25V',
                'Conector USB tipo A fêmea painel',
                'Barra de pinos macho 40 vias',
            ],
            'Smartphones e Tablets' => [
                'Smartphone Samsung Galaxy A54 128GB',
                'Smartphone Motorola Edge 40 Neo',
                'Tablet Samsung Galaxy Tab S9 FE',
                'Capa silicone iPhone 15',
            ],
            'Wearables' => [
                'Smartwatch Samsung Galaxy Watch6',
                'Pulseira Xiaomi Smart Band 8',
                'Apple Watch SE 2ª geração GPS',
            ],
            'Games e Console' => [
                'Console Sony PlayStation 5',
                'Console Microsoft Xbox Series S',
                'Controle DualSense PS5',
                'Jogo Hogwarts Legacy PS5',
                'Headset gamer SteelSeries Arctis Nova 1',
            ],
            'Papelaria tech' => [
                'Etiquetadora Brother PT-H110',
                'Organizador de cabos velcro 10 unidades',
                'Porta-cartão RFID alumínio',
            ],
            'Higiene e EPI' => [
                'Kit limpeza telas e teclados',
                'Álcool isopropílico 1L 99,8%',
                'Luvas nitrílica descartável caixa 100',
            ],
            'Logística e Embalagem' => [
                'Caixa de papelão P sedex 10 unidades',
                'Fita adesiva transparente 48mm x 50m',
                'Envelope bolha P 15x20 pacote 50',
            ],
            'Peças de reposição' => [
                'Bateria notebook Dell 4-cell 68Wh',
                'Tela notebook 15,6" Full HD 30 pinos',
                'Flex flat teclado notebook genérico',
                'Teclado ABNT2 para notebook Lenovo',
            ],
        ];
    }

    public function run(): void
    {
        $now = Carbon::now();
        $catalog = $this->catalog();

        $categories = DB::table('product_categories')->orderBy('id')->get(['id', 'name']);

        foreach ($categories as $cat) {
            $pool = $catalog[$cat->name] ?? [];
            if ($pool === []) {
                $pool = ["{$cat->name} — item catálogo"];
            }

            $names = $pool;
            shuffle($names);
            $count = min(random_int(3, 5), count($names));

            for ($i = 0; $i < $count; $i++) {
                // Preço inteiro em centavos (ex.: 19990 = R$ 199,90), alinhado ao restante do sistema.
                $price = random_int(990, 899_990);

                DB::table('products')->insert([
                    'name' => $names[$i],
                    'description' => fake()->optional(0.65)->randomElement([
                        'Garantia nacional de 12 meses.',
                        'Produto lacrado com nota fiscal.',
                        'Envio em até 3 dias úteis.',
                        'Compatível com especificações do fabricante.',
                        'Inclui cabos e manuais na embalagem original.',
                    ]),
                    'price' => $price,
                    'product_category_id' => $cat->id,
                    'created_by' => 1,
                    'created_at' => $now->copy()->subDays(random_int(0, 400)),
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
