<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>CRUD de Fornecedores - Lista</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&amp;display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script>
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
                        "display": ["Manrope"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="font-display">
    <div
        class="relative flex h-auto min-h-screen w-full flex-col bg-background-light dark:bg-background-dark group/design-root overflow-x-hidden">
        <div class="flex min-h-screen">
            <!-- SideNavBar -->
            <aside
                class="flex w-64 flex-col border-r border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark p-4">
                <div class="flex h-full flex-col justify-between">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-3">
                            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                                data-alt="Admin user avatar"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC5080jbnOq59jWdXAabdZ_iX7TokEeCpOgf7D0ppHM0VQ57_wBG0yda2Hujydz4kD8ULDtYbVFdfmZ4pdAJj9-pFWtY9b359h-drKEnTOkKJXh5Ij3FTFjmXHBHTxsHoHNZeuN08MuLVNZYJoZME8cKVqXrmJ-nMEhQ1x4uifNhq-LcoOaOV-OWVzhfx8U-hBG9pQvgIhH7wIAobKwt8euhah4rbZVIYCbMSKBIxFLfUCTdURo4BM2_hbvYlMl06i2vfnVaGMGBaQ");'>
                            </div>
                            <div class="flex flex-col">
                                <h1 class="text-slate-900 dark:text-slate-200 text-base font-medium leading-normal">
                                    Admin User</h1>
                                <p class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal">
                                    admin@example.com</p>
                            </div>
                        </div>
                        <nav class="flex flex-col gap-2 mt-4">
                            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800"
                                href="#">
                                <span class="material-symbols-outlined">dashboard</span>
                                <p class="text-sm font-medium leading-normal">Dashboard</p>
                            </a>
                            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800"
                                href="#">
                                <span class="material-symbols-outlined">inventory_2</span>
                                <p class="text-sm font-medium leading-normal">Produtos</p>
                            </a>
                            <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800"
                                href="#">
                                <span class="material-symbols-outlined">group</span>
                                <p class="text-sm font-medium leading-normal">Usuários</p>
                            </a>
                            <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 text-primary dark:bg-primary/20 dark:text-white"
                                href="#">
                                <span class="material-symbols-outlined"
                                    style="font-variation-settings: 'FILL' 1;">store</span>
                                <p class="text-sm font-medium leading-normal">Fornecedores</p>
                            </a>
                        </nav>
                    </div>
                    <div class="flex flex-col gap-2">
                        <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800"
                            href="#">
                            <span class="material-symbols-outlined">settings</span>
                            <p class="text-sm font-medium leading-normal">Configurações</p>
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800"
                            href="#">
                            <span class="material-symbols-outlined">logout</span>
                            <p class="text-sm font-medium leading-normal">Sair</p>
                        </a>
                    </div>
                </div>
            </aside>
            <!-- Main Content -->
            <main class="flex flex-1 flex-col">
                <!-- TopNavBar -->
                <header
                    class="flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 px-10 py-3 bg-white dark:bg-background-dark">
                    <div class="flex items-center gap-4 text-slate-900 dark:text-slate-200">
                        <div class="size-6 text-primary">
                            <svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M36.7273 44C33.9891 44 31.6043 39.8386 30.3636 33.69C29.123 39.8386 26.7382 44 24 44C21.2618 44 18.877 39.8386 17.6364 33.69C16.3957 39.8386 14.0109 44 11.2727 44C7.25611 44 4 35.0457 4 24C4 12.9543 7.25611 4 11.2727 4C14.0109 4 16.3957 8.16144 17.6364 14.31C18.877 8.16144 21.2618 4 24 4C26.7382 4 29.123 8.16144 30.3636 14.31C31.6043 8.16144 33.9891 4 36.7273 4C40.7439 4 44 12.9543 44 24C44 35.0457 40.7439 44 36.7273 44Z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                        <h2
                            class="text-slate-900 dark:text-slate-200 text-lg font-bold leading-tight tracking-[-0.015em]">
                            Gestão de Estoque</h2>
                    </div>
                    <button
                        class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 w-10 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-sm font-bold leading-normal tracking-[0.015em]">
                        <span class="material-symbols-outlined text-xl">notifications</span>
                    </button>
                </header>
                <div class="flex-1 p-8">
                    <div class="flex flex-col max-w-7xl mx-auto">
                        <!-- PageHeading -->
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <p
                                class="text-slate-900 dark:text-slate-50 text-4xl font-black leading-tight tracking-[-0.033em] min-w-72">
                                Fornecedores</p>
                            <button
                                class="flex items-center justify-center gap-2 rounded-lg h-11 bg-primary text-white text-sm font-bold leading-normal px-6">
                                <span class="material-symbols-outlined">add</span>
                                <span>Adicionar Fornecedor</span>
                            </button>
                        </div>
                        <!-- Action Bar: Search & Filters -->
                        <div class="mt-8 flex flex-wrap items-center gap-4">
                            <!-- SearchBar -->
                            <div class="flex-1 min-w-80">
                                <label class="flex flex-col h-12 w-full">
                                    <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                                        <div
                                            class="text-slate-400 dark:text-slate-500 flex bg-slate-100 dark:bg-slate-800 items-center justify-center pl-4 rounded-l-lg">
                                            <span class="material-symbols-outlined">search</span>
                                        </div>
                                        <input
                                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-r-lg text-slate-900 dark:text-slate-200 focus:outline-0 focus:ring-0 border-none bg-slate-100 dark:bg-slate-800 h-full placeholder:text-slate-400 dark:placeholder:text-slate-500 px-4 pl-2 text-base font-normal leading-normal"
                                            placeholder="Buscar por Razão Social, CNPJ..." value="" />
                                    </div>
                                </label>
                            </div>
                            <!-- Chips / Filters -->
                            <div class="flex gap-3">
                                <button
                                    class="flex h-12 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-slate-100 dark:bg-slate-800 px-4">
                                    <span
                                        class="material-symbols-outlined text-slate-600 dark:text-slate-300">filter_list</span>
                                    <p class="text-slate-800 dark:text-slate-200 text-sm font-medium leading-normal">
                                        Filtrar</p>
                                    <span
                                        class="material-symbols-outlined text-slate-600 dark:text-slate-300">expand_more</span>
                                </button>
                                <button
                                    class="flex h-12 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-slate-100 dark:bg-slate-800 px-4">
                                    <span
                                        class="material-symbols-outlined text-slate-600 dark:text-slate-300">swap_vert</span>
                                    <p class="text-slate-800 dark:text-slate-200 text-sm font-medium leading-normal">
                                        Ordenar</p>
                                    <span
                                        class="material-symbols-outlined text-slate-600 dark:text-slate-300">expand_more</span>
                                </button>
                            </div>
                        </div>
                        <!-- Data Table -->
                        <div
                            class="mt-6 overflow-hidden rounded-lg border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/50">
                            <div class="overflow-x-auto">
                                <table class="w-full min-w-max text-left text-sm">
                                    <thead
                                        class="border-b border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50">
                                        <tr>
                                            <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300">Razão
                                                Social</th>
                                            <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300">CNPJ
                                            </th>
                                            <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300">
                                                Contato</th>
                                            <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300">
                                                Telefone</th>
                                            <th class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300">
                                                E-mail</th>
                                            <th
                                                class="px-6 py-4 font-semibold text-slate-600 dark:text-slate-300 text-right">
                                                Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                                        <tr>
                                            <td class="px-6 py-4 text-slate-800 dark:text-slate-200">Tech Solutions S.A.
                                            </td>
                                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">12.345.678/0001-99
                                            </td>
                                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">Carlos Silva</td>
                                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">(11) 98765-4321
                                            </td>
                                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">
                                                contato@techsolutions.com</td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <button
                                                        class="p-2 text-slate-500 hover:text-primary dark:text-slate-400 dark:hover:text-primary"><span
                                                            class="material-symbols-outlined text-lg">edit</span></button>
                                                    <button
                                                        class="p-2 text-slate-500 hover:text-red-500 dark:text-slate-400 dark:hover:text-red-500"><span
                                                            class="material-symbols-outlined text-lg">delete</span></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 text-slate-800 dark:text-slate-200">Inova Componentes
                                                Eletrônicos</td>
                                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">98.765.432/0001-11
                                            </td>
                                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">Ana Pereira</td>
                                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">(21) 91234-5678
                                            </td>
                                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">ana.p@inova.com
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <button
                                                        class="p-2 text-slate-500 hover:text-primary dark:text-slate-400 dark:hover:text-primary"><span
                                                            class="material-symbols-outlined text-lg">edit</span></button>
                                                    <button
                                                        class="p-2 text-slate-500 hover:text-red-500 dark:text-slate-400 dark:hover:text-red-500"><span
                                                            class="material-symbols-outlined text-lg">delete</span></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 text-slate-800 dark:text-slate-200">Distribuidora
                                                Global Ltda.</td>
                                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">45.678.123/0001-22
                                            </td>
                                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">Roberto Lima</td>
                                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">(31) 99988-7766
                                            </td>
                                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">
                                                roberto@globaldist.com.br</td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <button
                                                        class="p-2 text-slate-500 hover:text-primary dark:text-slate-400 dark:hover:text-primary"><span
                                                            class="material-symbols-outlined text-lg">edit</span></button>
                                                    <button
                                                        class="p-2 text-slate-500 hover:text-red-500 dark:text-slate-400 dark:hover:text-red-500"><span
                                                            class="material-symbols-outlined text-lg">delete</span></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 text-slate-800 dark:text-slate-200">Logística Rápida
                                                Express</td>
                                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">78.123.456/0001-33
                                            </td>
                                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">Mariana Costa</td>
                                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">(41) 98877-6655
                                            </td>
                                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">
                                                m.costa@rapidaexpress.com</td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex items-center justify-end gap-2">
                                                    <button
                                                        class="p-2 text-slate-500 hover:text-primary dark:text-slate-400 dark:hover:text-primary"><span
                                                            class="material-symbols-outlined text-lg">edit</span></button>
                                                    <button
                                                        class="p-2 text-slate-500 hover:text-red-500 dark:text-slate-400 dark:hover:text-red-500"><span
                                                            class="material-symbols-outlined text-lg">delete</span></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                            <div
                                class="flex items-center justify-between border-t border-slate-200 dark:border-slate-800 px-6 py-3">
                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    Mostrando <span class="font-semibold text-slate-700 dark:text-slate-300">1-4</span>
                                    de <span class="font-semibold text-slate-700 dark:text-slate-300">25</span>
                                </p>
                                <div class="flex items-center gap-2">
                                    <button
                                        class="flex items-center justify-center h-8 w-8 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 disabled:opacity-50"
                                        disabled="">
                                        <span class="material-symbols-outlined text-xl">chevron_left</span>
                                    </button>
                                    <button
                                        class="flex items-center justify-center h-8 w-8 rounded-lg text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800">
                                        <span class="material-symbols-outlined text-xl">chevron_right</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>