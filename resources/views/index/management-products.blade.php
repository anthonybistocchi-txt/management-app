<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>CRUD de Produtos - Lista</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
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
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="font-display">
    <div
        class="relative flex min-h-screen w-full flex-col bg-background-light dark:bg-background-dark group/design-root overflow-x-hidden">
        <div class="flex flex-1">
            <aside
                class="flex w-64 flex-col gap-8 border-r border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark p-6">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary text-3xl">deployed_code</span>
                    <h1 class="text-xl font-bold text-slate-900 dark:text-white">EstoquePRO</h1>
                </div>
                <nav class="flex h-full flex-col gap-4">
                    <div class="flex flex-col gap-2">
                        <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800"
                            href="#">
                            <span class="material-symbols-outlined text-slate-500">dashboard</span>
                            <p class="text-sm font-medium">Dashboard</p>
                        </a>
                        <a class="flex items-center gap-3 rounded-lg bg-primary/20 px-3 py-2 text-primary dark:text-primary"
                            href="#">
                            <span class="material-symbols-outlined text-primary"
                                style="font-variation-settings: 'FILL' 1">inventory_2</span>
                            <p class="text-sm font-bold">Produtos</p>
                        </a>
                        <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800"
                            href="#">
                            <span class="material-symbols-outlined text-slate-500">category</span>
                            <p class="text-sm font-medium">Categorias</p>
                        </a>
                        <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800"
                            href="#">
                            <span class="material-symbols-outlined text-slate-500">group</span>
                            <p class="text-sm font-medium">Usuários</p>
                        </a>
                    </div>
                </nav>
                <div class="flex flex-col gap-4 mt-auto">
                    <div class="border-t border-slate-200 dark:border-slate-800"></div>
                    <div class="flex items-center gap-3">
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                            data-alt="Admin user avatar"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuC346DJlGYF7XbE0xMF-hHQ6g9gWOj7tjN85hhPlQ59sJmDgiqYdVid8nhVYC--n5gdBS3jRu0JdcuWH-LX7ppfc3U4nJsim6_2nHuTobKGOkIjFz_mycx6GQupvPRP9B_tByC2phTnpndZ-ivr7dxTEEp3uX_KJM7FCmCHgFfuuSfKXNulmqpDiDXsoAMwqhi7m1yCZj_27tWH2SWlneNRfzXWFA78YctUJp1W2dSbXTntVkU7VRpJUPNr5ymKXxBFmzV-FEy71jU");'>
                        </div>
                        <div class="flex flex-col">
                            <p class="text-sm font-medium text-slate-900 dark:text-white">Admin User</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">admin@example.com</p>
                        </div>
                        <button
                            class="ml-auto text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white">
                            <span class="material-symbols-outlined">logout</span>
                        </button>
                    </div>
                </div>
            </aside>
            <main class="flex-1 overflow-y-auto">
                <div class="p-8">
                    <div class="flex flex-col gap-6">
                        <header class="flex flex-wrap items-center justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <h2 class="text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Produtos
                                </h2>
                                <p class="text-slate-500 dark:text-slate-400">Gerencie seus produtos aqui.</p>
                            </div>
                            <button
                                class="flex items-center justify-center gap-2 rounded-lg bg-primary h-10 px-4 text-sm font-bold text-white leading-normal shadow-sm hover:bg-primary/90">
                                <span class="material-symbols-outlined">add</span>
                                <span class="truncate">Adicionar Produto</span>
                            </button>
                        </header>
                        <div class="flex flex-col gap-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="md:col-span-2">
                                    <label class="flex flex-col min-w-40 h-12 w-full">
                                        <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                                            <div
                                                class="text-slate-500 dark:text-slate-400 flex border border-r-0 border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 items-center justify-center pl-4 rounded-l-lg">
                                                <span class="material-symbols-outlined">search</span>
                                            </div>
                                            <input
                                                class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-slate-900 dark:text-white focus:outline-0 focus:ring-2 focus:ring-primary/50 border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 h-full placeholder:text-slate-500 dark:placeholder:text-slate-400 px-4 rounded-l-none border-l-0 text-sm font-normal"
                                                placeholder="Buscar por nome ou código..." value="" />
                                        </div>
                                    </label>
                                </div>
                                <div>
                                    <button
                                        class="flex h-12 w-full items-center justify-between gap-x-2 rounded-lg bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-700 px-4">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="material-symbols-outlined text-slate-500 text-base">filter_list</span>
                                            <p class="text-slate-900 dark:text-white text-sm font-medium">Filtrar por
                                                Categoria</p>
                                        </div>
                                        <span class="material-symbols-outlined text-slate-500">expand_more</span>
                                    </button>
                                </div>
                            </div>
                            <div class="flex gap-2 overflow-x-auto pb-2">
                                <button
                                    class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-full bg-primary/20 px-3 text-primary text-sm font-semibold">Todas</button>
                                <button
                                    class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-full bg-white dark:bg-slate-800 px-3 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 text-sm font-medium">Eletrônicos</button>
                                <button
                                    class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-full bg-white dark:bg-slate-800 px-3 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 text-sm font-medium">Vestuário</button>
                                <button
                                    class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-full bg-white dark:bg-slate-800 px-3 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 text-sm font-medium">Livros</button>
                                <button
                                    class="flex h-8 shrink-0 items-center justify-center gap-x-2 rounded-full bg-white dark:bg-slate-800 px-3 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 border border-slate-200 dark:border-slate-700 text-sm font-medium">Casa
                                    &amp; Cozinha</button>
                            </div>
                        </div>
                        <div
                            class="overflow-hidden rounded-lg border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900">
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead class="bg-slate-50 dark:bg-slate-800/50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left font-semibold text-slate-600 dark:text-slate-300">
                                                Nome</th>
                                            <th
                                                class="px-6 py-3 text-left font-semibold text-slate-600 dark:text-slate-300">
                                                Código</th>
                                            <th
                                                class="px-6 py-3 text-left font-semibold text-slate-600 dark:text-slate-300">
                                                Categoria</th>
                                            <th
                                                class="px-6 py-3 text-left font-semibold text-slate-600 dark:text-slate-300 whitespace-nowrap">
                                                Qtd. em Estoque</th>
                                            <th
                                                class="px-6 py-3 text-left font-semibold text-slate-600 dark:text-slate-300">
                                                Preço</th>
                                            <th
                                                class="px-6 py-3 text-left font-semibold text-slate-600 dark:text-slate-300">
                                                Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-slate-900 dark:text-white font-medium">
                                                Smartphone X</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 dark:text-slate-400">
                                                PROD-001</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex items-center rounded-md bg-blue-50 dark:bg-blue-900/50 px-2 py-1 text-xs font-medium text-blue-700 dark:text-blue-300 ring-1 ring-inset ring-blue-600/20 dark:ring-blue-500/30">Eletrônicos</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 dark:text-slate-400">
                                                150</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 dark:text-slate-400">
                                                R$ 1.200,00</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center gap-2">
                                                    <button
                                                        class="p-1 text-slate-500 dark:text-slate-400 hover:text-primary rounded-md"><span
                                                            class="material-symbols-outlined text-lg">edit</span></button>
                                                    <button
                                                        class="p-1 text-slate-500 dark:text-slate-400 hover:text-red-500 rounded-md"><span
                                                            class="material-symbols-outlined text-lg">delete</span></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-slate-900 dark:text-white font-medium">
                                                Camiseta Básica</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 dark:text-slate-400">
                                                PROD-002</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex items-center rounded-md bg-green-50 dark:bg-green-900/50 px-2 py-1 text-xs font-medium text-green-700 dark:text-green-300 ring-1 ring-inset ring-green-600/20 dark:ring-green-500/30">Vestuário</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 dark:text-slate-400">
                                                300</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 dark:text-slate-400">
                                                R$ 49,90</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center gap-2">
                                                    <button
                                                        class="p-1 text-slate-500 dark:text-slate-400 hover:text-primary rounded-md"><span
                                                            class="material-symbols-outlined text-lg">edit</span></button>
                                                    <button
                                                        class="p-1 text-slate-500 dark:text-slate-400 hover:text-red-500 rounded-md"><span
                                                            class="material-symbols-outlined text-lg">delete</span></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-slate-900 dark:text-white font-medium">
                                                Livro de Ficção</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 dark:text-slate-400">
                                                PROD-003</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex items-center rounded-md bg-purple-50 dark:bg-purple-900/50 px-2 py-1 text-xs font-medium text-purple-700 dark:text-purple-300 ring-1 ring-inset ring-purple-600/20 dark:ring-purple-500/30">Livros</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 dark:text-slate-400">
                                                80</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 dark:text-slate-400">
                                                R$ 35,00</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center gap-2">
                                                    <button
                                                        class="p-1 text-slate-500 dark:text-slate-400 hover:text-primary rounded-md"><span
                                                            class="material-symbols-outlined text-lg">edit</span></button>
                                                    <button
                                                        class="p-1 text-slate-500 dark:text-slate-400 hover:text-red-500 rounded-md"><span
                                                            class="material-symbols-outlined text-lg">delete</span></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-slate-900 dark:text-white font-medium">
                                                Notebook Pro</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 dark:text-slate-400">
                                                PROD-004</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex items-center rounded-md bg-blue-50 dark:bg-blue-900/50 px-2 py-1 text-xs font-medium text-blue-700 dark:text-blue-300 ring-1 ring-inset ring-blue-600/20 dark:ring-blue-500/30">Eletrônicos</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 dark:text-slate-400">
                                                75</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 dark:text-slate-400">
                                                R$ 4.500,00</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center gap-2">
                                                    <button
                                                        class="p-1 text-slate-500 dark:text-slate-400 hover:text-primary rounded-md"><span
                                                            class="material-symbols-outlined text-lg">edit</span></button>
                                                    <button
                                                        class="p-1 text-slate-500 dark:text-slate-400 hover:text-red-500 rounded-md"><span
                                                            class="material-symbols-outlined text-lg">delete</span></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-slate-900 dark:text-white font-medium">
                                                Calça Jeans</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 dark:text-slate-400">
                                                PROD-005</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex items-center rounded-md bg-green-50 dark:bg-green-900/50 px-2 py-1 text-xs font-medium text-green-700 dark:text-green-300 ring-1 ring-inset ring-green-600/20 dark:ring-green-500/30">Vestuário</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 dark:text-slate-400">
                                                200</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-slate-500 dark:text-slate-400">
                                                R$ 119,90</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center gap-2">
                                                    <button
                                                        class="p-1 text-slate-500 dark:text-slate-400 hover:text-primary rounded-md"><span
                                                            class="material-symbols-outlined text-lg">edit</span></button>
                                                    <button
                                                        class="p-1 text-slate-500 dark:text-slate-400 hover:text-red-500 rounded-md"><span
                                                            class="material-symbols-outlined text-lg">delete</span></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div
                                class="flex items-center justify-between border-t border-slate-200 dark:border-slate-800 px-6 py-3">
                                <p class="text-sm text-slate-500 dark:text-slate-400">Mostrando <span
                                        class="font-semibold text-slate-700 dark:text-slate-200">1</span>-5 de <span
                                        class="font-semibold text-slate-700 dark:text-slate-200">25</span> resultados
                                </p>
                                <div class="flex items-center gap-2">
                                    <button
                                        class="flex items-center justify-center rounded-lg border border-slate-300 dark:border-slate-700 h-8 w-8 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 disabled:opacity-50"
                                        disabled="">
                                        <span class="material-symbols-outlined text-lg">chevron_left</span>
                                    </button>
                                    <button
                                        class="flex items-center justify-center rounded-lg border border-slate-300 dark:border-slate-700 h-8 w-8 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800">
                                        <span class="material-symbols-outlined text-lg">chevron_right</span>
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