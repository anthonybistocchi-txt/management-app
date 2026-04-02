<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StockMovementSeeder extends Seeder
{
    private Carbon $periodStart;

    private Carbon $periodEnd;

    public function run(): void
    {
        $stocks = DB::table('stock')->get();
        $providerIds = DB::table('providers')->pluck('id')->all();
        $userIds = DB::table('users')->pluck('id')->all();

        if ($stocks->isEmpty() || $providerIds === [] || $userIds === []) {
            $this->command?->warn('StockMovementSeeder: faltam estoque, fornecedores ou usuários.');

            return;
        }

        $this->periodStart = Carbon::now()->subYear()->startOfDay();
        $this->periodEnd = Carbon::now();

        $buffer = [];
        foreach ($stocks as $stock) {
            foreach ($this->buildMovementsForStock($stock, $providerIds, $userIds) as $row) {
                $buffer[] = $row;
                if (count($buffer) >= 250) {
                    DB::table('stock_movements')->insert($buffer);
                    $buffer = [];
                }
            }
        }

        if ($buffer !== []) {
            DB::table('stock_movements')->insert($buffer);
        }
    }

    /**
     * @return list<array<string, mixed>>
     */
    private function buildMovementsForStock(object $stock, array $providerIds, array $userIds): array
    {
        $target = (int) $stock->quantity;
        $totalSales = random_int(0, max(40, (int) min(2500, $target * 6)));
        $totalIn = $target + $totalSales;

        $inParts = max(4, min(22, (int) ceil($totalIn / 80)));
        $outParts = max(6, min(45, (int) ceil(max(1, $totalSales) / 25)));

        $inChunks = $this->partitionInteger($totalIn, $inParts);
        $outChunks = $totalSales > 0
            ? $this->partitionInteger($totalSales, $outParts)
            : [];

        $inWindowEnd = $this->periodStart->copy()->addMonths(7);
        $outWindowStart = $this->periodStart->copy()->addMonths(6);
        if ($outWindowStart->greaterThan($this->periodEnd)) {
            $outWindowStart = $this->periodStart->copy()->addMonth();
        }

        $events = [];

        foreach ($inChunks as $qty) {
            $events[] = [
                'type' => 'in',
                'qty' => $qty,
                'at' => $this->randomDateTimeBetween($this->periodStart, $inWindowEnd),
            ];
        }

        foreach ($outChunks as $qty) {
            $events[] = [
                'type' => 'out',
                'qty' => $qty,
                'at' => $this->biasedSaleDate($outWindowStart, $this->periodEnd),
            ];
        }

        if (random_int(1, 100) <= 12 && $target > 0) {
            $adj = min($target, random_int(1, max(2, (int) ($target * 0.05))));
            $events[] = [
                'type' => 'adjustment',
                'qty' => $adj,
                'at' => $this->randomDateTimeBetween($outWindowStart, $this->periodEnd),
            ];
        }

        $typeOrder = ['in' => 0, 'out' => 1, 'adjustment' => 2];
        usort($events, function (array $a, array $b) use ($typeOrder): int {
            $t = $a['at']->getTimestamp() <=> $b['at']->getTimestamp();

            return $t !== 0 ? $t : ($typeOrder[$a['type']] <=> $typeOrder[$b['type']]);
        });

        $balance = 0;
        $rows = [];

        foreach ($events as $ev) {
            $before = $balance;

            if ($ev['type'] === 'in') {
                $balance += $ev['qty'];
                $after = $balance;
                $rows[] = $this->makeRow(
                    $stock,
                    'in',
                    $ev['qty'],
                    $before,
                    $after,
                    $ev['at'],
                    $this->descriptionIn($providerIds),
                    $providerIds[array_rand($providerIds)],
                    $userIds
                );
            } elseif ($ev['type'] === 'out') {
                $qty = $ev['qty'];
                if ($qty > $balance) {
                    $qty = $balance;
                }
                if ($qty < 1) {
                    continue;
                }
                $balance -= $qty;
                $after = $balance;
                $rows[] = $this->makeRow(
                    $stock,
                    'out',
                    $qty,
                    $before,
                    $after,
                    $ev['at'],
                    $this->descriptionOut(),
                    null,
                    $userIds
                );
            } else {
                $qty = min($ev['qty'], $before);
                if ($qty < 1) {
                    continue;
                }
                $balance -= $qty;
                $after = $balance;
                $rows[] = $this->makeRow(
                    $stock,
                    'adjustment',
                    $qty,
                    $before,
                    $after,
                    $ev['at'],
                    'Ajuste de inventário / divergência contagem',
                    null,
                    $userIds
                );
            }
        }

        $diff = $target - $balance;
        if ($diff !== 0) {
            $fixAt = $this->randomDateTimeBetween($this->periodStart, $this->periodEnd);
            $before = $balance;
            if ($diff > 0) {
                $balance += $diff;
                $rows[] = $this->makeRow(
                    $stock,
                    'in',
                    $diff,
                    $before,
                    $balance,
                    $fixAt,
                    'Ajuste final de saldo (seed) / conferência',
                    $providerIds[array_rand($providerIds)],
                    $userIds
                );
            } else {
                $out = min($before, -$diff);
                if ($out > 0) {
                    $balance -= $out;
                    $rows[] = $this->makeRow(
                        $stock,
                        'out',
                        $out,
                        $before,
                        $balance,
                        $fixAt,
                        'Ajuste final de saldo (seed) / saída corretiva',
                        null,
                        $userIds
                    );
                }
            }
        }

        return $rows;
    }

    private function makeRow(
        object $stock,
        string $type,
        int $qtyMoved,
        int $before,
        int $after,
        Carbon $at,
        string $description,
        ?int $providerId,
        array $userIds
    ): array {
        $formatted = $at->format('Y-m-d H:i:s');

        return [
            'uniqueid' => (string) Str::uuid(),
            'product_id' => $stock->product_id,
            'location_id' => $stock->location_id,
            'provider_id' => $providerId,
            'type' => $type,
            'quantity_moved' => $qtyMoved,
            'quantity_before' => $before,
            'quantity_after' => $after,
            'description' => $description,
            'movement_date' => $formatted,
            'created_by' => $userIds[array_rand($userIds)],
            'created_at' => $formatted,
            'updated_at' => $formatted,
        ];
    }

    private function descriptionIn(array $providerIds): string
    {
        $nf = random_int(10000, 99999);

        return fake()->randomElement([
            "Compra NF-e nº {$nf} — entrada regular",
            "Reposição estoque — NF {$nf}",
            "Importação lote — DI anexa NF {$nf}",
            "Devolução de fornecedor aprovada — NF {$nf}",
            "Bonificação — NF complementar {$nf}",
        ]);
    }

    private function descriptionOut(): string
    {
        $p = random_int(8000, 99999);

        return fake()->randomElement([
            "Venda PDV — cupom {$p}",
            "Pedido B2B #{$p} — faturado",
            "Venda e-commerce — pedido {$p}",
            "Retirada balcão — OS {$p}",
            "Venda representante — pedido {$p}",
            "Consumo interno / projeto — req. {$p}",
            "Amostra para cliente — {$p}",
        ]);
    }

    private function randomDateTimeBetween(Carbon $from, Carbon $to): Carbon
    {
        if ($from->greaterThanOrEqualTo($to)) {
            return $from->copy();
        }

        $min = $from->getTimestamp();
        $max = $to->getTimestamp();

        return Carbon::createFromTimestamp(random_int($min, $max));
    }

    private function biasedSaleDate(Carbon $from, Carbon $to): Carbon
    {
        if (random_int(1, 100) <= 38) {
            $bfStart = $this->periodStart->copy()->addMonths(10);
            if ($bfStart->lessThan($to) && $bfStart->greaterThan($from)) {
                return $this->randomDateTimeBetween(max($from, $bfStart), $to);
            }
        }

        return $this->randomDateTimeBetween($from, $to);
    }

    /**
     * @return list<int>
     */
    private function partitionInteger(int $sum, int $parts): array
    {
        $parts = max(1, $parts);
        if ($sum < 1) {
            return [];
        }
        $parts = min($parts, $sum);

        $result = [];
        $remaining = $sum;
        for ($i = 0; $i < $parts - 1; $i++) {
            $max = $remaining - ($parts - $i - 1);
            if ($max < 1) {
                break;
            }
            $x = random_int(1, $max);
            $result[] = $x;
            $remaining -= $x;
        }
        if ($remaining > 0) {
            $result[] = $remaining;
        }

        return $result;
    }
}
