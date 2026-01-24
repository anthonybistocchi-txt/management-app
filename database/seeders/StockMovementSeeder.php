<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StockMovementSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Pega todos os registros atuais de estoque
        $stocks = DB::table('stock')->get();
        
        // Pega IDs dos fornecedores para sortear
        $providerIds = DB::table('providers')->pluck('id')->toArray();

        if (empty($providerIds)) {
            $this->command->info('Nenhum fornecedor encontrado. Pule o StockMovementSeeder ou crie fornecedores antes.');
            return;
        }

        foreach ($stocks as $stock) {
            $qtdAtual = $stock->quantity;
            
            // ==========================================================
            // PASSO 1: CRIAR A "COMPRA" (Entrada) QUE ORIGINOU ESTE ESTOQUE
            // ==========================================================
            // Vamos fingir que compramos um pouco a mais do que tem hoje,
            // para depois simular que vendemos algumas unidades.
            $qtdComprada = $qtdAtual + rand(0, 5); // Comprou o que tem + sobrinha

            DB::table('stock_movements')->insert([
                'product_id' => $stock->product_id,
                'location_id' => $stock->location_id,
                'provider_id' => $providerIds[array_rand($providerIds)], // Aqui está o vínculo com Fornecedor!
                'type' => 'in',
                'quantity_moved' => $qtdComprada,
                'quantity_before' => 0,
                'quantity_after' => $qtdComprada,
                'movement_date' => Carbon::now()->subDays(rand(0, 4)),
                'description' => 'Compra inicial de estoque / Nota Fiscal ' . rand(1000, 9999),
                'created_by' => 1,
                'created_at' => Carbon::now()->subDays(rand(5, 30)), // Compra feita dias atrás
                'updated_at' => Carbon::now()->subDays(rand(5, 30)),
            ]);

            // Se a quantidade comprada for maior que a atual, significa que houve vendas (Saídas)
            if ($qtdComprada > $qtdAtual) {
                $diferenca = $qtdComprada - $qtdAtual;

                // ==========================================================
                // PASSO 2: SIMULAR SAÍDAS (VENDAS)
                // ==========================================================
                DB::table('stock_movements')->insert([
                    'product_id' => $stock->product_id,
                    'location_id' => $stock->location_id,
                    'provider_id' => null, // Saída geralmente não tem fornecedor
                    'type' => 'out',
                    'quantity_moved' => $diferenca,
                    'quantity_before' => $qtdComprada,
                    'quantity_after' => $qtdAtual, // O saldo final bate com a tabela stock
                    'movement_date' => Carbon::now()->subDays(rand(0, 60)),
                    'description' => 'Venda / Saída interna',
                    'created_by' => 1,
                    'created_at' => Carbon::now()->subDays(rand(0, 4)), // Venda recente
                    'updated_at' => Carbon::now()->subDays(rand(0, 4)),
                ]);
            }
        }
    }
}