<!DOCTYPE html>
<html lang="en">
@vite(['resources/ts/pages/index/management-movements.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Tabela de Movimentações</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#137fec",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
</head>

<body class="bg-background-light dark:bg-background-dark font-display">
    <div class="flex h-screen">
        <aside class="w-64 flex-shrink-0 bg-[#0d2847] p-4">
            <div class="flex flex-col h-full">
                <div class="flex items-center gap-3 mb-8">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                        data-alt="User avatar image"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAz1qONsEkXF-a5QqfoHChUd7hnwWfjzwllXyM7ARbrazmQSkBmCowWSO-FCqjYpPFlL5p1yzuQCkNlMEGm2DyBNX9c14L5lslmkEaH0lWHsU2AdpxIlIDLVC0yLsZ7JBUVF1y6WmDtLDl3Y0RxRzZ2BIK73Tp7VOVplLgi0GeuWm_jz47ezTerfgKfwYMxvk_ftvPbEbSG38l2h3DO0yLFGEKRWUtYHkShN8Kg_c1xpyQVQrJ5QjYG1isB42oaeLzCgFKfBu4ljQs");'>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-white text-base font-semibold leading-normal">John Doe</h1>
                        <p class="text-gray-400 text-sm font-normal leading-normal">Admin</p>
                    </div>
                </div>
                <nav class="flex flex-col gap-2">
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white"
                        href="#">
                        <span class="material-symbols-outlined">dashboard</span>
                        <p class="text-sm font-medium leading-normal">Dashboard</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white"
                        href="#">
                        <span class="material-symbols-outlined">inventory_2</span>
                        <p class="text-sm font-medium leading-normal">Produtos</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary text-white" href="#">
                        <span class="material-symbols-outlined"
                            style="font-variation-settings: 'FILL' 1;">sync_alt</span>
                        <p class="text-sm font-semibold leading-normal">Movimentações</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white"
                        href="#">
                        <span class="material-symbols-outlined">group</span>
                        <p class="text-sm font-medium leading-normal">Usuários</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white"
                        href="#">
                        <span class="material-symbols-outlined">settings</span>
                        <p class="text-sm font-medium leading-normal">Configurações</p>
                    </a>
                </nav>
                <div class="mt-auto">
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-gray-300 hover:bg-white/10 hover:text-white"
                        href="#">
                        <span class="material-symbols-outlined">help</span>
                        <p class="text-sm font-medium leading-normal">Ajuda</p>
                    </a>
                </div>
            </div>
        </aside>
        <main class="flex-1 overflow-y-auto">
            <div class="p-8">
                <div class="flex flex-wrap justify-between items-center gap-4 mb-6">
                    <div class="flex flex-col gap-1">
                        <h1 class="text-gray-900 dark:text-white text-3xl font-bold leading-tight">Tabela de
                            Movimentações</h1>
                        <p class="text-gray-500 dark:text-gray-400 text-base font-normal leading-normal">Liste e filtre
                            todas as transações de estoque.</p>
                    </div>
                    <button
                        class="flex items-center justify-center gap-2 h-10 px-4 bg-primary text-white rounded-lg text-sm font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary/50">
                        <span class="material-symbols-outlined text-base">download</span>
                        <span class="truncate">Exportar para CSV</span>
                    </button>
                </div>
                <div class="mb-4">
                    <div
                        class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="flex-grow">
                                <label class="flex flex-col w-full">
                                    <div class="flex w-full items-stretch rounded-lg h-10">
                                        <div
                                            class="text-gray-500 dark:text-gray-400 flex bg-background-light dark:bg-background-dark items-center justify-center pl-3 rounded-l-lg border border-r-0 border-gray-300 dark:border-gray-600">
                                            <span class="material-symbols-outlined text-xl">search</span>
                                        </div>
                                        <input
                                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-r-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 border border-gray-300 dark:border-gray-600 bg-background-light dark:bg-background-dark h-full placeholder:text-gray-500 dark:placeholder:text-gray-400 pl-2 text-sm font-normal leading-normal"
                                            placeholder="Buscar por produto, usuário..." />
                                    </div>
                                </label>
                            </div>
                            <div class="flex gap-2 items-center flex-wrap">
                                <button
                                    class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 hover:bg-gray-200 px-4">
                                    <p class="text-gray-700 dark:text-gray-300 text-sm font-medium leading-normal">Tipo
                                    </p>
                                    <span
                                        class="material-symbols-outlined text-gray-500 dark:text-gray-400 text-lg">expand_more</span>
                                </button>
                                <button
                                    class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 hover:bg-gray-200 px-4">
                                    <p class="text-gray-700 dark:text-gray-300 text-sm font-medium leading-normal">
                                        Usuário</p>
                                    <span
                                        class="material-symbols-outlined text-gray-500 dark:text-gray-400 text-lg">expand_more</span>
                                </button>
                                <button
                                    class="flex h-10 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 hover:bg-gray-200 px-4">
                                    <p class="text-gray-700 dark:text-gray-300 text-sm font-medium leading-normal">
                                        Período</p>
                                    <span
                                        class="material-symbols-outlined text-gray-500 dark:text-gray-400 text-lg">expand_more</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    class="overflow-hidden rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                        scope="col">Tipo</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                        scope="col">Produto</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                        scope="col">Quantidade</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                        scope="col">Data</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                        scope="col">Usuário Responsável</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                                        scope="col">Observações</th>
                                    <th class="relative px-6 py-3" scope="col"><span class="sr-only">Ações</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300">Entrada</span>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                        Notebook Pro X</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400 font-semibold">
                                        +50</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        2024-05-23 10:00</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        Carlos Silva</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        Recebimento do fornecedor ABC</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-primary hover:text-primary/80"><span
                                                class="material-symbols-outlined text-xl">more_vert</span></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300">Saída</span>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                        Mouse Gamer Z</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-red-600 dark:text-red-400 font-semibold">
                                        -15</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        2024-05-22 14:30</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">Ana
                                        Pereira</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        Venda para cliente XYZ</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-primary hover:text-primary/80"><span
                                                class="material-symbols-outlined text-xl">more_vert</span></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300">Transferência</span>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                        Teclado Mecânico K</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400 font-semibold">
                                        20</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        2024-05-22 09:15</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        Carlos Silva</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        Transferência para filial B</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-primary hover:text-primary/80"><span
                                                class="material-symbols-outlined text-xl">more_vert</span></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300">Entrada</span>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                        Monitor UltraWide 34"</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-green-600 dark:text-green-400 font-semibold">
                                        +30</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        2024-05-21 11:45</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        Carlos Silva</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        Recebimento do fornecedor DEF</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-primary hover:text-primary/80"><span
                                                class="material-symbols-outlined text-xl">more_vert</span></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300">Saída</span>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                        Notebook Pro X</td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-red-600 dark:text-red-400 font-semibold">
                                        -5</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        2024-05-20 16:00</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        Juliana Costa</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        Venda interna para marketing</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-primary hover:text-primary/80"><span
                                                class="material-symbols-outlined text-xl">more_vert</span></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex items-center justify-between mt-4 px-2">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Mostrando <span class="font-semibold text-gray-800 dark:text-white">1</span> a <span
                            class="font-semibold text-gray-800 dark:text-white">5</span> de <span
                            class="font-semibold text-gray-800 dark:text-white">25</span> resultados
                    </p>
                    <div class="flex items-center gap-2">
                        <button
                            class="flex items-center justify-center h-8 w-8 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300">
                            <span class="material-symbols-outlined text-lg">chevron_left</span>
                        </button>
                        <button
                            class="flex items-center justify-center h-8 w-8 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300">
                            <span class="material-symbols-outlined text-lg">chevron_right</span>
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

</html>