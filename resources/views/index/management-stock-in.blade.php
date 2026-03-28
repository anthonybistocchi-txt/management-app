<!DOCTYPE html>
<html lang="en" data-has-subsidiaries="{{ filter_var(env('HAS_SUBSIDIARIES', false), FILTER_VALIDATE_BOOLEAN) ? 'true' : 'false' }}">
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
        class="relative flex h-screen min-h-screen w-full flex-col bg-background-light dark:bg-background-dark dark:text-slate-200">
        <div class="flex h-full w-full">

            @include('partials.sidebar-main', ['active' => 'stock'])

            <div class="flex flex-1 flex-col overflow-y-auto">
                @include('partials.header-user')

                <main class="p-8">
                    <div class="mx-auto max-w-4xl">
                        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <h1 class="text-3xl font-bold tracking-tight text-[#0d141b] dark:text-slate-800">Entrada
                                    de Estoque</h1>
                                <p class="text-base text-[#4c739a] dark:text-slate-500">Preencha os campos abaixo para
                                    registrar a entrada de itens no estoque.</p>
                            </div>
                        </div>

                        <div
                            class="rounded-xl bg-white dark:bg-background-dark p-8 shadow-sm">

                            <form class="grid grid-cols-1 gap-6 md:grid-cols-2" id="form-stock-in">

                                <div class="md:col-span-2">
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium dark:text-slate-700">Produto*
                                        </p>
                                        <select id="select-stock-product">
                                            <option value="" selected>Selecione um produto</option>
                                        </select>
                                    </label>
                                </div>

                                <div>
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium dark:text-slate-700">
                                            Quantidade*</p>
                                        <input id="input-stock-quantity"
                                            class="form-input h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7]  bg-[#edf2f7] text-[#0d141b] dark:text-slate-700 placeholder:text-[#94a3b8] dark:placeholder:text-slate-500  p-3 text-base font-normal"
                                            placeholder="0" type="number" value="" />
                                    </label>
                                </div>

                                <div>
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium dark:text-slate-700">
                                            Fornecedor*</p>
                                        <select id="select-stock-provider">
                                            <option value="" selected>Selecione um fornecedor</option>
                                        </select>
                                    </label>
                                </div>

                                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="{{ env('HAS_SUBSIDIARIES') ? 'md:col-span-1' : 'md:col-span-2' }}">
                                        <label class="flex flex-col">
                                            <p class="pb-2 text-sm font-medium dark:text-slate-700">
                                                Data da entrada*</p>
                                            <input id="input-stock-date" type="text" 
                                                class="form-input h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7]  bg-[#edf2f7] text-[#0d141b] dark:text-slate-700 placeholder:text-[#94a3b8] dark:placeholder:text-slate-500  p-3 text-base font-normal" />
                                        </label>
                                    </div>

                                    @if (env('HAS_SUBSIDIARIES'))
                                        <div class="md:col-span-1">
                                            <label class="flex flex-col">
                                                <p class="pb-2 text-sm font-medium dark:text-slate-700">
                                                    Localização*</p>
                                                <select id="select-stock-location">
                                                    <option value="" selected>Selecione uma localização</option>
                                                </select>
                                            </label>
                                        </div>
                                    @endif
                                </div>

                                <div class="md:col-span-2">
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium dark:text-slate-700">Descrição
                                        </p>
                                        <textarea id="textarea-stock-description"
                                            class="form-textarea w-full min-w-0 flex-1 resize-y overflow-hidden rounded-lg border border-[#cfdbe7]  bg-[#edf2f7] text-[#0d141b] dark:text-slate-700 placeholder:text-[#94a3b8] dark:placeholder:text-slate-500 p-3 text-base font-normal"
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

                @include('partials.footer-main')
            </div>
        </div>
    </div>
</body>

</html>