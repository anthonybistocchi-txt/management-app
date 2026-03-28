<!DOCTYPE html>
<html lang="pt-BR">
@vite(['resources/ts/pages/index/stock-card.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Ficha de estoque</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        #img-sidebar-logo {
            width: 50%;
            height: 50%;
            border-radius: 8px;
        }
    </style>
</head>

<body class="font-display">
    <div class="relative flex h-screen min-h-screen w-full flex-col bg-background-light dark:bg-background-dark text-[#0d141b] dark:text-slate-200">
        <div class="flex h-full w-full">

            @include('partials.sidebar-main', ['active' => 'reportStockCard'])

            <div class="flex flex-1 flex-col overflow-y-auto">
                @include('partials.header-user')

                <main class="flex-1 p-8">
                    <div class="mx-auto max-w-6xl flex flex-col gap-6">
                        <header class="flex flex-wrap items-start justify-between gap-4">
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                                    <a href="{{ route('products') }}" class="hover:text-primary">Produtos</a>
                                    <span class="material-symbols-outlined text-base">chevron_right</span>
                                    <span class="text-slate-600 dark:text-slate-300">Ficha de estoque</span>
                                </div>
                                <div class="flex flex-wrap items-center gap-3">
                                    <h1 class="text-3xl font-bold tracking-tight text-[#0d141b] dark:text-slate-100">Ficha de estoque</h1>
                                    <span class="rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold text-primary">SKU: PROD-001</span>
                                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">Ativo</span>
                                </div>
                                <p class="text-base text-[#4c739a] dark:text-slate-400">
                                    Aqui voce acompanha toda a ficha de estoque: entradas, saidas e ajustes manuais.
                                </p>
                            </div>
                            <div class="flex flex-col items-end gap-3">
                                <div class="flex items-center gap-2">
                                    <details class="relative">
                                    <summary
                                        class="flex cursor-pointer items-center justify-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-600 shadow-sm hover:bg-slate-50 [&::-webkit-details-marker]:hidden">
                                        <span class="material-symbols-outlined text-base">download</span>
                                        Download
                                        <span class="material-symbols-outlined text-base">expand_more</span>
                                    </summary>
                                    <div
                                        class="absolute right-0 z-10 mt-2 w-36 rounded-lg border border-slate-200 bg-white py-1 text-sm shadow-lg">
                                        <a href="#" class="block px-3 py-2 text-slate-600 hover:bg-slate-50">CSV</a>
                                        <a href="#" class="block px-3 py-2 text-slate-600 hover:bg-slate-50">PDF</a>
                                    </div>
                                    </details>
                                    <button
                                        class="flex items-center justify-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary/90">
                                        <span class="material-symbols-outlined text-base">edit</span>
                                        Editar produto
                                    </button>
                                </div>
                                <div class="mt-5 relative w-50">
                                    <label class="mb-1 block text-xs font-medium text-[#4c739a] dark:text-slate-600">Periodo</label>
                                    <div class="relative">
                                        <span class="material-symbols-outlined absolute left-2.5 top-2.5 text-[#4c739a] text-lg">calendar_month</span>
                                        <input type="text" placeholder="Selecione o periodo"
                                            class="form-input h-10 w-full rounded-lg border border-[#cfdbe7] bg-[#F4F7FA] text-[#0d141b] dark:text-slate-600 placeholder:text-[#94a3b8] dark:placeholder:text-slate-500 pl-9 pr-2 text-xs xl:text-sm font-normal cursor-pointer" />
                                    </div>
                                </div>
                            </div>
                        </header>

                        <section class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
                            <div class="rounded-xl bg-white p-4 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-slate-500">Saldo atual</p>
                                    <span class="material-symbols-outlined text-primary">inventory_2</span>
                                </div>
                                <p class="mt-2 text-2xl font-bold">128</p>
                                <p class="text-xs text-slate-400">Ultima atualizacao: hoje 10:15</p>
                            </div>
                            <div class="rounded-xl bg-white p-4 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-slate-500">Entradas</p>
                                    <span class="material-symbols-outlined text-emerald-600">south_west</span>
                                </div>
                                <p class="mt-2 text-2xl font-bold text-emerald-600">+540</p>
                                <p class="text-xs text-slate-400">Ultimos 90 dias</p>
                            </div>
                            <div class="rounded-xl bg-white p-4 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-slate-500">Saidas</p>
                                    <span class="material-symbols-outlined text-rose-600">north_east</span>
                                </div>
                                <p class="mt-2 text-2xl font-bold text-rose-600">-412</p>
                                <p class="text-xs text-slate-400">Ultimos 90 dias</p>
                            </div>
                            <div class="rounded-xl bg-white p-4 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-slate-500">Ajustes manuais</p>
                                    <span class="material-symbols-outlined text-amber-600">tune</span>
                                </div>
                                <p class="mt-2 text-2xl font-bold text-amber-600">+6</p>
                                <p class="text-xs text-slate-400">3 ajustes no mes</p>
                            </div>
                        </section>

                        <section class="grid grid-cols-1 gap-6 xl:grid-cols-3">
                            <div class="xl:col-span-2 rounded-xl bg-white p-4 shadow-sm">
                                <div class="flex flex-wrap items-center justify-between gap-3">
                                    <div>
                                        <h2 class="text-lg font-bold">Linha do tempo</h2>
                                        <p class="text-sm text-slate-500">Historico completo de movimentacoes.</p>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <div class="relative">
                                            <span
                                                class="material-symbols-outlined absolute left-2.5 top-2.5 text-slate-500 text-lg">calendar_month</span>
                                            <input type="text" placeholder="Periodo"
                                                class="form-input h-10 w-40 rounded-lg border border-slate-200 bg-slate-50 pl-9 pr-2 text-sm" />
                                        </div>
                                        <select class="h-10 rounded-lg border border-slate-200 bg-slate-50 px-3 text-sm">
                                            <option>Todos os tipos</option>
                                            <option>Entrada</option>
                                            <option>Saida</option>
                                            <option>Ajuste</option>
                                        </select>
                                        <button
                                            class="flex h-10 items-center justify-center gap-2 rounded-lg bg-primary px-4 text-sm font-semibold text-white">
                                            <span class="material-symbols-outlined text-base">search</span>
                                            Buscar
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-4 overflow-x-auto">
                                    <table class="min-w-full text-sm">
                                        <thead class="bg-slate-50">
                                            <tr>
                                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Data</th>
                                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Tipo</th>
                                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Quantidade</th>
                                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Documento</th>
                                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Origem/Destino</th>
                                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Responsavel</th>
                                                <th class="px-4 py-3 text-left font-semibold text-slate-600">Observacoes</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100">
                                            <tr>
                                                <td class="px-4 py-3 text-slate-600">28/03/2026 09:18</td>
                                                <td class="px-4 py-3">
                                                    <span class="rounded-full bg-emerald-100 px-2 py-1 text-xs font-semibold text-emerald-700">Entrada</span>
                                                </td>
                                                <td class="px-4 py-3 text-emerald-600 font-semibold">+80</td>
                                                <td class="px-4 py-3">NF 4532</td>
                                                <td class="px-4 py-3">Fornecedor NovaTech</td>
                                                <td class="px-4 py-3">Carlos Lima</td>
                                                <td class="px-4 py-3">Reposicao mensal</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-3 text-slate-600">27/03/2026 16:40</td>
                                                <td class="px-4 py-3">
                                                    <span class="rounded-full bg-rose-100 px-2 py-1 text-xs font-semibold text-rose-700">Saida</span>
                                                </td>
                                                <td class="px-4 py-3 text-rose-600 font-semibold">-12</td>
                                                <td class="px-4 py-3">Venda #8934</td>
                                                <td class="px-4 py-3">Cliente Aline Souza</td>
                                                <td class="px-4 py-3">Marina Lopes</td>
                                                <td class="px-4 py-3">Entrega expressa</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-3 text-slate-600">26/03/2026 11:05</td>
                                                <td class="px-4 py-3">
                                                    <span class="rounded-full bg-amber-100 px-2 py-1 text-xs font-semibold text-amber-700">Ajuste</span>
                                                </td>
                                                <td class="px-4 py-3 text-amber-600 font-semibold">+4</td>
                                                <td class="px-4 py-3">Inventario #22</td>
                                                <td class="px-4 py-3">Correcao manual</td>
                                                <td class="px-4 py-3">Rafaela Nunes</td>
                                                <td class="px-4 py-3">Contagem fisica</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 py-3 text-slate-600">25/03/2026 13:20</td>
                                                <td class="px-4 py-3">
                                                    <span class="rounded-full bg-rose-100 px-2 py-1 text-xs font-semibold text-rose-700">Saida</span>
                                                </td>
                                                <td class="px-4 py-3 text-rose-600 font-semibold">-36</td>
                                                <td class="px-4 py-3">Venda #8877</td>
                                                <td class="px-4 py-3">Cliente Marco Dias</td>
                                                <td class="px-4 py-3">Beatriz Alves</td>
                                                <td class="px-4 py-3">Retirada na loja</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="flex flex-col gap-6">
                                <div class="rounded-xl bg-white p-4 shadow-sm">
                                    <h2 class="text-lg font-bold">Detalhes do produto</h2>
                                    <div class="mt-4 space-y-3 text-sm text-slate-600">
                                        <div class="flex items-center justify-between">
                                            <span>Categoria</span>
                                            <span class="font-semibold text-slate-700">Informatica</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span>Fornecedor principal</span>
                                            <span class="font-semibold text-slate-700">NovaTech</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span>Estoque minimo</span>
                                            <span class="font-semibold text-slate-700">40</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span>Ultima venda</span>
                                            <span class="font-semibold text-slate-700">27/03/2026</span>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <span>Ultima entrada</span>
                                            <span class="font-semibold text-slate-700">28/03/2026</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="rounded-xl bg-white p-4 shadow-sm">
                                    <h2 class="text-lg font-bold">Alertas</h2>
                                    <div class="mt-4 space-y-3">
                                        <div class="rounded-lg border border-amber-200 bg-amber-50 p-3 text-sm text-amber-700">
                                            Estoque abaixo do ideal em 2 filiais. Reposicao recomendada.
                                        </div>
                                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3 text-sm text-slate-600">
                                            3 ajustes manuais no ultimo mes. Revise as contagens fisicas.
                                        </div>
                                    </div>
                                </div>

                                <div class="rounded-xl bg-white p-4 shadow-sm">
                                    <h2 class="text-lg font-bold">Origem e saida</h2>
                                    <div class="mt-4 space-y-4 text-sm">
                                        <div class="flex items-start gap-3">
                                            <span class="material-symbols-outlined text-emerald-600">south_west</span>
                                            <div>
                                                <p class="font-semibold text-slate-700">Fornecedor</p>
                                                <p class="text-slate-500">NovaTech, NF 4532, 28/03/2026</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-3">
                                            <span class="material-symbols-outlined text-rose-600">north_east</span>
                                            <div>
                                                <p class="font-semibold text-slate-700">Ultima venda</p>
                                                <p class="text-slate-500">Venda #8934, cliente Aline Souza</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-3">
                                            <span class="material-symbols-outlined text-amber-600">tune</span>
                                            <div>
                                                <p class="font-semibold text-slate-700">Ajuste</p>
                                                <p class="text-slate-500">Inventario #22, 26/03/2026</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </main>

                @include('partials.footer-main')
            </div>
        </div>
    </div>
</body>

</html>
