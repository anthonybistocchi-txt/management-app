<!DOCTYPE html>

<html lang="en">
@vite(['resources/ts/pages/index/management-stock-out.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Entrada de Estoque</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap"
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
        class="relative flex h-screen min-h-screen w-full flex-col bg-background-light dark:bg-background-dark text-[#0d141b] dark:text-slate-200">
        <div class="flex h-full w-full">
            <!-- SideNavBar -->
            <aside
                class="flex h-full w-64 flex-col justify-between border-r border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark p-4">
                <div class="flex flex-col gap-8">
                    <div class="flex items-center gap-3 px-3">
                        <div class="size-8 text-primary">
                            <svg fill="none" viewbox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_6_543)">
                                    <path
                                        d="M42.1739 20.1739L27.8261 5.82609C29.1366 7.13663 28.3989 10.1876 26.2002 13.7654C24.8538 15.9564 22.9595 18.3449 20.6522 20.6522C18.3449 22.9595 15.9564 24.8538 13.7654 26.2002C10.1876 28.3989 7.13663 29.1366 5.82609 27.8261L20.1739 42.1739C21.4845 43.4845 24.5355 42.7467 28.1133 40.548C30.3042 39.2016 32.6927 37.3073 35 35C37.3073 32.6927 39.2016 30.3042 40.548 28.1133C42.7467 24.5355 43.4845 21.4845 42.1739 20.1739Z"
                                        fill="currentColor"></path>
                                    <path clip-rule="evenodd"
                                        d="M7.24189 26.4066C7.31369 26.4411 7.64204 26.5637 8.52504 26.3738C9.59462 26.1438 11.0343 25.5311 12.7183 24.4963C14.7583 23.2426 17.0256 21.4503 19.238 19.238C21.4503 17.0256 23.2426 14.7583 24.4963 12.7183C25.5311 11.0343 26.1438 9.59463 26.3738 8.52504C26.5637 7.64204 26.4411 7.31369 26.4066 7.24189C26.345 7.21246 26.143 7.14535 25.6664 7.1918C24.9745 7.25925 23.9954 7.5498 22.7699 8.14278C20.3369 9.32007 17.3369 11.4915 14.4142 14.4142C11.4915 17.3369 9.32007 20.3369 8.14278 22.7699C7.5498 23.9954 7.25925 24.9745 7.1918 25.6664C7.14534 26.143 7.21246 26.345 7.24189 26.4066ZM29.9001 10.7285C29.4519 12.0322 28.7617 13.4172 27.9042 14.8126C26.465 17.1544 24.4686 19.6641 22.0664 22.0664C19.6641 24.4686 17.1544 26.465 14.8126 27.9042C13.4172 28.7617 12.0322 29.4519 10.7285 29.9001L21.5754 40.747C21.6001 40.7606 21.8995 40.931 22.8729 40.7217C23.9424 40.4916 25.3821 39.879 27.0661 38.8441C29.1062 37.5904 31.3734 35.7982 33.5858 33.5858C35.7982 31.3734 37.5904 29.1062 38.8441 27.0661C39.879 25.3821 40.4916 23.9425 40.7216 22.8729C40.931 21.8995 40.7606 21.6001 40.747 21.5754L29.9001 10.7285ZM29.2403 4.41187L43.5881 18.7597C44.9757 20.1473 44.9743 22.1235 44.6322 23.7139C44.2714 25.3919 43.4158 27.2666 42.252 29.1604C40.8128 31.5022 38.8165 34.012 36.4142 36.4142C34.012 38.8165 31.5022 40.8128 29.1604 42.252C27.2666 43.4158 25.3919 44.2714 23.7139 44.6322C22.1235 44.9743 20.1473 44.9757 18.7597 43.5881L4.41187 29.2403C3.29027 28.1187 3.08209 26.5973 3.21067 25.2783C3.34099 23.9415 3.8369 22.4852 4.54214 21.0277C5.96129 18.0948 8.43335 14.7382 11.5858 11.5858C14.7382 8.43335 18.0948 5.9613 21.0277 4.54214C22.4852 3.8369 23.9415 3.34099 25.2783 3.21067C26.5973 3.08209 28.1187 3.29028 29.2403 4.41187Z"
                                        fill="currentColor" fill-rule="evenodd"></path>
                                </g>
                                <defs>
                                    <clippath id="clip0_6_543">
                                        <rect fill="white" height="48" width="48"></rect>
                                    </clippath>
                                </defs>
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold tracking-[-0.015em] text-[#0d141b] dark:text-slate-200">Logo da
                            Empresa</h2>
                    </div>
                    <div class="flex flex-col gap-2">
                        <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-[#4c739a] dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800"
                            href="#">
                            <span class="material-symbols-outlined text-2xl">dashboard</span>
                            <p class="text-sm font-medium">Dashboard</p>
                        </a>
                        <a class="flex items-center gap-3 rounded-lg bg-primary/10 px-3 py-2 text-primary dark:bg-primary/20 dark:text-white"
                            href="#">
                            <span class="material-symbols-outlined text-2xl"
                                style="font-variation-settings: 'FILL' 1;">inventory</span>
                            <p class="text-sm font-medium">Entrada de Estoque</p>
                        </a>
                        <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-[#4c739a] dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800"
                            href="#">
                            <span class="material-symbols-outlined text-2xl">widgets</span>
                            <p class="text-sm font-medium">Produtos</p>
                        </a>
                        <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-[#4c739a] dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800"
                            href="#">
                            <span class="material-symbols-outlined text-2xl">group</span>
                            <p class="text-sm font-medium">Fornecedores</p>
                        </a>
                        <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-[#4c739a] dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800"
                            href="#">
                            <span class="material-symbols-outlined text-2xl">assessment</span>
                            <p class="text-sm font-medium">Relatórios</p>
                        </a>
                    </div>
                </div>
                <div class="flex flex-col gap-1">
                    <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-[#4c739a] dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800"
                        href="#">
                        <span class="material-symbols-outlined text-2xl">settings</span>
                        <p class="text-sm font-medium">Configurações</p>
                    </a>
                    <a class="flex items-center gap-3 rounded-lg px-3 py-2 text-[#4c739a] dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800"
                        href="#">
                        <span class="material-symbols-outlined text-2xl">logout</span>
                        <p class="text-sm font-medium">Sair</p>
                    </a>
                </div>
            </aside>
            <!-- Main Content -->
            <div class="flex flex-1 flex-col">
                <!-- TopNavBar -->
                <header
                    class="flex h-16 items-center justify-end whitespace-nowrap border-b border-solid border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark px-8">
                    <div class="flex items-center gap-4">
                        <button
                            class="flex h-10 w-10 cursor-pointer items-center justify-center overflow-hidden rounded-full bg-slate-100 dark:bg-slate-800 text-[#0d141b] dark:text-slate-200">
                            <span class="material-symbols-outlined text-xl">notifications</span>
                        </button>
                        <div class="flex items-center gap-3">
                            <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                                data-alt="User avatar image"
                                style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDi65Kk7LckmcrS0auPUyvjF94HASToPWM2d3WnpsZxslUUCKNs7xA7mxUSf0AVxlCmiREoOoQG7Rdmpu1I8kWDLom4l-GLvDIzJsagJYxZ87ey45xNUNMyXhLkVNpZYoabM-59t-X6Z939OpdLFfNg9owdAGbCiWMG9FWNI-T29RPcy4QpMF5JNjFr2ScdBqBS3HqG7AKXLe8T5wXQ9ANUcyQqyk72El6Xu_MI_KsYkHTccu6cly77v2AqjCdfaWh0jLWhIyds3q0");'>
                            </div>
                            <div class="flex flex-col text-sm">
                                <h1 class="font-medium text-[#0d141b] dark:text-slate-200">Nome do Usuário</h1>
                                <p class="text-[#4c739a] dark:text-slate-400">Administrador</p>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Page Content -->
                <main class="flex-1 overflow-y-auto p-8">
                    <div class="mx-auto max-w-4xl">
                        <!-- PageHeading -->
                        <div class="mb-8 flex flex-wrap items-center justify-between gap-4">
                            <div class="flex flex-col gap-1">
                                <h1 class="text-3xl font-bold tracking-tight text-[#0d141b] dark:text-slate-100">
                                    Registrar Entrada de Estoque</h1>
                                <p class="text-base text-[#4c739a] dark:text-slate-400">Preencha os campos abaixo para
                                    adicionar novos itens ao estoque.</p>
                            </div>
                        </div>
                        <!-- Form Card -->
                        <div
                            class="rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark p-8 shadow-sm">
                            <form class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                <!-- Produto -->
                                <div class="md:col-span-2">
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">Produto*
                                        </p>
                                        <select
                                            class="form-select h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 p-3 text-base font-normal">
                                            <option>Selecione um produto</option>
                                            <option value="produto1">Produto A - SKU-001</option>
                                            <option value="produto2">Produto B - SKU-002</option>
                                            <option value="produto3">Produto C - SKU-003</option>
                                        </select>
                                    </label>
                                </div>
                                <!-- Quantidade -->
                                <div>
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">
                                            Quantidade*</p>
                                        <input
                                            class="form-input h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 p-3 text-base font-normal"
                                            placeholder="0" type="number" value="" />
                                    </label>
                                </div>
                                <!-- Fornecedor -->
                                <div>
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">
                                            Fornecedor*</p>
                                        <select
                                            class="form-select h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 p-3 text-base font-normal">
                                            <option>Selecione um fornecedor</option>
                                            <option value="fornecedor1">Fornecedor X</option>
                                            <option value="fornecedor2">Fornecedor Y</option>
                                        </select>
                                    </label>
                                </div>
                                <!-- Data de Entrada -->
                                <div class="md:col-span-2">
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">Data de
                                            Entrada*</p>
                                        <input
                                            class="form-input h-12 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 p-3 text-base font-normal"
                                            type="date" value="2023-10-27" />
                                    </label>
                                </div>
                                <!-- Observações -->
                                <div class="md:col-span-2">
                                    <label class="flex flex-col">
                                        <p class="pb-2 text-sm font-medium text-[#0d141b] dark:text-slate-300">
                                            Observações</p>
                                        <textarea
                                            class="form-textarea w-full min-w-0 flex-1 resize-y overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 text-[#0d141b] dark:text-slate-200 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 p-3 text-base font-normal"
                                            placeholder="Adicione notas adicionais, se necessário..."
                                            rows="4"></textarea>
                                    </label>
                                </div>
                                <!-- Action Buttons -->
                                <div class="md:col-span-2 mt-4 flex justify-end gap-3">
                                    <button
                                        class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 bg-slate-200 dark:bg-slate-700 text-[#0d141b] dark:text-slate-200 gap-2 text-sm font-bold min-w-0 px-6"
                                        type="button">Cancelar</button>
                                    <button
                                        class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 bg-primary text-white gap-2 text-sm font-bold min-w-0 px-6"
                                        type="submit">Salvar Entrada</button>
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