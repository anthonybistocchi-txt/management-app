<!DOCTYPE html>
<html lang="en">
@vite(['resources/ts/pages/index/management-providers.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Fornecedores - Gestão de Estoque</title>
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
    <div
        class="relative flex h-screen min-h-screen w-full flex-col bg-background-light dark:bg-background-dark text-[#0d141b] dark:text-slate-200">
        <div class="flex h-full w-full">

            <aside id="sidebar-main"
                class="flex h-full w-64 flex-col justify-between bg-surface-blue text-text-white p-4">
                <div class="flex flex-col gap-8">
                    <div class="flex items-center justify-center px-2">
                        <div class="p-2 rounded-xl w-full shadow-sm flex items-center justify-center">
                            <img id="img-sidebar-logo" src="/images/logo.jpg" alt="Logo Empresa"
                                class="h-12 w-auto object-contain max-w-full">
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <a id="link-sidebar-dashboard" href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">dashboard</span>
                            <p class="text-sm font-semibold">Dashboard</p>
                        </a>

                        <a id="link-sidebar-stock-in" href="{{ route('stock') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">inventory_2</span>
                            <p class="text-sm font-medium">Registrar entrada</p>
                        </a>

                        <a id="link-sidebar-users" href="{{ route('users') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">group</span>
                            <p class="text-sm font-medium">Usuários</p>
                        </a>

                        <a id="link-sidebar-stock-out" href="{{ route('stockOut') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            <p class="text-sm font-medium">Registrar venda</p>
                        </a>

                        <a id="link-sidebar-providers" href="{{ route('providers') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/10 text-primary transition-colors">
                            <span class="material-symbols-outlined">local_shipping</span>
                            <p class="text-sm font-medium">Fornecedores</p>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <a id="link-sidebar-settings"
                        class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-white hover:bg-primary/10 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined text-2xl">settings</span>
                        <p class="text-sm font-medium">Configurações</p>
                    </a>
                    <a id="link-sidebar-logout"
                        class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-white hover:bg-primary/10 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined text-2xl">logout</span>
                        <p class="text-sm font-medium">Sair</p>
                    </a>
                </div>
            </aside>

            <div class="flex flex-1 flex-col overflow-y-auto">
                <header
                    class="flex h-16 items-center justify-end whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark px-8">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-3">
                            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC5080jbnOq59jWdXAabdZ_iX7TokEeCpOgf7D0ppHM0VQ57_wBG0yda2Hujydz4kD8ULDtYbVFdfmZ4pdAJj9-pFWtY9b359h-drKEnTOkKJXh5Ij3FTFjmXHBHTxsHoHNZeuN08MuLVNZYJoZME8cKVqXrmJ-nMEhQ1x4uifNhq-LcoOaOV-OWVzhfx8U-hBG9pQvgIhH7wIAobKwt8euhah4rbZVIYCbMSKBIxFLfUCTdURo4BM2_hbvYlMl06i2vfnVaGMGBaQ");'>
                            </div>
                            <div class="flex flex-col text-sm">
                                <h1 id="text-header-username" class="font-medium text-[#0d141b] dark:text-slate-200"></h1>
                                <p id="text-header-type-user" class="text-[#4c739a] dark:text-slate-400"></p>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="p-8">
                    <div class="mx-auto max-w-7xl">
                        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <h1 class="text-3xl font-bold tracking-tight text-[#0d141b] dark:text-slate-100">
                                    Fornecedores</h1>
                                <p class="text-base text-[#4c739a] dark:text-slate-400">Gerencie a lista de empresas e
                                    parceiros que fornecem produtos.</p>
                            </div>
                            <button
                                class="flex items-center justify-center gap-2 rounded-lg h-10 bg-primary text-white text-sm font-bold px-6 hover:bg-blue-600 transition-colors">
                                <span class="material-symbols-outlined text-xl">add</span>
                                <span>Adicionar fornecedor</span>
                            </button>
                        </div>

                        <div class="mb-6 flex flex-wrap items-center gap-4">
                            <div class="flex-1 min-w-[300px]">
                                <div class="relative">
                                    <span
                                        class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                                    <input type="text" placeholder="Buscar por Razão Social, CNPJ..."
                                        class="w-full pl-10 h-11 rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-white dark:bg-slate-800 text-sm focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" />
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button
                                    class="flex items-center gap-2 px-4 h-11 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm font-medium hover:bg-slate-50 transition-colors">
                                    <span class="material-symbols-outlined text-lg text-slate-500">filter_list</span>
                                    Filtrar
                                </button>
                                <button
                                    class="flex items-center gap-2 px-4 h-11 rounded-lg bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-sm font-medium hover:bg-slate-50 transition-colors">
                                    <span class="material-symbols-outlined text-lg text-slate-500">swap_vert</span>
                                    Ordenar
                                </button>
                            </div>
                        </div>

                        <div
                            class="rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark shadow-sm overflow-hidden">
                            <div class="overflow-x-auto">

                                <table id="table-providers"
                                    class="w-full text-sm text-left text-[#4c739a] dark:text-slate-400"></table>
                            </div>

                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>

</html>