<?php

namespace App\Services\Reports\Exports;

use Closure;

/**
 * Definição declarativa de uma coluna usada nas exportações
 * (CSV/PDF) dos relatórios.
 *
 * - $label        : cabeçalho mostrado no CSV/PDF
 * - $resolve      : closure que recebe a linha bruta e devolve o valor
 *                   já formatado em string (com locale, máscara, etc.)
 * - $align        : alinhamento usado apenas no PDF ("left"|"right"|"center")
 * - $widthPercent : largura preferida desta coluna no PDF, em percentagem
 *                   da largura disponível (ex.: 25 para 25%). Quando não
 *                   for indicada, o DomPDF distribui automaticamente —
 *                   mas em tabelas largas convém fornecer sempre, para
 *                   evitar que o algoritmo "auto" arrebente o layout.
 */
class ReportExportColumn
{
    public function __construct(
        public readonly string  $label,
        public readonly Closure $resolve,
        public readonly string  $align        = 'left',
        public readonly ?int    $widthPercent = null,
    ) {}

    public function format(mixed $row): string
    {
        $value = ($this->resolve)($row);

        return $value === null ? '' : (string) $value;
    }
}
