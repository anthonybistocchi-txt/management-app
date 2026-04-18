<?php

namespace App\Services\Reports\Exports;

use Carbon\Carbon;
use Throwable;

/**
 * Helpers de formatação usados pelas exportações dos relatórios
 * para garantir que CSV e PDF apresentem os dados de forma idêntica
 * à aplicação web (datas pt-BR, preços em centavos, etc.).
 */
class ReportFormatter
{
    /** Converte preço guardado em centavos para "R$ 1.234,56". */
    public static function priceFromCents(int|float|string|null $cents): string
    {
        $value = (float) ($cents ?? 0) / 100;

        return 'R$ ' . number_format($value, 2, ',', '.');
    }

    /** Converte uma data ISO/datetime para "dd/mm/yyyy HH:MM". Aceita null. */
    public static function dateTime(?string $value): string
    {
        if ($value === null || $value === '') {
            return '';
        }

        try {
            return Carbon::parse($value)->format('d/m/Y H:i');
        } catch (Throwable) {
            return $value;
        }
    }

    /** Converte uma data ISO para "dd/mm/yyyy". Aceita null. */
    public static function date(?string $value): string
    {
        if ($value === null || $value === '') {
            return '';
        }

        try {
            return Carbon::parse($value)->format('d/m/Y');
        } catch (Throwable) {
            return $value;
        }
    }

    /** Converte o tipo de movimentação técnico ("in"/"out"/"transfer") em rótulo pt-BR. */
    public static function movementType(?string $type): string
    {
        return match (strtolower((string) $type)) {
            'in'       => 'Entrada',
            'out'      => 'Saída',
            'transfer' => 'Transferência',
            default    => $type ?? '',
        };
    }

    /** Devolve o valor recebido se não for vazio; caso contrário, devolve "—". */
    public static function orDash(mixed $value): string
    {
        $string = trim((string) ($value ?? ''));

        return $string === '' ? '—' : $string;
    }

    /**
     * Monta o subtítulo de período no formato "Período: dd/mm/yyyy a dd/mm/yyyy".
     * Aceita strings vazias e devolve "Período: Todos" quando ambos vazios.
     */
    public static function periodSubtitle(?string $dateFrom, ?string $dateTo): string
    {
        $from = self::date($dateFrom);
        $to   = self::date($dateTo);

        if ($from === '' && $to === '') {
            return 'Período: todos os registos';
        }

        return sprintf('Período: %s a %s', $from ?: '—', $to ?: '—');
    }
}
