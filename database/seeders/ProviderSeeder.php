<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProviderSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $providers = [
            ['TechPower Distribuidora', '12.345.678/0001-90', '(11) 98888-1111', 'contato@techpower.com', 'Rua das Indústrias', '123', 'São Paulo', 'SP', '01000-000'],
            ['MegaBaterias LTDA', '98.765.432/0001-22', '(21) 97777-2222', 'vendas@megabaterias.com', 'Av. Brasil', '450', 'Rio de Janeiro', 'RJ', '20000-000'],
            ['Eletronic Parts BR', '23.456.789/0001-55', '(31) 96666-3333', 'suporte@eparts.com', 'Rua Afonso Pena', '880', 'Belo Horizonte', 'MG', '30130-000'],
            ['Nordic Imports', '11.223.344/0001-77', '(48) 99123-4400', 'compras@nordicimports.com.br', 'Rodovia SC 401', '2150', 'Florianópolis', 'SC', '88032-000'],
            ['DataCenter Supply', '55.667.788/0001-33', '(19) 3456-8899', 'vendas@datacentersupply.com', 'Av. John Boyd Dunlop', '3500', 'Campinas', 'SP', '13034-685'],
            ['Periféricos Sul', '44.332.211/0001-88', '(51) 3322-1100', 'pedidos@perifericossul.net', 'Rua dos Andradas', '1204', 'Porto Alegre', 'RS', '90020-000'],
            ['Redes & Cabos Express', '77.889.900/0001-11', '(85) 98765-4321', 'contato@redescabos.com', 'Av. Beira Mar', '2500', 'Fortaleza', 'CE', '60165-121'],
            ['Office Prime', '33.221.100/0001-44', '(41) 3012-5566', 'b2b@officeprime.com.br', 'Rua XV de Novembro', '1299', 'Curitiba', 'PR', '80020-310'],
            ['Segurança Total Dist.', '66.554.433/0001-22', '(62) 98111-2233', 'vendas@segurancatotal.com', 'Av. T-63', '1200', 'Goiânia', 'GO', '74210-005'],
            ['Solar Tech BR', '88.990.011/0001-66', '(71) 99988-7766', 'comercial@solartechbr.com', 'Av. Paralela', '1200', 'Salvador', 'BA', '41730-101'],
            ['Gamer House Import', '22.334.455/0001-99', '(11) 4002-8922', 'import@gamerhouse.com', 'Rua Augusta', '2500', 'São Paulo', 'SP', '01413-000'],
            ['Papelão & Etiquetas Pro', '99.887.766/0001-00', '(27) 3333-4444', 'vendas@papelaoetiquetas.com', 'Rua Sete de Setembro', '45', 'Vitória', 'ES', '29010-400'],
            ['Móveis Ergo Linha', '10.203.040/0001-50', '(47) 98877-6655', 'contato@ergolinha.com.br', 'Rua Hermann Blumenau', '520', 'Joinville', 'SC', '89204-000'],
            ['Licenças Microsoft Partner', '45.678.901/0001-23', '(11) 3456-7890', 'licencas@mspartnerfake.com', 'Av. Paulista', '1000', 'São Paulo', 'SP', '01310-100'],
            ['Componentes Eletrônicos SP', '12.998.877/0001-66', '(11) 3222-8899', 'vendas@compelsp.com', 'Rua Santa Efigênia', '200', 'São Paulo', 'SP', '01207-000'],
        ];

        foreach ($providers as $p) {
            DB::table('providers')->insert([
                'name' => $p[0],
                'cnpj' => $p[1],
                'phone' => $p[2],
                'email' => $p[3],
                'street' => $p[4],
                'number' => $p[5],
                'city' => $p[6],
                'state' => $p[7],
                'cep' => $p[8],
                'active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
