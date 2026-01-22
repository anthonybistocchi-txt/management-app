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
    </style>
</head>

<body class="font-display">
    <div
        class="relative flex h-screen min-h-screen w-full flex-col bg-background-light dark:bg-background-dark text-[#0d141b] dark:text-slate-200">
        <div class="flex h-full w-full">

            <aside class="flex h-full w-64 flex-col justify-between bg-surface-blue text-text-white p-4">
                <div class="flex flex-col gap-8">
                    <div class="flex items-center justify-center px-2">
                        <div class="p-2 rounded-xl w-full shadow-sm flex items-center justify-center">
                            <img id="logo" src="/images/logo.jpg" alt="Logo Empresa"
                                class="h-12 w-auto object-contain max-w-full">
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        {{-- Dashboard --}}
                        <a href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary">
                            <span class="material-symbols-outlined">dashboard</span>
                            <p class="text-sm font-semibold">Dashboard</p>
                        </a>

                        {{-- Entrada de estoque (ATIVO) --}}
                        <a href="{{ route('stock') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/10 text-primary">
                            <span class="material-symbols-outlined">inventory_2</span>
                            <p class="text-sm font-medium">Entrada de stock</p>
                        </a>

                        {{-- Usuários --}}
                        <a href="{{ route('users') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary">
                            <span class="material-symbols-outlined">group</span>
                            <p class="text-sm font-medium">Usuários</p>
                        </a>

                        {{-- Registrar venda --}}
                        <a href="{{ route('stockOut') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary">
                            <span class="material-symbols-outlined">inventory_2</span>
                            <p class="text-sm font-medium">Registrar venda</p>
                        </a>

                        {{-- Relatórios --}}
                        <a href="#" class="flex items-center gap-3 px-3 py-2.5 opacity-50 cursor-not-allowed">
                            <span class="material-symbols-outlined">summarize</span>
                            <p class="text-sm font-medium">Relatórios</p>
                        </a>

                        {{-- Fornecedores --}}
                        <a href="{{ route('providers') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary">
                            <span class="material-symbols-outlined">group</span>
                            <p class="text-sm font-medium">Fornecedores</p>
                        </a>
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-white hover:bg-primary/10 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined text-2xl">settings</span>
                        <p class="text-sm font-medium">Configurações</p>
                    </a>
                    <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-white hover:bg-primary/10 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined text-2xl">logout</span>
                        <p class="text-sm font-medium">Sair</p>
                    </a>
                </div>
            </aside>

            <div class="flex flex-1 flex-col">
                <header
                    class="flex h-16 items-center justify-end whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark px-8">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-3">
                            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                                data-alt="User avatar image"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDi65Kk7LckmcrS0auPUyvjF94HASToPWM2d3WnpsZxslUUCKNs7xA7mxUSf0AVxlCmiREoOoQG7Rdmpu1I8kWDLom4l-GLvDIzJsagJYxZ87ey45xNUNMyXhLkVNpZYoabM-59t-X6Z939OpdLFfNg9owdAGbCiWMG9FWNI-T29RPcy4QpMF5JNjFr2ScdBqBS3HqG7AKXLe8T5wXQ9ANUcyQqyk72El6Xu_MI_KsYkHTccu6cly77v2AqjCdfaWh0jLWhIyds3q0");'>
                            </div>
                            <div class="flex flex-col text-sm">
                                <h1 id="username" class="font-medium text-[#0d141b] dark:text-slate-200"></h1>
                                <p id="type_user_id" class="text-[#4c739a] dark:text-slate-400"></p>
                            </div>
                        </div>
                    </div>
                </header>
                <main class="flex-1 overflow-y-auto p-8">
                    <div class="mx-auto max-w-4xl">
                        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <h1 class="text-3xl font-bold tracking-tight text-[#0d141b] dark:text-slate-100">Entrada
                                    de Estoque</h1>
                                <p class="text-base text-[#4c739a] dark:text-slate-400">Preencha os campos abaixo para
                                    registrar a entrada de itens no estoque.</p>
                            </div>
                            <!-- <button id="btn-add-product"
                                class="flex h-12 items-center justify-center rounded-lg bg-primary text-white px-6 text-sm font-bold">
                                Adicionar novo produto
                            </button> -->
                        </div>
                        <div
                            class="rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark p-8 shadow-sm">
                            <form class="grid grid-cols-1 gap-6 md:grid-cols-2" id="form">
                                <div class="md:col-span-2">
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">Produto*
                                        </p>
                                        <select id="products"
                                            class="form-select h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 p-3 text-base font-normal">
                                            <option>Selecione um produto</option>
                                        </select>
                                    </label>
                                </div>
                                <div>
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">
                                            Quantidade*</p>
                                        <input id="quantity"
                                            class="form-input h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 p-3 text-base font-normal"
                                            placeholder="0" type="number" value="" />
                                    </label>
                                </div>
                                <div>
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">
                                            Fornecedor*
                                        </p>
                                        <select id="providers"
                                            class="form-select h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 p-3 text-base font-normal">
                                            <option>Selecione um fornecedor</option>
                                        </select>
                                    </label>
                                </div>

                                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">

                                    <div class="{{ env('HAS_SUBSIDIARIES') ? 'md:col-span-1' : 'md:col-span-2' }}">
                                        <label class="flex flex-col">
                                            <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">
                                                Data da Entrada
                                            </p>
                                            <input id="date_picker" type="text" placeholder="Selecione a data" class="form-input h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg 
                                            border border-[#cfdbe7] dark:border-slate-700 
                                            bg-background-light dark:bg-slate-800 
                                            text-[#0d141b] dark:text-slate-200 
                                            placeholder:text-[#4c739a] 
                                            focus:border-primary focus:outline-0 
                                            focus:ring-2 focus:ring-primary/20 
                                            p-3 text-base font-normal" />
                                        </label>
                                    </div>

                                    @if (env('HAS_SUBSIDIARIES'))
                                                        <div class="md:col-span-1">
                                                            <label class="flex flex-col">
                                                                <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">
                                                                    Localização*
                                                                </p>
                                                                <select id="locations" class="form-select h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg 
                                                                    border border-[#cfdbe7] dark:border-slate-700 
                                                                    bg-background-light dark:bg-slate-800 
                                                                    text-[#0d141b] dark:text-slate-200 
                                                                    placeholder:text-[#4c739a] 
                                                                    focus:border-primary focus:outline-0 
                                                                    focus:ring-2 focus:ring-primary/20 
                                                                    p-3 text-base font-normal">
                                                                    <option>Selecione uma Localização</option>
                                                                </select>
                                                            </label>
                                                        </div>
                                    @endif

                                </div>

                                <div class="md:col-span-2">
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">
                                            Observações</p>
                                        <textarea id="observations"
                                            class="form-textarea w-full min-w-0 flex-1 resize-y overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 p-3 text-base font-normal"
                                            placeholder="Adicione notas adicionais, se necessário..."
                                            rows="4"></textarea>
                                    </label>
                                </div>
                                <div class="md:col-span-2 mt-4 flex justify-end gap-3">
                                    <button id="cancel"
                                        class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 bg-slate-200 dark:bg-slate-700 text-[#0d141b] dark:text-slate-200 gap-2 text-sm font-bold min-w-0 px-6"
                                        type="button">Cancelar</button>
                                    <button id="btn-save"
                                        class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 bg-primary text-white gap-2 text-sm font-bold min-w-0 px-6"
                                        type="submit">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <!-- MODAL OVERLAY-->
    <div id="modal-product" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
        <div class="w-full max-w-lg rounded-xl bg-white dark:bg-background-dark p-6 shadow-lg">

            <!-- HEADER -->
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-[#0d141b] dark:text-slate-200">
                    Adicionar novo produto
                </h2>

                <button id="close-modal" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                    ✕
                </button>
            </div>

            <!-- BODY -->
            <form id="form-new-product">

                <!-- Nome -->
                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">
                        Nome do produto
                    </label>
                    <input id="name-new-product" type="text" placeholder="Ex: Teclado Mecânico" class="h-11 w-full rounded-lg border border-[#cfdbe7]
                   dark:border-slate-700
                   bg-background-light dark:bg-slate-800
                   px-3 text-sm
                   text-[#0d141b] dark:text-slate-200
                   placeholder:text-slate-400
                   focus:border-primary focus:outline-none
                   focus:ring-2 focus:ring-primary/20" />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">
                        Fornecedor
                    </label>
                    <select id="provider-new-product" type="text" placeholder="Nome do fornecedor" class="h-11 w-full rounded-lg border border-[#cfdbe7]
                   dark:border-slate-700
                   bg-background-light dark:bg-slate-800
                   px-3 text-sm
                   text-[#0d141b] dark:text-slate-200
                   placeholder:text-slate-400
                   focus:border-primary focus:outline-none
                   focus:ring-2 focus:ring-primary/20">
                        <option  >Selecione um fornecedor</option>
                    </select>
                </div>

                <!-- Preço -->
                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">
                        Preço
                    </label>
                    <input id="price-new-product" type="text" placeholder="R$ 0,00" class="h-11 w-full rounded-lg border border-[#cfdbe7]
                   dark:border-slate-700
                   bg-background-light dark:bg-slate-800
                   px-3 text-sm
                   text-[#0d141b] dark:text-slate-200
                   placeholder:text-slate-400
                   focus:border-primary focus:outline-none
                   focus:ring-2 focus:ring-primary/20" />
                </div>

                <!-- Descrição -->
                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">
                        Descrição
                    </label>
                    <input id="description-new-product" type="text" placeholder="Descrição curta do produto" class="h-11 w-full rounded-lg border border-[#cfdbe7]
                   dark:border-slate-700
                   bg-background-light dark:bg-slate-800
                   px-3 text-sm
                   text-[#0d141b] dark:text-slate-200
                   placeholder:text-slate-400
                   focus:border-primary focus:outline-none
                   focus:ring-2 focus:ring-primary/20" />
                </div>


                <!-- FOOTER -->
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" id="cancel-modal" class="h-10 px-4 rounded-lg bg-slate-200
                   dark:bg-slate-700 text-sm font-medium">
                        Cancelar
                    </button>

                    <button id="save-new-product" type="submit" class="h-10 px-4 rounded-lg bg-primary
                   text-white text-sm font-semibold">
                        Salvar
                    </button>
                </div>

            </form>

        </div>
    </div>

</body>

<style>
    #logo {
        width: 50%;
        height: 50%;
        border-radius: 8px;
    }
</style>

</html>