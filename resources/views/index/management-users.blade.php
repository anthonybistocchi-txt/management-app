<!DOCTYPE html>

<html class="light" lang="en">
@vite(['resources/ts/pages/index/management-users.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>CRUD de Usuários - Lista</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <style>
        .material-symbols-outlined {
            font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 24
        }
    </style>
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
</head>

<body class="font-display">
    <div
        class="relative flex h-auto min-h-screen w-full flex-col bg-background-light dark:bg-background-dark group/design-root overflow-x-hidden">
        <div class="flex min-h-screen">
            <!-- SideNavBar -->
            <div
                class="flex flex-col gap-4 border-r border-slate-200 dark:border-slate-700 bg-white dark:bg-background-dark p-4 w-64 shrink-0">
                <div class="flex items-center gap-3 p-2">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                        data-alt="Admin avatar"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDW-yABaKUvqjnttBiY1e8ymZ6mOfEMySR-pZlnQX9eMFdK5SSC0jswdC7IlvlCSs7J9uU6evExaIO5UpcqNWXmt1YID_mQJA_K7ekMqPjTB1CWm94HBkZFOfqIfLl_GuOEt_oDBLJ3wu2YNMPb4Ss2PeAwkrYNEDIrGAL_zfUIyADR2qEcDH4cUXoft5YTWlA1oUoE4zAaoI7NnkqzXJm6tSxPDizL1AxmK5fWQUEA1mD1D1CTyG54Iuv6ekHKLbZo7G3Kjei4Ljw");'>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-slate-900 dark:text-slate-50 text-base font-medium leading-normal">Admin Name
                        </h1>
                        <p class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal">admin@email.com
                        </p>
                    </div>
                </div>
                <div class="flex flex-col gap-1 mt-4">
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800"
                        href="#">
                        <span class="material-symbols-outlined text-slate-500 dark:text-slate-400">dashboard</span>
                        <p class="text-sm font-medium leading-normal">Dashboard</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800"
                        href="#">
                        <span class="material-symbols-outlined text-slate-500 dark:text-slate-400">inventory_2</span>
                        <p class="text-sm font-medium leading-normal">Estoque</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 text-primary dark:bg-primary/20 dark:text-white"
                        href="#">
                        <span class="material-symbols-outlined !fill-1">group</span>
                        <p class="text-sm font-medium leading-normal">Usuários</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800"
                        href="#">
                        <span class="material-symbols-outlined text-slate-500 dark:text-slate-400">pie_chart</span>
                        <p class="text-sm font-medium leading-normal">Relatórios</p>
                    </a>
                </div>
                <div class="mt-auto flex flex-col gap-1">
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800"
                        href="#">
                        <span class="material-symbols-outlined text-slate-500 dark:text-slate-400">logout</span>
                        <p class="text-sm font-medium leading-normal">Sair</p>
                    </a>
                </div>
            </div>
            <!-- Main Content -->
            <div class="flex-1 flex flex-col">
                <!-- TopNavBar -->
                <header
                    class="flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-700 px-10 py-3 bg-white dark:bg-background-dark sticky top-0 z-10">
                    <div class="flex items-center gap-4 text-slate-900 dark:text-slate-50">
                        <div class="size-6 text-primary">
                            <svg fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1.25a1.25 1.25 0 00-2.5 0H10a.75.75 0 000 1.5h.25a2.75 2.75 0 015.5 0H17a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 00-1-1v-.5a1.5 1.5 0 01-3 0V15a1 1 0 00-1-1H3a1 1 0 01-1-1v-3a1 1 0 011-1h1.25a1.25 1.25 0 002.5 0H10a.75.75 0 000-1.5H9.75a2.75 2.75 0 01-5.5 0H3a1 1 0 01-1-1V4a1 1 0 011-1h3a1 1 0 001 1v.5z">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold leading-tight tracking-[-0.015em]">Gestão de Estoque</h2>
                    </div>
                    <div class="flex flex-1 justify-end gap-4 items-center">
                        <button
                            class="relative flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 w-10 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700">
                            <span class="material-symbols-outlined">notifications</span>
                            <span class="absolute top-2 right-2.5 h-2 w-2 rounded-full bg-red-500"></span>
                        </button>
                        <button
                            class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 w-10 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700">
                            <span class="material-symbols-outlined">settings</span>
                        </button>
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                            data-alt="User avatar"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBDKlZwsA-mSB6-1UZJ4Bz5HsdNpTTg3S2tyn72Q3Z8sYN2V9Jc5tI3DX7laTt54X8jvZQyKed5oFnP1XsguZG3__ugK3xQVhngqF6mKhvLqyZ2qx81hFQCM937oqFFzIvTQFmFlQQEIWc-4y1hTnUP7_VRV1MrxmzrV7fviWEt2n9Kvs-EaN6qrhWtJY-r5eVunifDGIFONByRKGYSElzFyGpR29orv33iCE9HZOK41k7UhyWCWOU0C7Rqm602Clrxj9l5Kx5z5BA");'>
                        </div>
                    </div>
                </header>
                <main class="flex-1 p-8">
                    <div class="flex flex-col max-w-7xl mx-auto gap-8">
                        <!-- Page Heading -->
                        <div class="flex flex-wrap justify-between gap-4 items-center">
                            <div class="flex flex-col gap-2">
                                <h1 class="text-slate-900 dark:text-slate-50 text-3xl font-bold tracking-tight">Gestão
                                    de Usuários</h1>
                                <p class="text-slate-500 dark:text-slate-400 text-base font-normal leading-normal">
                                    Gerencie os usuários do sistema, adicione novos, edite perfis e altere status.</p>
                            </div>
                            <button
                                class="flex items-center justify-center gap-2 rounded-lg h-10 px-5 text-sm font-medium bg-primary text-white hover:bg-primary/90">
                                <span class="material-symbols-outlined">add</span>
                                <span>Adicionar Usuário</span>
                            </button>
                        </div>
                        <!-- Toolbar & Search -->
                        <div
                            class="flex flex-col sm:flex-row gap-4 justify-between items-center p-4 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700">
                            <div class="w-full sm:max-w-xs">
                                <label class="relative flex items-center">
                                    <span
                                        class="material-symbols-outlined absolute left-3 text-slate-400 dark:text-slate-500">search</span>
                                    <input
                                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-slate-900 dark:text-slate-50 focus:outline-0 focus:ring-2 focus:ring-primary/50 border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 h-10 placeholder:text-slate-400 dark:placeholder:text-slate-500 pl-10 pr-4 text-sm"
                                        placeholder="Buscar por nome ou email..." value="" />
                                </label>
                            </div>
                            <div class="flex gap-2 w-full sm:w-auto">
                                <div class="relative w-full sm:w-40">
                                    <select
                                        class="form-select w-full rounded-lg text-slate-900 dark:text-slate-50 border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 h-10 text-sm focus:ring-2 focus:ring-primary/50">
                                        <option>Todos os Perfis</option>
                                        <option>Administrador</option>
                                        <option>Operador</option>
                                    </select>
                                </div>
                                <div class="relative w-full sm:w-40">
                                    <select
                                        class="form-select w-full rounded-lg text-slate-900 dark:text-slate-50 border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 h-10 text-sm focus:ring-2 focus:ring-primary/50">
                                        <option>Todos os Status</option>
                                        <option>Ativo</option>
                                        <option>Inativo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Users Table -->
                        <div
                            class="overflow-x-auto bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700">
                            <table class="w-full text-sm text-left text-slate-500 dark:text-slate-400">
                                <thead
                                    class="text-xs text-slate-700 dark:text-slate-300 uppercase bg-slate-50 dark:bg-slate-700">
                                    <tr>
                                        <th class="px-6 py-3 font-medium" scope="col">Nome</th>
                                        <th class="px-6 py-3 font-medium" scope="col">Email</th>
                                        <th class="px-6 py-3 font-medium" scope="col">Perfil</th>
                                        <th class="px-6 py-3 font-medium" scope="col">Status</th>
                                        <th class="px-6 py-3 font-medium text-right" scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="bg-white dark:bg-slate-800 border-b dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600/20">
                                        <td
                                            class="px-6 py-4 font-medium text-slate-900 dark:text-white whitespace-nowrap">
                                            João da Silva</td>
                                        <td class="px-6 py-4">joao.silva@example.com</td>
                                        <td class="px-6 py-4">Administrador</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Ativo</span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex gap-2 justify-end">
                                                <button
                                                    class="text-slate-500 hover:text-primary dark:text-slate-400 dark:hover:text-primary"><span
                                                        class="material-symbols-outlined text-base">edit</span></button>
                                                <button
                                                    class="text-slate-500 hover:text-red-600 dark:text-slate-400 dark:hover:text-red-500"><span
                                                        class="material-symbols-outlined text-base">delete</span></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr
                                        class="bg-white dark:bg-slate-800 border-b dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600/20">
                                        <td
                                            class="px-6 py-4 font-medium text-slate-900 dark:text-white whitespace-nowrap">
                                            Maria Oliveira</td>
                                        <td class="px-6 py-4">maria.oliveira@example.com</td>
                                        <td class="px-6 py-4">Operador</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Ativo</span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex gap-2 justify-end">
                                                <button
                                                    class="text-slate-500 hover:text-primary dark:text-slate-400 dark:hover:text-primary"><span
                                                        class="material-symbols-outlined text-base">edit</span></button>
                                                <button
                                                    class="text-slate-500 hover:text-red-600 dark:text-slate-400 dark:hover:text-red-500"><span
                                                        class="material-symbols-outlined text-base">delete</span></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr
                                        class="bg-white dark:bg-slate-800 border-b dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600/20">
                                        <td
                                            class="px-6 py-4 font-medium text-slate-900 dark:text-white whitespace-nowrap">
                                            Carlos Pereira</td>
                                        <td class="px-6 py-4">carlos.pereira@example.com</td>
                                        <td class="px-6 py-4">Operador</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-300">Inativo</span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex gap-2 justify-end">
                                                <button
                                                    class="text-slate-500 hover:text-primary dark:text-slate-400 dark:hover:text-primary"><span
                                                        class="material-symbols-outlined text-base">edit</span></button>
                                                <button
                                                    class="text-slate-500 hover:text-red-600 dark:text-slate-400 dark:hover:text-red-500"><span
                                                        class="material-symbols-outlined text-base">delete</span></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-600/20">
                                        <td
                                            class="px-6 py-4 font-medium text-slate-900 dark:text-white whitespace-nowrap">
                                            Ana Costa</td>
                                        <td class="px-6 py-4">ana.costa@example.com</td>
                                        <td class="px-6 py-4">Administrador</td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">Ativo</span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex gap-2 justify-end">
                                                <button
                                                    class="text-slate-500 hover:text-primary dark:text-slate-400 dark:hover:text-primary"><span
                                                        class="material-symbols-outlined text-base">edit</span></button>
                                                <button
                                                    class="text-slate-500 hover:text-red-600 dark:text-slate-400 dark:hover:text-red-500"><span
                                                        class="material-symbols-outlined text-base">delete</span></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <nav aria-label="Table navigation" class="flex items-center justify-between p-4">
                                <span class="text-sm font-normal text-slate-500 dark:text-slate-400">Exibindo <span
                                        class="font-semibold text-slate-900 dark:text-white">1-4</span> de <span
                                        class="font-semibold text-slate-900 dark:text-white">100</span></span>
                                <ul class="inline-flex -space-x-px text-sm h-8">
                                    <li>
                                        <a class="flex items-center justify-center px-3 h-8 ml-0 leading-tight text-slate-500 bg-white border border-slate-300 rounded-l-lg hover:bg-slate-100 hover:text-slate-700 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-white"
                                            href="#">Anterior</a>
                                    </li>
                                    <li>
                                        <a class="flex items-center justify-center px-3 h-8 leading-tight text-slate-500 bg-white border border-slate-300 hover:bg-slate-100 hover:text-slate-700 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-white"
                                            href="#">1</a>
                                    </li>
                                    <li>
                                        <a aria-current="page"
                                            class="flex items-center justify-center px-3 h-8 text-primary border border-primary/40 bg-primary/10 hover:bg-primary/20 hover:text-primary-700 dark:border-slate-700 dark:bg-slate-700 dark:text-white"
                                            href="#">2</a>
                                    </li>
                                    <li>
                                        <a class="flex items-center justify-center px-3 h-8 leading-tight text-slate-500 bg-white border border-slate-300 hover:bg-slate-100 hover:text-slate-700 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-white"
                                            href="#">3</a>
                                    </li>
                                    <li>
                                        <a class="flex items-center justify-center px-3 h-8 leading-tight text-slate-500 bg-white border border-slate-300 rounded-r-lg hover:bg-slate-100 hover:text-slate-700 dark:bg-slate-800 dark:border-slate-700 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-white"
                                            href="#">Próximo</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>

</html>