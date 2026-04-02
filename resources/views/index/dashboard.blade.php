<!DOCTYPE html>
<html class="light" lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    @vite(['resources/ts/pages/admin/dashboard.ts'])
    @vite(['resources/ts/app.ts', 'resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #img-sidebar-logo {
            width: 50%;
            height: 50%;
            border-radius: 8px;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-text-light-primary dark:text-text-dark-primary">
    <div class="flex h-screen overflow-hidden w-full">
        @include('partials.sidebar-main', ['active' => 'dashboard'])

        <div class="flex flex-col flex-1 overflow-y-auto min-h-0">
            
            @include('partials.header-user', ['withBorder' => false, 'textAlignRight' => true])

            <main class="flex-1 p-8">
                
                <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                    <h2 class="text-text-light-primary dark:text-text-dark-primary text-3xl font-bold leading-tight tracking-tight">
                        Dashboard vendas
                    </h2>

                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <div class="relative flex-1 sm:flex-none">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500 z-10">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="date_range_picker" type="text" placeholder="Selecione uma data"
                                class="flex h-9 w-full sm:w-64 items-center rounded-lg bg-background-light-primary dark:bg-surface-dark border border-border-light dark:border-border-dark pl-10 pr-4 text-sm font-medium text-text-light-primary dark:text-text-dark-primary hover:border-primary focus:outline-none focus:ring-1 focus:ring-primary cursor-pointer">
                        </div>

                        <button id="btn_submit" type="button"
                            class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-primary text-white px-4 text-sm font-semibold hover:bg-primary/90 transition-colors shadow-sm">
                            <span class="material-symbols-outlined text-[20px]">filter_list</span>
                            <span>Pesquisar</span>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark">
                        <div class="flex items-center justify-between gap-3">
                            <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium">Total de vendas</p>
                            <span id="total_sales_growth" class="inline-flex items-center gap-1 rounded-full bg-green-100 text-green-700 px-2.5 py-1 text-xs font-semibold">
                                <span class="material-symbols-outlined text-[16px]">north_east</span>
                                +0% vs. periodo anterior
                            </span>
                        </div>
                        <p id="total_sales" class="text-text-light-primary dark:text-text-dark-primary text-3xl font-bold"></p>
                    </div>

                    <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark">
                        <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium">Produto mais vendido</p>
                        <p id="top_selling_product" class="text-text-light-primary dark:text-text-dark-primary text-3xl font-bold"></p>
                    </div>

                    <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark">
                        <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium">Ticket medio</p>
                        <p id="average_ticket" class="text-text-light-primary dark:text-text-dark-primary text-3xl font-bold"></p>
                        <p class="text-text-light-secondary dark:text-text-dark-secondary text-xs">Total dividido pela quantidade de vendas</p>
                    </div>

                    <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark">
                        <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium">Quantidade total de pedidos</p>
                        <p id="total_orders" class="text-text-light-primary dark:text-text-dark-primary text-3xl font-bold"></p>
                    </div>
                </div>

                <div class="lg:col-span-2 flex flex-col rounded-xl p-6 bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark mb-5">
                    <div class="w-full">
                        <div class="flex flex-wrap items-center justify-between gap-3 mb-2">
                            <h3 class="text-lg dark:text-text-dark-primary">Vendas</h3>
                            <div class="flex items-center rounded-lg bg-slate-100 p-1 text-sm" id="sales-metric-toggle">
                                <button type="button" data-metric="revenue"
                                    class="rounded-md px-3 py-1.5 font-semibold transition-colors">
                                    Faturamento
                                </button>
                                <button type="button" data-metric="volume"
                                    class="rounded-md px-3 py-1.5 font-semibold transition-colors">
                                    Volume de vendas
                                </button>
                            </div>
                        </div>
                        <div class="relative w-full h-64">
                            <canvas id="moviments_sales_chart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 flex flex-col rounded-xl p-6 bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold dark:text-text-dark-primary">Vendas por categorias</h3>
                        <p class="mt-1 text-xs text-text-light-secondary dark:text-text-dark-secondary">Gráfico com as maiores categorias; a tabela abaixo lista todas com rolagem.</p>
                    </div>
                    <div id="sales_category_chart_wrap" class="relative w-full rounded-lg border border-border-light/80 dark:border-border-dark/80 bg-slate-50/50 dark:bg-slate-900/20 p-2">
                        <div class="relative h-[380px] w-full">
                            <canvas id="sales_category_chart"></canvas>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h4 class="text-sm font-semibold text-text-light-primary dark:text-text-dark-primary mb-2">Todas as categorias</h4>
                        <div class="max-h-72 overflow-y-auto rounded-lg border border-border-light dark:border-border-dark">
                            <table class="w-full text-sm">
                                <thead class="sticky top-0 z-10 bg-slate-100 dark:bg-slate-800/95 border-b border-border-light dark:border-border-dark">
                                    <tr class="text-left text-text-light-secondary dark:text-text-dark-secondary">
                                        <th class="px-3 py-2 font-medium">Categoria</th>
                                        <th class="px-3 py-2 font-medium text-right">Volume</th>
                                        <th class="px-3 py-2 font-medium text-right">%</th>
                                        <th class="px-3 py-2 font-medium text-right">Faturamento</th>
                                    </tr>
                                </thead>
                                <tbody id="sales_category_table_body" class="divide-y divide-border-light dark:divide-border-dark">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
                    <div class="flex flex-col rounded-xl p-6 bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold dark:text-text-dark-primary">Top 5 produtos</h3>
                            <span class="text-xs text-text-light-secondary dark:text-text-dark-secondary">Por faturamento</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="text-left text-text-light-secondary dark:text-text-dark-secondary">
                                        <th class="pb-2">#</th>
                                        <th class="pb-2">Produto</th>
                                        <th class="pb-2 text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="top_products_table">
                                    <tr>
                                        <td colspan="3" class="py-4 text-center text-sm text-text-light-secondary dark:text-text-dark-secondary">Carregando...</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex flex-col rounded-xl p-6 bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold dark:text-text-dark-primary">Vendas recentes</h3>
                            <span class="text-xs text-text-light-secondary dark:text-text-dark-secondary">Live feed</span>
                        </div>
                        <div id="recent_sales_list" class="flex flex-col gap-3">
                            <div class="text-sm text-text-light-secondary dark:text-text-dark-secondary">Carregando...</div>
                        </div>
                    </div>

                    <div id="low_stock_alert" class="flex flex-col rounded-xl p-6 border border-amber-200 bg-amber-50 text-amber-700">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <h3 class="text-lg font-semibold">Alertas de estoque</h3>
                                <p class="mt-1 text-xs opacity-90">Estoque atual; não usa o período do filtro acima.</p>
                            </div>
                            <span class="material-symbols-outlined shrink-0">warning</span>
                        </div>
                        <p class="text-3xl font-bold"><span id="low_stock_count">0</span></p>
                        <p id="low_stock_message" class="text-sm">Nenhum produto abaixo do minimo.</p>
                    </div>
                </div>

            </main>

            @include('partials.footer-main')
        </div>
    </div>
</body>
</html>