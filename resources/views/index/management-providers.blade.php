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

            @include('partials.sidebar-main', ['active' => 'providers'])

            <div class="flex flex-1 flex-col overflow-y-auto">
                @include('partials.header-user', [
                    'avatarUrl' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC5080jbnOq59jWdXAabdZ_iX7TokEeCpOgf7D0ppHM0VQ57_wBG0yda2Hujydz4kD8ULDtYbVFdfmZ4pdAJj9-pFWtY9b359h-drKEnTOkKJXh5Ij3FTFjmXHBHTxsHoHNZeuN08MuLVNZYJoZME8cKVqXrmJ-nMEhQ1x4uifNhq-LcoOaOV-OWVzhfx8U-hBG9pQvgIhH7wIAobKwt8euhah4rbZVIYCbMSKBIxFLfUCTdURo4BM2_hbvYlMl06i2vfnVaGMGBaQ',
                ])

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
                                        class="w-full pl-10 h-11 rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-[#edf2f7] dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 text-sm placeholder:text-[#94a3b8] dark:placeholder:text-slate-500 focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all" />
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
                            class="rounded-xl bg-white dark:bg-background-dark shadow-sm overflow-hidden">
                            <div class="overflow-x-auto">

                                <table id="table-providers"
                                    class="w-full text-sm text-left text-[#4c739a] dark:text-slate-400"></table>
                            </div>

                        </div>
                    </div>
                </main>

                @include('partials.footer-main')
            </div>
        </div>
    </div>
</body>

</html>