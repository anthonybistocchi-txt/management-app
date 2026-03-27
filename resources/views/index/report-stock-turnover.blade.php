<!DOCTYPE html>
<html lang="pt-BR">
@vite(['resources/ts/pages/index/reports-shell.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Relatório — Giro de Estoque</title>
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

            @include('partials.sidebar-main', ['active' => 'reportStockTurnover'])

            <div class="flex flex-1 flex-col overflow-y-auto">

                @include('partials.header-user')

                <main class="p-8">
                    <div class="mx-auto max-w-7xl">
                        <div class="mb-6 flex flex-col gap-1">
                            <h1 class="text-3xl font-bold tracking-tight text-[#0d141b] dark:text-slate-100">Giro de Estoque
                            </h1>
                            <p class="text-base text-[#4c739a] dark:text-slate-400">Relatório de giro de estoque. O
                                conteúdo detalhado será implementado aqui.</p>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>

</html>
