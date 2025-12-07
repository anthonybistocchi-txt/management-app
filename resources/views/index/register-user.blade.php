<!DOCTYPE html>

<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Cadastro de Clientes</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800;900&amp;display=swap"
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
        class="relative flex h-auto min-h-screen w-full flex-col bg-background-light dark:bg-background-dark group/design-root overflow-x-hidden">
        <div class="flex h-full w-full">
            <!-- SideNavBar -->
            <aside
                class="flex h-screen min-h-[700px] w-64 flex-col justify-between border-r border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark p-4 sticky top-0">
                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-3">
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                            data-alt="Admin user avatar"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCXNtgawGG7BKhJ_WTcAGOeErwldqBWO4WIJWRvgVcCEJTloNrNvGPzr6uUrnw7tLc1dMMPgJcJL-47zBK-FgV_suffUvMO2GvIqOHlc0oXS0dMu-Pp28iIiThh8Pymlp_19uKVL4s0zWswZkBElVQGdk1pSEy-0X7cTfo-HNJoSY-lvnDtLJvIANBcSbDy7I9jZELzVRbozZ-1tJBd2ZC0fvMEpU0C8zQAU3G5Gs_8GjiIm66hIg9u14LlVzUerXgjNSc6nJeIiD4");'>
                        </div>
                        <div class="flex flex-col">
                            <h1 class="text-slate-900 dark:text-slate-200 text-base font-medium leading-normal">Admin
                                User</h1>
                            <p class="text-slate-500 dark:text-slate-400 text-sm font-normal leading-normal">
                                admin@system.com</p>
                        </div>
                    </div>
                    <nav class="flex flex-col gap-2 mt-4">
                        <a class="flex items-center gap-3 px-3 py-2 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg"
                            href="#">
                            <span class="material-symbols-outlined">dashboard</span>
                            <p class="text-sm font-medium leading-normal">Dashboard</p>
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg"
                            href="#">
                            <span class="material-symbols-outlined">inventory_2</span>
                            <p class="text-sm font-medium leading-normal">Estoque</p>
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary/10 text-primary dark:bg-primary/20 dark:text-white"
                            href="#">
                            <span class="material-symbols-outlined"
                                style="font-variation-settings: 'FILL' 1">groups</span>
                            <p class="text-sm font-medium leading-normal">Clientes</p>
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg"
                            href="#">
                            <span class="material-symbols-outlined">manage_accounts</span>
                            <p class="text-sm font-medium leading-normal">Usuários</p>
                        </a>
                    </nav>
                </div>
                <div class="flex flex-col gap-1">
                    <button
                        class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] w-full gap-2 hover:bg-primary/90 transition-colors">
                        <span class="material-symbols-outlined">add</span>
                        <span class="truncate">Novo Cliente</span>
                    </button>
                    <div class="mt-4">
                        <a class="flex items-center gap-3 px-3 py-2 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg"
                            href="#">
                            <span class="material-symbols-outlined">help_outline</span>
                            <p class="text-sm font-medium leading-normal">Ajuda</p>
                        </a>
                        <a class="flex items-center gap-3 px-3 py-2 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg"
                            href="#">
                            <span class="material-symbols-outlined">logout</span>
                            <p class="text-sm font-medium leading-normal">Sair</p>
                        </a>
                    </div>
                </div>
            </aside>
            <!-- Main Content -->
            <main class="flex-1 flex-col">
                <!-- TopNavBar -->
                <header
                    class="flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 px-10 py-3 bg-white dark:bg-background-dark sticky top-0 z-10">
                    <div class="flex items-center gap-4 text-slate-900 dark:text-slate-200">
                        <div class="size-6 text-primary">
                            <svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M39.5563 34.1455V13.8546C39.5563 15.708 36.8773 17.3437 32.7927 18.3189C30.2914 18.916 27.263 19.2655 24 19.2655C20.737 19.2655 17.7086 18.916 15.2073 18.3189C11.1227 17.3437 8.44365 15.708 8.44365 13.8546V34.1455C8.44365 35.9988 11.1227 37.6346 15.2073 38.6098C17.7086 39.2069 20.737 39.5564 24 39.5564C27.263 39.5564 30.2914 39.2069 32.7927 38.6098C36.8773 37.6346 39.5563 35.9988 39.5563 34.1455Z"
                                    fill="currentColor"></path>
                                <path clip-rule="evenodd"
                                    d="M10.4485 13.8519C10.4749 13.9271 10.6203 14.246 11.379 14.7361C12.298 15.3298 13.7492 15.9145 15.6717 16.3735C18.0007 16.9296 20.8712 17.2655 24 17.2655C27.1288 17.2655 29.9993 16.9296 32.3283 16.3735C34.2508 15.9145 35.702 15.3298 36.621 14.7361C37.3796 14.246 37.5251 13.9271 37.5515 13.8519C37.5287 13.7876 37.4333 13.5973 37.0635 13.2931C36.5266 12.8516 35.6288 12.3647 34.343 11.9175C31.79 11.0295 28.1333 10.4437 24 10.4437C19.8667 10.4437 16.2099 11.0295 13.657 11.9175C12.3712 12.3647 11.4734 12.8516 10.9365 13.2931C10.5667 13.5973 10.4713 13.7876 10.4485 13.8519ZM37.5563 18.7877C36.3176 19.3925 34.8502 19.8839 33.2571 20.2642C30.5836 20.9025 27.3973 21.2655 24 21.2655C20.6027 21.2655 17.4164 20.9025 14.7429 20.2642C13.1498 19.8839 11.6824 19.3925 10.4436 18.7877V34.1275C10.4515 34.1545 10.5427 34.4867 11.379 35.027C12.298 35.6207 13.7492 36.2054 15.6717 36.6644C18.0007 37.2205 20.8712 37.5564 24 37.5564C27.1288 37.5564 29.9993 37.2205 32.3283 36.6644C34.2508 36.2054 35.702 35.6207 36.621 35.027C37.4573 34.4867 37.5485 34.1546 37.5563 34.1275V18.7877ZM41.5563 13.8546V34.1455C41.5563 36.1078 40.158 37.5042 38.7915 38.3869C37.3498 39.3182 35.4192 40.0389 33.2571 40.5551C30.5836 41.1934 27.3973 41.5564 24 41.5564C20.6027 41.5564 17.4164 41.1934 14.7429 40.5551C12.5808 40.0389 10.6502 39.3182 9.20848 38.3869C7.84205 37.5042 6.44365 36.1078 6.44365 34.1455L6.44365 13.8546C6.44365 12.2684 7.37223 11.0454 8.39581 10.2036C9.43325 9.3505 10.8137 8.67141 12.343 8.13948C15.4203 7.06909 19.5418 6.44366 24 6.44366C28.4582 6.44366 32.5797 7.06909 35.657 8.13948C37.1863 8.67141 38.5667 9.3505 39.6042 10.2036C40.6278 11.0454 41.5563 12.2684 41.5563 13.8546Z"
                                    fill="currentColor" fill-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h2
                            class="text-slate-900 dark:text-slate-200 text-lg font-bold leading-tight tracking-[-0.015em]">
                            Sistema de Gestão</h2>
                    </div>
                    <div class="flex flex-1 justify-end gap-4 items-center">
                        <button
                            class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-slate-100 dark:bg-slate-800 text-slate-900 dark:text-slate-200 gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5">
                            <span class="material-symbols-outlined">notifications</span>
                        </button>
                        <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                            data-alt="Admin user avatar"
                            style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuChz6DdqVDpSJhPvbpT2Vd5EWlBFeX-s9a-7EvHwhpH_J_dnqnLrY_MrCMC-JPOX6ToVdQXOfGt9QZiAAGAC41hQrlO3LOEKwnVnorZSXnY1EtccR_fJdnCjfybR9KXwH4VFWkc1AZKjl_jVSe5YRUy1_--ERCkarwf3F-5m_nyOMkSyj2DSc52g_vhfoshWGiIib-PmXayt0K1mo1OvFrlaP4B9HW7ULLKe5Aw8zurTYUvzApBMuwj_rf905pBAmHRaw9IC-wDgvE");'>
                        </div>
                    </div>
                </header>
                <!-- Page Content -->
                <div class="px-10 py-8">
                    <!-- Breadcrumbs -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        <a class="text-slate-500 dark:text-slate-400 text-sm font-medium leading-normal"
                            href="#">Home</a>
                        <span class="text-slate-500 dark:text-slate-400 text-sm font-medium leading-normal">/</span>
                        <a class="text-slate-500 dark:text-slate-400 text-sm font-medium leading-normal"
                            href="#">Clientes</a>
                        <span class="text-slate-500 dark:text-slate-400 text-sm font-medium leading-normal">/</span>
                        <span class="text-slate-900 dark:text-slate-200 text-sm font-medium leading-normal">Novo
                            Cadastro</span>
                    </div>
                    <!-- PageHeading -->
                    <div class="flex flex-wrap justify-between gap-3 mb-8">
                        <div class="flex min-w-72 flex-col gap-2">
                            <p
                                class="text-slate-900 dark:text-slate-50 text-3xl font-bold leading-tight tracking-[-0.033em]">
                                Cadastro de Clientes</p>
                            <p class="text-slate-500 dark:text-slate-400 text-base font-normal leading-normal">Preencha
                                os campos abaixo para registrar um novo cliente.</p>
                        </div>
                    </div>
                    <!-- Form Container -->
                    <div
                        class="bg-white dark:bg-slate-900/50 p-8 rounded-xl border border-slate-200 dark:border-slate-800">
                        <form action="#" class="flex flex-col gap-8" method="POST">
                            <!-- Dados Pessoais Section -->
                            <section>
                                <h2
                                    class="text-slate-900 dark:text-slate-50 text-lg font-bold leading-tight tracking-[-0.015em] pb-4 border-b border-slate-200 dark:border-slate-800">
                                    Dados Pessoais</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                    <div class="col-span-2">
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1"
                                            for="full-name">Nome Completo / Razão Social</label>
                                        <input
                                            class="w-full rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-200 focus:ring-primary focus:border-primary"
                                            id="full-name" placeholder="Ex: João da Silva" type="text" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1"
                                            for="cpf-cnpj">CPF / CNPJ</label>
                                        <input
                                            class="w-full rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-200 focus:ring-primary focus:border-primary"
                                            id="cpf-cnpj" placeholder="000.000.000-00" type="text" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1"
                                            for="phone">Telefone</label>
                                        <input
                                            class="w-full rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-200 focus:ring-primary focus:border-primary"
                                            id="phone" placeholder="(00) 00000-0000" type="tel" />
                                    </div>
                                    <div class="col-span-2">
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1"
                                            for="email">E-mail</label>
                                        <input
                                            class="w-full rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-200 focus:ring-primary focus:border-primary"
                                            id="email" placeholder="exemplo@email.com" type="email" />
                                    </div>
                                </div>
                            </section>
                            <!-- Endereço Section -->
                            <section>
                                <h2
                                    class="text-slate-900 dark:text-slate-50 text-lg font-bold leading-tight tracking-[-0.015em] pb-4 border-b border-slate-200 dark:border-slate-800">
                                    Endereço</h2>
                                <div class="grid grid-cols-1 md:grid-cols-6 gap-6 mt-6">
                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1"
                                            for="cep">CEP</label>
                                        <input
                                            class="w-full rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-200 focus:ring-primary focus:border-primary"
                                            id="cep" placeholder="00000-000" type="text" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1"
                                            for="street">Logradouro</label>
                                        <input
                                            class="w-full rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-200 focus:ring-primary focus:border-primary"
                                            id="street" placeholder="Ex: Av. Paulista" type="text" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1"
                                            for="number">Número</label>
                                        <input
                                            class="w-full rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-200 focus:ring-primary focus:border-primary"
                                            id="number" placeholder="123" type="text" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1"
                                            for="complement">Complemento</label>
                                        <input
                                            class="w-full rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-200 focus:ring-primary focus:border-primary"
                                            id="complement" placeholder="Apto 101" type="text" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1"
                                            for="neighborhood">Bairro</label>
                                        <input
                                            class="w-full rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-200 focus:ring-primary focus:border-primary"
                                            id="neighborhood" placeholder="Bela Vista" type="text" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1"
                                            for="city">Cidade</label>
                                        <input
                                            class="w-full rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-200 focus:ring-primary focus:border-primary"
                                            id="city" placeholder="São Paulo" type="text" />
                                    </div>
                                    <div class="col-span-6 sm:col-span-2">
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1"
                                            for="state">Estado</label>
                                        <select
                                            class="w-full rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-200 focus:ring-primary focus:border-primary"
                                            id="state">
                                            <option>Selecione</option>
                                            <option>SP</option>
                                            <option>RJ</option>
                                            <option>MG</option>
                                        </select>
                                    </div>
                                </div>
                            </section>
                            <!-- Observações Section -->
                            <section>
                                <h2
                                    class="text-slate-900 dark:text-slate-50 text-lg font-bold leading-tight tracking-[-0.015em] pb-4 border-b border-slate-200 dark:border-slate-800">
                                    Informações Adicionais</h2>
                                <div class="mt-6">
                                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1"
                                        for="observations">Observações</label>
                                    <textarea
                                        class="w-full rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-200 focus:ring-primary focus:border-primary"
                                        id="observations"
                                        placeholder="Insira qualquer informação adicional sobre o cliente..."
                                        rows="4"></textarea>
                                </div>
                            </section>
                            <!-- Action Buttons -->
                            <div class="flex justify-end gap-4 pt-6 border-t border-slate-200 dark:border-slate-800">
                                <button
                                    class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-6 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-sm font-bold leading-normal tracking-[0.015em] hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors"
                                    type="button">
                                    <span class="truncate">Cancelar</span>
                                </button>
                                <button
                                    class="flex min-w-[84px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-6 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-colors"
                                    type="submit">
                                    <span class="truncate">Salvar Cliente</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>