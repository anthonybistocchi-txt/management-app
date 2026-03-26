<!DOCTYPE html>
<html lang="en" data-has-subsidiaries="{{ filter_var(env('HAS_SUBSIDIARIES', false), FILTER_VALIDATE_BOOLEAN) ? 'true' : 'false' }}">
@vite(['resources/ts/pages/index/management-stock-out.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Saída de Estoque</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
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
    <div class="relative flex h-screen min-h-screen w-full flex-col bg-background-light dark:bg-background-dark text-[#0d141b] dark:text-slate-200">
        <div class="flex h-full w-full">

            @include('partials.sidebar-main', ['active' => 'stockOut'])

            <div class="flex flex-1 flex-col overflow-y-auto">
                @include('partials.header-user')

                <main class="p-8">
                    <div class="mx-auto max-w-4xl">
                        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <h1 class="text-3xl font-bold tracking-tight text-[#0d141b] dark:text-slate-100">Registrar venda</h1>
                                <p class="text-base text-[#4c739a] dark:text-slate-400">Preencha os dados abaixo para registrar a movimentação de venda.</p>
                            </div>
                        </div>

                        <div class="rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark p-8 shadow-sm">
                            <form class="grid grid-cols-1 gap-6 md:grid-cols-2" id="form-stock-out">

                                <div class="md:col-span-2">
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">Produto*</p>
                                        <select id="select-stock-product">
                                            <option value="" selected>Selecione um produto</option>
                                        </select>
                                    </label>
                                </div>

                                <div>
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">Quantidade*</p>
                                        <input id="input-stock-quantity" type="number" placeholder="0"
                                            class="form-input h-12 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 p-3 text-base" />
                                    </label>
                                </div>

                                <div>
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">Data da saída*</p>
                                        <input id="input-stock-date" type="text" 
                                            class="form-input h-12 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 p-3 text-base" />
                                    </label>
                                </div>

                                @if (env('HAS_SUBSIDIARIES'))
                                <div class="md:col-span-2">
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">Localização / Unidade*</p>
                                        <select id="select-stock-location">
                                            <option value="" selected>Selecione uma localização</option>
                                        </select>
                                    </label>
                                </div>
                                @endif

                                <div class="md:col-span-2">
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">Observações / Motivo</p>
                                        <textarea id="textarea-stock-description" rows="4"
                                            class="form-textarea w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 focus:border-primary focus:ring-2 focus:ring-primary/20 p-3 text-base"
                                            placeholder="Ex: Venda para cliente, descarte, transferência..."></textarea>
                                    </label>
                                </div>

                                <div class="md:col-span-2 mt-4 flex justify-end gap-3">
                                    <button id="btn-stock-save" type="submit"
                                        class="flex cursor-pointer items-center justify-center rounded-lg h-10 bg-primary text-white gap-2 text-sm font-bold px-6">
                                        Salvar
                                    </button>
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