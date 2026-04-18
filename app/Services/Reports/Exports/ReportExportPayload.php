<?php

namespace App\Services\Reports\Exports;

/**
 * Estrutura genérica que descreve um relatório a ser exportado.
 *
 * Mantém num único objeto tudo que CSV e PDF precisam saber:
 * título, subtítulo, filtros aplicados (mostrados no PDF),
 * colunas (cabeçalho + formatador) e as linhas brutas.
 */
class ReportExportPayload
{
    /**
     * @param string                            $title       Título principal do relatório.
     * @param string                            $subtitle    Subtítulo (ex.: "Período: 01/01/2025 a 31/01/2025").
     * @param array<string, string>             $filterLines Pares "Rótulo" => "Valor" mostrados no cabeçalho do PDF.
     * @param array<int, ReportExportColumn>    $columns     Colunas que serão exportadas, na ordem desejada.
     * @param iterable<int, mixed>              $rows        Linhas brutas (objetos/arrays) que cada coluna vai formatar.
     * @param string                            $fileNameBase Nome do ficheiro sem extensão (ex.: "relatorio-entrada-saida").
     */
    public function __construct(
        public readonly string $title,
        public readonly string $subtitle,
        public readonly array  $filterLines,
        public readonly array  $columns,
        public readonly iterable $rows,
        public readonly string $fileNameBase,
    ) {}
}
