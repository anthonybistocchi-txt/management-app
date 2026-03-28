<!DOCTYPE html>
<html lang="pt-BR">
@vite(['resources/ts/pages/index/reports-shell.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Relatório — Inventário</title>
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

            @include('partials.sidebar-main', ['active' => 'reportInventory'])

            <div class="flex flex-1 flex-col overflow-y-auto">

                @include('partials.header-user')

                <main class="flex-1 p-8">
                    <div class="mx-auto max-w-7xl">
                        <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <h1 class="text-3xl font-bold tracking-tight text-[#0d141b] dark:text-slate-100">Inventário</h1>
                                <p class="text-base text-[#4c739a] dark:text-slate-400">Relatório de inventário. O conteúdo
                                    detalhado será implementado aqui.</p>
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
                    </div>
                </main>

                @include('partials.footer-main')
            </div>
        </div>
    </div>
</body>

</html>
