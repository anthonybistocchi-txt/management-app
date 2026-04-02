<!DOCTYPE html>
<html lang="pt-BR">
@vite(['resources/ts/pages/index/register-product.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cadastro de Produtos</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
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
    <div class="relative flex h-screen min-h-screen w-full flex-col bg-background-light dark:bg-background-dark text-[#0d141b] dark:text-slate-700">
        <div class="flex h-full w-full">

            @include('partials.sidebar-main', ['active' => 'products'])

            <div class="flex flex-1 flex-col overflow-y-auto">
                @include('partials.header-user')

                <main class="flex-1 p-8">
                    <div class="mx-auto max-w-4xl">
                        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <h1 class="text-3xl font-bold tracking-tight text-[#0d141b] dark:text-slate-100">Cadastro de produtos</h1>
                                <p class="text-base text-[#4c739a] dark:text-slate-400">Preencha os dados para cadastrar um novo produto.</p>
                            </div>
                        </div>

                        <div class="rounded-xl bg-white dark:bg-background-dark p-8 shadow-sm">
                            <form id="form-register-product" class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <div class="md:col-span-2">
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium dark:text-slate-700">Nome do produto*</p>
                                        <input id="input-product-name" type="text"
                                            class="form-input h-12 w-full rounded-lg border border-[#cfdbe7] bg-[#edf2f7] text-[#0d141b] dark:text-slate-700 placeholder:text-[#94a3b8] p-3 text-base"
                                            placeholder="Ex: Teclado mecanico" />
                                    </label>
                                </div>

                                <div>
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium dark:text-slate-700">Categoria*</p>
                                        <select id="select-product-category" class="h-12 rounded-lg"></select>
                                    </label>
                                </div>

                                <div>
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium dark:text-slate-700">Fornecedor*</p>
                                        <select id="select-product-provider" class="h-12 rounded-lg"></select>
                                    </label>
                                </div>

                                <div>
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium dark:text-slate-700">Preco*</p>
                                        <input id="input-product-price" type="text" inputmode="decimal"
                                            class="form-input h-12 w-full rounded-lg border border-[#cfdbe7] bg-[#edf2f7] text-[#0d141b] dark:text-slate-700 placeholder:text-[#94a3b8] p-3 text-base"
                                            placeholder="0,00" />
                                    </label>
                                </div>

                                <div>
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium dark:text-slate-700">Estoque inicial</p>
                                        <input id="input-product-quantity" type="number" min="0"
                                            class="form-input h-12 w-full rounded-lg border border-[#cfdbe7] bg-[#edf2f7] text-[#0d141b] dark:text-slate-700 placeholder:text-[#94a3b8] p-3 text-base"
                                            placeholder="0" />
                                    </label>
                                </div>

                                <div>
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium dark:text-slate-700">Localizacao do estoque</p>
                                        <select id="select-product-location" class="h-12 rounded-lg"></select>
                                    </label>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium dark:text-slate-700">Descricao</p>
                                        <textarea id="textarea-product-description" rows="4"
                                            class="form-textarea w-full rounded-lg border border-[#cfdbe7] bg-[#edf2f7] text-[#0d141b] dark:text-slate-700 placeholder:text-[#94a3b8] p-3 text-base"
                                            placeholder="Adicione detalhes do produto..."></textarea>
                                    </label>
                                </div>

                                <div class="md:col-span-2 mt-2 flex flex-wrap justify-end gap-3">
                                    <a href="{{ route('products') }}"
                                        class="flex items-center justify-center rounded-lg border border-slate-200 bg-white px-6 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">
                                        Cancelar
                                    </a>
                                    <button id="btn-product-save" type="submit"
                                        class="flex items-center justify-center rounded-lg bg-primary px-6 py-2 text-sm font-semibold text-white hover:bg-primary/90">
                                        Salvar produto
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>

                @include('partials.footer-main')
            </div>
        </div>
    </div>
</body>

</html>
