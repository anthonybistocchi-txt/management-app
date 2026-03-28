<!DOCTYPE html>
<html lang="pt-BR">
@vite(['resources/ts/pages/admin/reports/in-out.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Entrada e Saída</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
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

            @include('partials.sidebar-main', ['active' => 'reportInOut'])

            <div class="flex flex-1 flex-col overflow-y-auto">

                @include('partials.header-user')

                <main class="flex-1 p-8">
                    <div class="mx-auto max-w-7xl">

                        <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <h1 class="text-3xl font-bold tracking-tight text-[#0d141b] dark:text-slate-800">Entrada e Saída</h1>
                                <p class="text-base text-[#4c739a] dark:text-slate-500">Relatório de movimentações de entrada e saída de estoque.</p>
                            </div>
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
                        </div>

                        <div class="mb-6 rounded-xl bg-white dark:bg-background-dark p-4 shadow-sm">

                            <div class="flex flex-col lg:flex-row gap-3 items-end w-full">

                                <div class="relative w-full lg:w-auto lg:flex-[1.5] flex-shrink-0">
                                    <label class="mb-1 block text-xs font-medium text-[#4c739a] dark:text-slate-600">Produto</label>
                                    <div class="relative">
                                        <select id="filter-in-out-product"></select>
                                    </div>
                                </div>

                                <div class="relative w-full lg:w-auto lg:flex-[1.5] flex-shrink-0">
                                    <label class="mb-1 block text-xs font-medium text-[#4c739a] dark:text-slate-600">Período</label>
                                    <div class="relative">
                                        <span class="material-symbols-outlined absolute left-2.5 top-2.5 text-[#4c739a] text-lg">calendar_month</span>
                                        <input id="filter-in-out-date-range" type="text"
                                            placeholder="Selecione o período"
                                            class="form-input h-10 w-full rounded-lg border border-[#cfdbe7] bg-[#F4F7FA] text-[#0d141b] dark:text-slate-600 placeholder:text-[#94a3b8] dark:placeholder:text-slate-500  pl-9 pr-2 text-xs xl:text-sm font-normal cursor-pointer" />
                                    </div>
                                </div>

                                <div class="relative w-full lg:w-auto lg:flex-1 flex-shrink-0">
                                    <label class="mb-1 block text-xs font-medium text-[#4c739a] dark:text-slate-400 truncate">Localização</label>
                                    <select id="filter-in-out-location">
                                        <option value="" disabled selected hidden>Local</option>
                                        <option value="all">Todas</option>
                                    </select>
                                </div>

                                <div class="relative w-full lg:w-auto lg:flex-1 flex-shrink-0">
                                    <label class="mb-1 block text-xs font-medium text-[#4c739a] dark:text-slate-400 truncate">Movimentação</label>
                                    <select id="filter-in-out-movement-type">
                                        <option value="" disabled selected hidden>Tipo</option>
                                        <option value="all">Todos</option>
                                        <option value="in">Entrada</option>
                                        <option value="out">Saída</option>
                                        <option value="transfer">Transferência</option>
                                    </select>
                                </div>

                                <div class="relative w-full lg:w-auto lg:flex-1 flex-shrink-0">
                                    <label class="mb-1 block text-xs font-medium text-[#4c739a] dark:text-slate-400 truncate">Categoria</label>
                                    <select id="filter-in-out-category">
                                        <option value="" disabled selected hidden>Categoria</option>
                                        <option value="all">Todas</option>
                                    </select>
                                </div>

                                <div class="relative w-full lg:w-auto lg:flex-1 flex-shrink-0">
                                    <label class="mb-1 block text-xs font-medium text-[#4c739a] dark:text-slate-400 truncate">Fornecedor</label>
                                    <select id="filter-in-out-provider">
                                        <option value="" disabled selected hidden>Fornecedor</option>
                                        <option value="all">Todos</option>
                                    </select>
                                </div>

                                <div class="w-full lg:w-auto lg:flex-none">
                                    <button type="button" id="btn-search-in-out"
                                        class="flex h-10 w-full items-center justify-center gap-1 rounded-lg bg-primary px-4 text-sm font-bold text-white shadow-sm transition-colors hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary/50">
                                        <span class="material-symbols-outlined text-lg">search</span>
                                        <span class="lg:hidden xl:inline">Buscar</span> </button>
                                </div>

                            </div>
                        </div>

                        <div class="rounded-xl bg-white dark:bg-background-dark shadow-sm overflow-hidden">
                            <div class="overflow-x-auto">
                                <table id="table-in-out-report" class="w-full text-sm text-left text-[#4c739a] dark:text-slate-400"></table>
                            </div>
                            <p id="empty-report-inout" class="hidden px-4 py-8 text-center text-gray-500">
                                Sem dados para os filtros selecionados.
                            </p>
                        </div>

                    </div>
                </main>

                @include('partials.footer-main')
            </div>
        </div>
    </div>
</body>

</html>