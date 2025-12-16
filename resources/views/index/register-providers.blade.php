<!DOCTYPE html>

<html class="light" lang="en">
@vite(['resources/ts/pages/index/register-providers.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Cadastro de Fornecedores</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&amp;display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
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
    <div class="relative flex h-auto min-h-screen w-full flex-col bg-background-light dark:bg-background-dark">
        <div class="flex h-full w-full">
            <!-- SideNavBar -->
            <aside
                class="flex h-screen min-h-screen flex-col border-r border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark w-64 p-4 sticky top-0">
                <div class="flex flex-col gap-4 flex-1">
                    <div class="flex items-center gap-3 p-2">
                        <div class="size-8 text-primary">
                            <svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M36.7273 44C33.9891 44 31.6043 39.8386 30.3636 33.69C29.123 39.8386 26.7382 44 24 44C21.2618 44 18.877 39.8386 17.6364 33.69C16.3957 39.8386 14.0109 44 11.2727 44C7.25611 44 4 35.0457 4 24C4 12.9543 7.25611 4 11.2727 4C14.0109 4 16.3957 8.16144 17.6364 14.31C18.877 8.16144 21.2618 4 24 4C26.7382 4 29.123 8.16144 30.3636 14.31C31.6043 8.16144 33.9891 4 36.7273 4C40.7439 4 44 12.9543 44 24C44 35.0457 40.7439 44 36.7273 44Z"
                                    fill="currentColor"></path>
                            </svg>
                        </div>
                        <h1 class="text-lg font-bold text-slate-900 dark:text-slate-200">Gestão PRO</h1>
                    </div>
                    <div class="flex flex-col gap-2 mt-4">
                        <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-400"
                            href="#">
                            <span class="material-symbols-outlined text-xl">grid_view</span>
                            <p class="text-sm font-medium">Dashboard</p>
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-400"
                            href="#">
                            <span class="material-symbols-outlined text-xl">inventory_2</span>
                            <p class="text-sm font-medium">Estoque</p>
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 text-primary dark:bg-primary/20 dark:text-white"
                            href="#">
                            <span class="material-symbols-outlined text-xl"
                                style="font-variation-settings: 'FILL' 1;">local_shipping</span>
                            <p class="text-sm font-medium">Fornecedores</p>
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-700 dark:text-slate-400"
                            href="#">
                            <span class="material-symbols-outlined text-xl">group</span>
                            <p class="text-sm font-medium">Usuários</p>
                        </a>
                    </div>
                </div>
                <div class="flex flex-col gap-4">
                    <div class="border-t border-slate-200 dark:border-slate-800 my-2"></div>
                    <div class="flex gap-3 items-center">
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                            data-alt="User avatar image"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDsfJ5YW1MRxKlT1lMOgz-tUUVSgosMesVMEjW9UERRbHRCZ-GdV-Qo8aSd3rqgbmRBhwJE0wbLmKoleMUaUZf2Og-EGOUCQ25u1nYDo9Zkr1tenuNwZNYkVBWwizBvc-0ksxtwzIH34BHrQdwYLURTu3gEhAf4K-Yr2jHSJjnttsLNhwCe48plhtKgAtLmTd8AhfA-KcwObsI9n_8WQtxR3nh8FQ7q5jpyLJWLOVKJn-leQouIjCd5154a_wCD_BQl2QJsJaH3PGY");'>
                        </div>
                        <div class="flex flex-col">
                            <h1 class="text-slate-900 dark:text-slate-200 text-sm font-medium leading-normal">Carlos
                                Silva</h1>
                            <p class="text-slate-500 dark:text-slate-400 text-xs font-normal leading-normal">Admin</p>
                        </div>
                    </div>
                </div>
            </aside>
            <!-- Main Content -->
            <main class="flex-1 flex flex-col">
                <!-- TopNavBar -->
                <header
                    class="flex items-center justify-end whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark px-10 py-3 sticky top-0 z-10">
                    <div class="flex items-center gap-4">
                        <button
                            class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-10 w-10 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300">
                            <span class="material-symbols-outlined text-xl">notifications</span>
                        </button>
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                            data-alt="User avatar image"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAeqnVtrGRkH4juL2i21O0lWXrPpVHNf_B9fwljBC4bfX35DXXhWWM4i8AuI913SDtk97B9tDtTkduoj5H59_v0syT9L7xmlAFBrvOpBjG1_ajMvxi-UpZWm3nPFuOVMl9hmknoxt-TA4tWyr8740sjSN4ENS4HHTtW-u2nO1fbJ8IgfK2Yv4yjfayWTWZmfY-Z_tyyl9_LZSXytmo9q2M6GzZTulHTeFagL26OMKz5n2t_7HcGElpBtEEo3_bK6CCBtyPnDpKxHUg");'>
                        </div>
                    </div>
                </header>
                <!-- Page Content -->
                <div class="flex-1 p-10">
                    <div class="max-w-4xl mx-auto">
                        <!-- PageHeading -->
                        <div class="mb-8">
                            <p class="text-slate-900 dark:text-white text-3xl font-bold leading-tight tracking-tight">
                                Cadastro de Fornecedores</p>
                            <p class="text-slate-500 dark:text-slate-400 mt-1">Preencha os campos abaixo para adicionar
                                um novo fornecedor.</p>
                        </div>
                        <!-- Form Container -->
                        <div
                            class="bg-white dark:bg-slate-900 rounded-xl p-8 border border-slate-200 dark:border-slate-800">
                            <form class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- TextField: Razão Social -->
                                    <div class="flex flex-col">
                                        <label
                                            class="text-slate-800 dark:text-slate-300 text-sm font-medium leading-normal pb-2"
                                            for="razao-social">Razão Social</label>
                                        <input
                                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-slate-900 dark:text-slate-200 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-slate-300 dark:border-slate-700 bg-transparent dark:bg-slate-800/50 h-12 placeholder:text-slate-400 dark:placeholder:text-slate-500 p-3 text-sm font-normal leading-normal"
                                            id="razao-social" placeholder="Digite a razão social" type="text"
                                            value="" />
                                    </div>
                                    <!-- TextField: CNPJ -->
                                    <div class="flex flex-col">
                                        <label
                                            class="text-slate-800 dark:text-slate-300 text-sm font-medium leading-normal pb-2"
                                            for="cnpj">CNPJ</label>
                                        <input
                                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-slate-900 dark:text-slate-200 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-slate-300 dark:border-slate-700 bg-transparent dark:bg-slate-800/50 h-12 placeholder:text-slate-400 dark:placeholder:text-slate-500 p-3 text-sm font-normal leading-normal"
                                            id="cnpj" placeholder="XX.XXX.XXX/XXXX-XX" type="text" value="" />
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <label
                                        class="text-slate-800 dark:text-slate-300 text-sm font-medium leading-normal pb-2"
                                        for="contato">Nome de Contato</label>
                                    <input
                                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-slate-900 dark:text-slate-200 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-slate-300 dark:border-slate-700 bg-transparent dark:bg-slate-800/50 h-12 placeholder:text-slate-400 dark:placeholder:text-slate-500 p-3 text-sm font-normal leading-normal"
                                        id="contato" placeholder="Digite o nome do contato principal" type="text"
                                        value="" />
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="flex flex-col">
                                        <label
                                            class="text-slate-800 dark:text-slate-300 text-sm font-medium leading-normal pb-2"
                                            for="telefone">Telefone</label>
                                        <input
                                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-slate-900 dark:text-slate-200 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-slate-300 dark:border-slate-700 bg-transparent dark:bg-slate-800/50 h-12 placeholder:text-slate-400 dark:placeholder:text-slate-500 p-3 text-sm font-normal leading-normal"
                                            id="telefone" placeholder="(XX) XXXXX-XXXX" type="tel" value="" />
                                    </div>
                                    <div class="flex flex-col">
                                        <label
                                            class="text-slate-800 dark:text-slate-300 text-sm font-medium leading-normal pb-2"
                                            for="email">E-mail</label>
                                        <input
                                            class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-slate-900 dark:text-slate-200 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-slate-300 dark:border-slate-700 bg-transparent dark:bg-slate-800/50 h-12 placeholder:text-slate-400 dark:placeholder:text-slate-500 p-3 text-sm font-normal leading-normal"
                                            id="email" placeholder="contato@empresa.com" type="email" value="" />
                                    </div>
                                </div>
                                <div class="flex flex-col">
                                    <label
                                        class="text-slate-800 dark:text-slate-300 text-sm font-medium leading-normal pb-2"
                                        for="endereco">Endereço</label>
                                    <input
                                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-slate-900 dark:text-slate-200 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-slate-300 dark:border-slate-700 bg-transparent dark:bg-slate-800/50 h-12 placeholder:text-slate-400 dark:placeholder:text-slate-500 p-3 text-sm font-normal leading-normal"
                                        id="endereco" placeholder="Rua, Número, Bairro, Cidade - Estado" type="text"
                                        value="" />
                                </div>
                                <div class="flex flex-col">
                                    <label
                                        class="text-slate-800 dark:text-slate-300 text-sm font-medium leading-normal pb-2"
                                        for="observacoes">Observações</label>
                                    <textarea
                                        class="form-textarea flex w-full min-w-0 flex-1 resize-y overflow-hidden rounded-lg text-slate-900 dark:text-slate-200 focus:outline-0 focus:ring-2 focus:ring-primary/50 border border-slate-300 dark:border-slate-700 bg-transparent dark:bg-slate-800/50 min-h-[120px] placeholder:text-slate-400 dark:placeholder:text-slate-500 p-3 text-sm font-normal leading-normal"
                                        id="observacoes"
                                        placeholder="Adicione qualquer informação relevante sobre o fornecedor..."></textarea>
                                </div>
                                <div
                                    class="flex justify-end gap-4 pt-4 border-t border-slate-200 dark:border-slate-800">
                                    <button
                                        class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200 text-sm font-bold leading-normal tracking-wide hover:bg-slate-300 dark:hover:bg-slate-600"
                                        type="button">
                                        <span class="truncate">Cancelar</span>
                                    </button>
                                    <button
                                        class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-wide hover:bg-primary/90"
                                        type="submit">
                                        <span class="truncate">Salvar Fornecedor</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>