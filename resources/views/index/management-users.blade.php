<!DOCTYPE html>
<html lang="en">
@vite(['resources/ts/pages/index/management-users.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestão de Usuários</title>
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
    <div
        class="relative flex h-screen min-h-screen w-full flex-col bg-background-light dark:bg-background-dark text-[#0d141b] dark:text-slate-200">
        <div class="flex h-full w-full">

            @include('partials.sidebar-main', ['active' => 'users'])

            <div class="flex flex-1 flex-col overflow-y-auto">

                @include('partials.header-user')

                <main class="p-8">
                    <div class="mx-auto max-w-7xl">

                        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <h1 class="text-3xl font-bold tracking-tight text-[#0d141b]">Gestão
                                    de operadores</h1>
                                <p class="text-base text-[#4c739a] dark:text-slate-400">Gerencie os usuários do sistema,
                                    adicione novos, edite perfis e altere status.</p>
                            </div>

                            <button id="btn-open-create-user"
                                class="flex h-10 items-center justify-center rounded-lg bg-primary text-white px-6 text-sm font-bold gap-2 hover:bg-primary/90 transition-colors">
                                <span class="material-symbols-outlined text-xl">add</span>
                                Adicionar operador
                            </button>
                        </div>

                        <div
                            class="mb-6 flex flex-col sm:flex-row gap-4 justify-between items-center rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark p-4 shadow-sm">
                            <div class="w-full sm:max-w-xs relative">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-3 text-[#4c739a]">search</span>
                                <input id="input-search-user"
                                    class="form-input h-10 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] bg-background-light  text-[#0d141b] dark:text-slate-800 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 pl-10 pr-4 text-base font-normal"
                                    placeholder="Buscar por nome" value="" />
                            </div>
                            <div class="flex gap-2 w-full sm:w-auto">
                                <div class="relative w-full sm:w-48">
                                    <select id="select-filter-type-user"
                                        class="form-select h-10 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light text-[#0d141b] dark:text-slate-800 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 px-3 text-base font-normal">
                                        <option value="all">Tipos de operadores</option>
                                        <option value="all">Todos</option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Gestor</option>
                                        <option value="3">Operador</option>
                                    </select>
                                </div>
                                <div class="relative w-full sm:w-48">
                                    <select id="select-filter-status"
                                        class="form-select h-10 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light text-[#0d141b] dark:text-slate-800 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 px-3 text-base font-normal">
                                        <option value="all">Status</option>
                                        <option value="all">Todos</option>
                                        <option value="1">Ativo</option>
                                        <option value="0">Inativo</option>
                                    </select>
                                </div>

                            </div>
                            <button id="btn-submit-search-user"
                                class="flex h-10 items-center justify-center rounded-lg bg-primary text-white px-6 text-sm font-bold gap-2 hover:bg-primary/90 transition-colors">
                                <span class="material-symbols-outlined text-xl">search</span>
                                Buscar
                            </button>
                        </div>

                        <div
                            class="rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark shadow-sm overflow-hidden">
                            <div class="overflow-x-auto">

                                <table id="table-users"
                                    class="w-full text-sm text-left text-[#4c739a] dark:text-slate-400"></table>
                            </div>
                        </div>

                    </div>
                </main>
            </div>
        </div>
    </div>

    @include('modals.create-user')
    @include('modals.edit-user')
</body>

</html>