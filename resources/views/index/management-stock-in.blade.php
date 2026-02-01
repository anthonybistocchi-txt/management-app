<!DOCTYPE html>
<html lang="en">
@vite(['resources/ts/pages/index/management-stock-in.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Entrada de Estoque</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        /* ID Padronizado do Logo */
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

            <aside id="sidebar-main"
                class="flex h-full w-64 flex-col justify-between bg-surface-blue text-text-white p-4">
                <div class="flex flex-col gap-8">
                    <div class="flex items-center justify-center px-2">
                        <div class="p-2 rounded-xl w-full shadow-sm flex items-center justify-center">
                            <img id="img-sidebar-logo" src="/images/logo.jpg" alt="Logo Empresa"
                                class="h-12 w-auto object-contain max-w-full">
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <a id="link-sidebar-dashboard" href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">dashboard</span>
                            <p class="text-sm font-semibold">Dashboard</p>
                        </a>

                        <a id="link-sidebar-stock-in" href="{{ route('stock') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/10 text-primary transition-colors">
                            <span class="material-symbols-outlined">inventory_2</span>
                            <p class="text-sm font-medium">Registrar entrada</p>
                        </a>

                        <a id="link-sidebar-users" href="{{ route('users') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">group</span>
                            <p class="text-sm font-medium">Operadores</p>
                        </a>

                        <a id="link-sidebar-stock-out" href="{{ route('stockOut') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            <p class="text-sm font-medium">Registrar venda</p>
                        </a>

                        <a id="link-sidebar-reports" href="#"
                            class="flex items-center gap-3 px-3 py-2.5 opacity-50 cursor-not-allowed">
                            <span class="material-symbols-outlined">summarize</span>
                            <p class="text-sm font-medium">Relatórios</p>
                        </a>

                        <a id="link-sidebar-providers" href="{{ route('providers') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">local_shipping</span>
                            <p class="text-sm font-medium">Fornecedores</p>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <a id="link-sidebar-settings"
                        class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-white hover:bg-primary/10 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined text-2xl">settings</span>
                        <p class="text-sm font-medium">Configurações</p>
                    </a>
                    <a id="link-sidebar-logout"
                        class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-white hover:bg-primary/10 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined text-2xl">logout</span>
                        <p class="text-sm font-medium">Sair</p>
                    </a>
                </div>
            </aside>

            <div class="flex flex-1 flex-col overflow-y-auto">
                <header
                    class="flex h-16 items-center justify-end whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark px-8">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-3">
                            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                                data-alt="User avatar image"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDi65Kk7LckmcrS0auPUyvjF94HASToPWM2d3WnpsZxslUUCKNs7xA7mxUSf0AVxlCmiREoOoQG7Rdmpu1I8kWDLom4l-GLvDIzJsagJYxZ87ey45xNUNMyXhLkVNpZYoabM-59t-X6Z939OpdLFfNg9owdAGbCiWMG9FWNI-T29RPcy4QpMF5JNjFr2ScdBqBS3HqG7AKXLe8T5wXQ9ANUcyQqyk72El6Xu_MI_KsYkHTccu6cly77v2AqjCdfaWh0jLWhIyds3q0");'>
                            </div>
                            <div class="flex flex-col text-sm">
                                <h1 id="text-header-username" class="font-medium text-[#0d141b] dark:text-slate-200">
                                </h1>
                                <p id="text-header-role" class="text-[#4c739a] dark:text-slate-400"></p>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="p-8">
                    <div class="mx-auto max-w-4xl">
                        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <h1 class="text-3xl font-bold tracking-tight text-[#0d141b] dark:text-slate-100">Entrada
                                    de Estoque</h1>
                                <p class="text-base text-[#4c739a] dark:text-slate-400">Preencha os campos abaixo para
                                    registrar a entrada de itens no estoque.</p>
                            </div>
                        </div>

                        <div
                            class="rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark p-8 shadow-sm">

                            <form class="grid grid-cols-1 gap-6 md:grid-cols-2" id="form-stock-in">

                                <div class="md:col-span-2">
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">Produto*
                                        </p>
                                        <select id="select-stock-product"
                                            class="form-select h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 p-3 text-base font-normal">
                                            <option value="" selected>Selecione um produto</option>
                                        </select>
                                    </label>
                                </div>

                                <div>
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">
                                            Quantidade*</p>
                                        <input id="input-stock-quantity"
                                            class="form-input h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 p-3 text-base font-normal"
                                            placeholder="0" type="number" value="" />
                                    </label>
                                </div>

                                <div>
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">
                                            Fornecedor*</p>
                                        <select id="select-stock-provider"
                                            class="form-select h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 p-3 text-base font-normal">
                                            <option value="" selected >Selecione um fornecedor</option>
                                        </select>
                                    </label>
                                </div>

                                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="{{ env('HAS_SUBSIDIARIES') ? 'md:col-span-1' : 'md:col-span-2' }}">
                                        <label class="flex flex-col">
                                            <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">
                                                Data da entrada*</p>
                                            <input id="input-stock-date" type="text" 
                                                class="form-input h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 p-3 text-base font-normal" />
                                        </label>
                                    </div>

                                    @if (env('HAS_SUBSIDIARIES'))
                                        <div class="md:col-span-1">
                                            <label class="flex flex-col">
                                                <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">
                                                    Localização*</p>
                                                <select id="select-stock-location"
                                                    class="form-select h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 p-3 text-base font-normal">
                                                    <option value="" selected >Selecione uma localização</option>
                                                </select>
                                            </label>
                                        </div>
                                    @endif
                                </div>

                                <div class="md:col-span-2">
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">Descrição
                                        </p>
                                        <textarea id="textarea-stock-description"
                                            class="form-textarea w-full min-w-0 flex-1 resize-y overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 p-3 text-base font-normal"
                                            placeholder="Adicione notas adicionais, se necessário..."
                                            rows="4"></textarea>
                                    </label>
                                </div>

                                <div class="md:col-span-2 mt-4 flex justify-end gap-3">
                                    <button id="btn-stock-save"
                                        class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 bg-primary text-white gap-2 text-sm font-bold min-w-0 px-6"
                                        type="submit">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>

</html>