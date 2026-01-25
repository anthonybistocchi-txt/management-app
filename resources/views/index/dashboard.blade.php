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
        #logo {
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
    <div class="flex h-screen overflow-hidden"> <aside class="flex flex-col w-64 bg-surface-blue text-text-white p-4 justify-between h-full">
            <div>
                <div class="flex items-center justify-center px-2 mb-8">
                    <div class="p-2 rounded-xl w-full shadow-sm flex items-center justify-center">
                        <img id="logo" src="/images/logo.jpg" alt="Logo Empresa" class="h-12 w-auto object-contain max-w-full">
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/10 text-primary">
                        <span class="material-symbols-outlined">dashboard</span>
                        <p class="text-sm font-semibold">Dashboard</p>
                    </a>
                    <a href="{{ route('stock') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary">
                        <span class="material-symbols-outlined">inventory_2</span>
                        <p class="text-sm font-medium">Registrar entrada</p>
                    </a>
                    <a href="{{ route('users') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary">
                        <span class="material-symbols-outlined">group</span>
                        <p class="text-sm font-medium">Operadores</p>
                    </a>
                    <a href="{{ route('stockOut') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary">
                        <span class="material-symbols-outlined">inventory_2</span>
                        <p class="text-sm font-medium">Registrar venda</p>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3 py-2.5 opacity-50 cursor-not-allowed">
                        <span class="material-symbols-outlined">summarize</span>
                        <p class="text-sm font-medium">Relatórios</p>
                    </a>
                    <a href="{{ route('providers') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary">
                        <span class="material-symbols-outlined">group</span>
                        <p class="text-sm font-medium">Fornecedores</p>
                    </a>
                </div>
            </div>

            <div class="flex flex-col gap-1">
                <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-white hover:bg-primary/10 transition-colors" href="#">
                    <span class="material-symbols-outlined text-2xl">settings</span>
                    <p class="text-sm font-medium">Configurações</p>
                </a>
                <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-white hover:bg-primary/10 transition-colors" href="#">
                    <span class="material-symbols-outlined text-2xl">logout</span>
                    <p class="text-sm font-medium">Sair</p>
                </a>
            </div>
        </aside>

        <div class="flex flex-col flex-1 overflow-y-auto">
            
            <header class="flex h-16 shrink-0 items-center justify-end whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark px-8">
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-3">
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                            data-alt="User avatar image"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDi65Kk7LckmcrS0auPUyvjF94HASToPWM2d3WnpsZxslUUCKNs7xA7mxUSf0AVxlCmiREoOoQG7Rdmpu1I8kWDLom4l-GLvDIzJsagJYxZ87ey45xNUNMyXhLkVNpZYoabM-59t-X6Z939OpdLFfNg9owdAGbCiWMG9FWNI-T29RPcy4QpMF5JNjFr2ScdBqBS3HqG7AKXLe8T5wXQ9ANUcyQqyk72El6Xu_MI_KsYkHTccu6cly77v2AqjCdfaWh0jLWhIyds3q0");'>
                        </div>
                        <div class="flex flex-col text-sm text-right">
                            <h1 id="user_name" class="font-medium text-[#0d141b] dark:text-slate-200"></h1>
                            <p id="type_user_id" class="text-[#4c739a] dark:text-slate-400"></p>
                        </div>
                    </div>
                </div>
            </header>

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
                        <h3 class="text-lg dark:text-text-dark-primary mb-2">Vendas</h3>
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
        </div>
    </div>
</body>
</html>