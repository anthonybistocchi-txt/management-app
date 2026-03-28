<!DOCTYPE html>
<html class="light" lang="pt-BR">
@vite(['resources/ts/pages/admin/dashboard.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard</title>
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

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 mb-8">
                    <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark">
                        <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium">Total de vendas</p>
                        <p id="total_sales" class="text-text-light-primary dark:text-text-dark-primary text-3xl font-bold"></p>
                    </div>

                    <div class="flex flex-col gap-2 rounded-xl p-6 bg-white dark:bg-surface-dark border border-border-light dark:border-border-dark">
                        <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium">Produto mais vendido</p>
                        <p id="top_selling_product" class="text-text-light-primary dark:text-text-dark-primary text-3xl font-bold"></p>
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
                    <h3 class="text-lg font-semibold dark:text-text-dark-primary mb-6">Vendas por categorias</h3>
                    <div class="flex flex-col md:flex-row items-center gap-6 h-full">
                        <div class="relative w-full md:w-5/12 h-64 flex justify-center items-center">
                            <canvas id="sales_category_chart"></canvas>
                        </div>
                        <div id="sales_category_legend" class="w-full md:w-7/12 grid grid-cols-1 sm:grid-cols-2 gap-4 content-center">
                        </div>
                    </div>
                </div>

            </main>

            @include('partials.footer-main')
        </div>
    </div>
</body>
</html>