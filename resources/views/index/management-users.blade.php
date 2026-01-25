<!DOCTYPE html>
<html lang="en">
@vite(['resources/ts/pages/index/management-users.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
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
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">inventory_2</span>
                            <p class="text-sm font-medium">Registrar entrada</p>
                        </a>

                        <a id="link-sidebar-users" href="{{ route('users') }}"
                            class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/10 text-primary transition-colors">
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
                                <p id="text-header-type-user" class="text-[#4c739a] dark:text-slate-400"></p>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="p-8">
                    <div class="mx-auto max-w-7xl">

                        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <h1 class="text-3xl font-bold tracking-tight text-[#0d141b] dark:text-slate-100">Gestão
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
                                    class="form-input h-10 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 pl-10 pr-4 text-base font-normal"
                                    placeholder="Buscar por nome" value="" />
                            </div>
                            <div class="flex gap-2 w-full sm:w-auto">
                                <div class="relative w-full sm:w-48">
                                    <select id="select-filter-type-user"
                                        class="form-select h-10 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 px-3 text-base font-normal">
                                        <option>Tipos de operadores</option>
                                        <option>Administrador</option>
                                        <option>Operador</option>
                                    </select>
                                </div>
                                <div class="relative w-full sm:w-48">
                                    <select id="select-filter-status"
                                        class="form-select h-10 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 px-3 text-base font-normal">
                                        <option>Todos os status</option>
                                        <option>Ativo</option>
                                        <option>Inativo</option>
                                    </select>
                                </div>

                            </div>
                            <button id="btn-submit-searc-user"
                                class="flex h-10 items-center justify-center rounded-lg bg-primary text-white px-6 text-sm font-bold gap-2 hover:bg-primary/90 transition-colors">
                                <span class="material-symbols-outlined text-xl">search</span>
                                Buscar
                            </button>
                        </div>

                        <div
                            class="rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark shadow-sm overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-[#4c739a] dark:text-slate-400">
                                    <thead
                                        class="text-xs uppercase bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-300 border-b border-slate-200 dark:border-slate-700">
                                        <tr>
                                            <th class="px-6 py-4 font-bold" scope="col">Nome</th>
                                            <th class="px-6 py-4 font-bold" scope="col">Username</th>
                                            <th class="px-6 py-4 font-bold" scope="col">Email</th>
                                            <th class="px-6 py-4 font-bold" scope="col">CPF</th>
                                            <th class="px-6 py-4 font-bold" scope="col">Tipo de usuário</th>
                                            <th class="px-6 py-4 font-bold" scope="col">Status</th>
                                            <th class="px-6 py-4 font-bold text-right" scope="col">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-users" class="divide-y divide-slate-100 dark:divide-slate-700">
                                        
                                    </tbody>
                                </table>
                            </div>

                            <div
                                class="flex items-center justify-between p-4 border-t border-slate-200 dark:border-slate-800">
                                <span class="text-sm font-normal text-[#4c739a] dark:text-slate-400">Exibindo <span
                                        class="font-semibold text-[#0d141b] dark:text-white">1-3</span> de <span
                                        class="font-semibold text-[#0d141b] dark:text-white">100</span></span>
                                <div class="flex gap-2">
                                    <button id="btn-pagination-prev"
                                        class="flex h-8 items-center justify-center rounded-lg bg-primary text-white px-6 text-sm font-bold gap-2 hover:bg-primary/90 transition-colors">
                                        Anterior
                                    </button>
                                    <button id="btn-pagination-next"
                                        class="flex h-8 items-center justify-center rounded-lg bg-primary text-white px-6 text-sm font-bold gap-2 hover:bg-primary/90 transition-colors">
                                        Próximo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <div id="modal-create-user" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
        <div class="w-full max-w-lg rounded-xl bg-white dark:bg-background-dark p-6 shadow-lg">

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-[#0d141b] dark:text-slate-200">
                    Adicionar novo usuário
                </h2>
                <button id="btn-modal-close" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                    ✕
                </button>
            </div>

            <form id="form-create-user" class="mt-4">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">

                    <div class="flex flex-col gap-1 md:col-span-2"> <label
                            class="text-sm font-medium text-[#0d141b] dark:text-slate-300">
                            Nome completo*
                        </label>
                        <input id="input-create-name" type="text" placeholder="Ex: João Silva" value=""
                            class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200 placeholder:text-slate-400 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">
                            Username*
                        </label>
                        <input id="input-create-username" type="text" placeholder="Ex: joaosilva" value=""
                            class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200 placeholder:text-slate-400 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">
                            CPF*
                        </label>
                        <input id="input-create-cpf" type="text" placeholder="Ex: 123.456.789-00" value=""
                            maxlength="14"
                            class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200 placeholder:text-slate-400 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all" />
                    </div>

                    <div class="flex flex-col gap-1 md:col-span-2"> <label
                            class="text-sm font-medium text-[#0d141b] dark:text-slate-300">
                            Email*
                        </label>
                        <input id="input-create-email" type="email" placeholder="Ex: joao.silva@example.com" value=""
                            class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200 placeholder:text-slate-400 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">
                            Senha*
                        </label>
                        <input id="input-create-password" type="password" value=""
                            class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200 placeholder:text-slate-400 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all" />
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">
                            Tipo de permissão*
                        </label>
                        <select id="select-create-type-user" value=""
                            class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                            <option value="" disabled selected>Selecione um perfil</option>
                            <option value="1">Administrador</option>
                            <option value="2">Gestor</option>
                            <option value="3">Usuário</option>
                        </select>
                    </div>

                </div>

                <div class="mt-8 flex justify-end gap-3 border-t border-slate-100 dark:border-slate-700 pt-5">
                    <button type="button" id="btn-modal-cancel"
                        class="h-11 px-6 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 text-sm font-semibold transition-colors">
                        Cancelar
                    </button>

                    <button id="btn-modal-save" type="submit"
                        class="h-11 px-6 rounded-lg bg-primary hover:bg-primary/90 text-white text-sm font-semibold shadow-sm transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        Salvar
                    </button>
                </div>

            </form>

        </div>
    </div>
</body>

</html>