<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>{{ $payload->title }}</title>
    <style>
        @page { margin: 110px 28px 60px 28px; }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #1f2937;
            margin: 0;
        }

        /* ---------- Header (fixed on every page) ---------- */
        header {
            position: fixed;
            top: -90px;
            left: 0;
            right: 0;
            height: 90px;
            padding: 12px 4px 8px 4px;
        }

        .brand {
            float: left;
            width: 60%;
        }

        .brand .pill {
            display: inline-block;
            background: #1d4ed8;
            color: #fff;
            font-weight: bold;
            letter-spacing: 1px;
            font-size: 9px;
            padding: 4px 8px;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .brand h1 {
            margin: 6px 0 2px 0;
            font-size: 18px;
            color: #0f172a;
        }

        .brand .subtitle {
            color: #475569;
            font-size: 10px;
        }

        .meta {
            float: right;
            width: 38%;
            text-align: right;
            font-size: 9px;
            color: #475569;
            line-height: 1.5;
        }

        .meta strong { color: #0f172a; }

        /* ---------- Footer (fixed on every page) ---------- */
        footer {
            position: fixed;
            bottom: -40px;
            left: 0;
            right: 0;
            height: 40px;
            border-top: 1px solid #e2e8f0;
            padding-top: 8px;
            font-size: 9px;
            color: #64748b;
        }

        footer .left  { float: left;  }
        footer .right { float: right; }

        .pageNumber:before { content: counter(page); }
        .pageTotal:before  { content: counter(pages); }

        /* ---------- Filter strip ----------
           Layout compacto em grelha de 3 colunas usando uma `<table>`
           porque o DomPDF não suporta CSS grid. Cada célula da grelha
           contém um par "label / valor" com largura fixa, evitando o
           wrap descontrolado de labels longos como "TIPO DE
           MOVIMENTAÇÃO" — que com o layout antigo (label 14% + value 86%)
           rebentava cada linha em várias páginas. */
        .filters {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 8px 10px;
            margin-bottom: 12px;
        }

        .filters table.filters-grid {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .filters table.filters-grid td {
            width: 33.33%;
            padding: 4px 8px;
            vertical-align: top;
            font-size: 9px;
            color: #1f2937;
        }
        .filters .filter-label {
            display: block;
            color: #475569;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            font-size: 8px;
            margin-bottom: 1px;
        }
        .filters .filter-value {
            display: block;
            color: #0f172a;
        }

        /* ---------- Data table ----------
           Optimizações cruciais para o DomPDF aguentar relatórios com
           muitas linhas:
           - `border-collapse: separate` (com spacing 0) → desliga a
             resolução quadrática de conflitos de border que faz o
             `Cellmap` consumir gigabytes em tabelas grandes;
           - sem borders por célula — usamos zebra striping via classes
             explícitas (`odd`/`even`), mais barato e mais previsível
             que `nth-child` no DomPDF.
           Nota: NÃO usamos `table-layout: fixed` porque o DomPDF
           não respeita bem `word-wrap` em layout fixo sem `<colgroup>`
           explícito, fazendo cada linha quebrar para uma página nova. */
        table.data {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        table.data thead th {
            background: #1d4ed8;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 9px;
            padding: 8px 6px;
        }

        table.data tbody td {
            padding: 6px 6px;
            vertical-align: top;
            word-wrap: break-word;
        }

        /* Cada "chunk" de linhas é renderizado numa tabela própria;
           a partir do segundo chunk forçamos uma quebra de página
           para evitar o bug conhecido do DomPDF que descarrila a
           paginação quando uma única tabela transborda múltiplas
           páginas (acaba colocando 1 linha por página). */
        .data-chunk + .data-chunk { page-break-before: always; }

        /* Zebra leve para legibilidade — mais barato que borders. */
        table.data tbody tr.odd  td { background: #ffffff; }
        table.data tbody tr.even td { background: #f1f5f9; }

        /* Alinhamento por coluna — selectores compostos ficam mais
           específicos do que `table.data thead th` e ganham sempre,
           garantindo que o cabeçalho fica alinhado com os valores. */
        table.data thead th.text-left,
        table.data tbody td.text-left   { text-align: left;   }

        table.data thead th.text-right,
        table.data tbody td.text-right  { text-align: right;  }

        table.data thead th.text-center,
        table.data tbody td.text-center { text-align: center; }

        .empty {
            text-align: center;
            color: #64748b;
            padding: 28px;
            font-style: italic;
        }

        /* ---------- Aviso de truncagem ---------- */
        .truncation-notice {
            margin: 0 0 10px 0;
            padding: 8px 12px;
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 6px;
            color: #78350f;
            font-size: 10px;
            line-height: 1.4;
        }

        .truncation-notice strong { color: #7c2d12; }
    </style>
</head>
<body>

    <header>
        <div class="brand">
            <span class="pill">Relatório</span>
            <h1>{{ $payload->title }}</h1>
            <div class="subtitle">{{ $payload->subtitle }}</div>
        </div>
        <div class="meta">
            <strong>Gerado em</strong><br />
            {{ $generatedAt }}<br />
            <em>Sistema de Gestão de Estoque</em>
        </div>
    </header>

    <footer>
        <div class="left">{{ $payload->title }}</div>
        <div class="right">
            Página <span class="pageNumber"></span> de <span class="pageTotal"></span>
        </div>
    </footer>

    <main>
        @if (!empty($payload->filterLines))
            @php
                /* Distribui os filtros por uma grelha de 3 colunas para
                   um layout compacto e previsível dentro do DomPDF. */
                $filterEntries = collect($payload->filterLines)
                    ->map(fn ($value, $label) => ['label' => $label, 'value' => $value])
                    ->values();
                $filterRows = $filterEntries->chunk(3);
            @endphp
            <div class="filters">
                <table class="filters-grid">
                    @foreach ($filterRows as $row)
                        <tr>
                            @foreach ($row as $entry)
                                <td>
                                    <span class="filter-label">{{ $entry['label'] }}</span>
                                    <span class="filter-value">{{ $entry['value'] }}</span>
                                </td>
                            @endforeach
                            @for ($i = $row->count(); $i < 3; $i++)
                                <td></td>
                            @endfor
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif

        @if ($isTruncated)
            <div class="truncation-notice">
                <strong>Atenção:</strong> a tabela foi limitada às primeiras
                {{ number_format($pdfMaxRows, 0, ',', '.') }} linhas para manter
                o PDF legível. O resultado completo dos filtros tem
                {{ number_format($totalRows, 0, ',', '.') }} registos —
                use a exportação <strong>CSV</strong> para o conjunto integral.
            </div>
        @endif

        @php
            /* Quantidade de linhas por chunk — calculada para caber numa
               página A4 paisagem com as nossas margens (425pt úteis,
               linha ~16pt incluindo padding). 18 deixa folga para
               descrições que envolvam para 2 linhas. */
            $rowsPerChunk = 18;
            $chunks       = $rows->chunk($rowsPerChunk);
            $hasColWidths = collect($payload->columns)->contains(fn ($c) => $c->widthPercent !== null);
            $colsCount    = count($payload->columns);
        @endphp

        @if ($rows->isEmpty())
            <table class="data">
                <thead>
                    <tr>
                        @foreach ($payload->columns as $column)
                            <th class="text-{{ $column->align }}">{{ $column->label }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="empty" colspan="{{ $colsCount }}">
                            Nenhum registo encontrado para os filtros selecionados.
                        </td>
                    </tr>
                </tbody>
            </table>
        @else
            @foreach ($chunks as $chunkIndex => $chunkRows)
                <div class="data-chunk">
                    <table class="data">
                        @if ($hasColWidths)
                            <colgroup>
                                @foreach ($payload->columns as $column)
                                    @if ($column->widthPercent !== null)
                                        <col style="width: {{ $column->widthPercent }}%;" />
                                    @else
                                        <col />
                                    @endif
                                @endforeach
                            </colgroup>
                        @endif
                        <thead>
                            <tr>
                                @foreach ($payload->columns as $column)
                                    <th class="text-{{ $column->align }}">{{ $column->label }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chunkRows as $rowIndex => $row)
                                @php $absoluteIndex = $chunkIndex * $rowsPerChunk + $loop->index; @endphp
                                <tr class="{{ $absoluteIndex % 2 === 0 ? 'odd' : 'even' }}">
                                    @foreach ($payload->columns as $column)
                                        <td class="text-{{ $column->align }}">{{ $column->format($row) }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        @endif
    </main>

</body>
</html>
