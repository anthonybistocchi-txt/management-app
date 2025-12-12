<!DOCTYPE html>

<html class="light" lang="pt-BR">
@vite(['resources/ts/pages/admin/dashboard.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&amp;display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
</head>

<body
    class="bg-background-light dark:bg-background-dark font-display text-text-light-primary dark:text-text-dark-primary">
    <div class="flex h-screen">
        <!-- SideNavBar -->
        <aside
            class="flex flex-col w-64 bg-surface-blue text-text-white p-4">
            <div class="flex items-center gap-3 px-2 mb-8">
                <span class="material-symbols-outlined text-primary text-3xl">database</span>
                <h1 class="text-text-light-primary dark:text-text-dark-primary text-xl font-bold">Sistema de Gestão</h1>
            </div>
            <div class="flex flex-col flex-1">
                <div class="flex flex-col gap-2">
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/10 text-primary" href="#">
                        <span class="material-symbols-outlined">dashboard</span>
                        <p class="text-sm font-semibold">Dashboard</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary text-text-light-secondary dark:text-text-dark-secondary"
                        href="#">
                        <span class="material-symbols-outlined">inventory_2</span>
                        <p class="text-sm font-medium">Estoque</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary text-text-light-secondary dark:text-text-dark-secondary"
                        href="#">
                        <span class="material-symbols-outlined">group</span>
                        <p class="text-sm font-medium">Usuários</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary text-text-light-secondary dark:text-text-dark-secondary"
                        href="#">
                        <span class="material-symbols-outlined">summarize</span>
                        <p class="text-sm font-medium">Relatórios</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary text-text-light-secondary dark:text-text-dark-secondary"
                        href="#">
                        <span class="material-symbols-outlined">settings</span>
                        <p class="text-sm font-medium">Configurações</p>
                    </a>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                    data-alt="User avatar with a gradient background"
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDpQYKI-kH0WVVLDzsz6gKPLx2_Frb-JsyLKHWiNdfrn0ZUj1AJMeV4RIwN-f8OBg8xv7gN7_YGYAS5yNH46g0VdS_48-efTHR_ASsMUwR4fKahJL5X8i9Ej8--n8g9aeplu-l7AEzaUNprNlmEiJ6s5LzMi3o1R-4PI-N4L7fCwOtqxZWHz7i-s0kqHr1wJE2slw3PJjimGyf0Yn3rXoaoU6bE-otAiL7M6hyJ8Z2VStcGd9b2mtANOO2E6WNFCfiXd37MYxgyXt8");'>
                </div>
                <div class="flex flex-col">
                    <p id="user_name" class="text-text-light-primary dark:text-text-dark-primary text-sm font-semibold leading-normal">
                        Ana do Usuário</p>
                    <p id="type_user_id"
                        class="text-text-light-secondary dark:text-text-dark-secondary text-xs font-normal leading-normal">
                        Admin</p>
                </div>
            </div>
        </aside>
        
        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-y-auto">
            <main class="flex-1 p-8">
                <!-- PageHeading & Chips -->
                <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                    <h2
                        class="text-text-light-primary dark:text-text-dark-primary text-3xl font-bold leading-tight tracking-tight">
                        Dashboard</h2>
                    <div class="flex gap-2">
                        <button id="last_7_days"
                            class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark px-4 text-sm font-medium hover:border-primary hover:text-primary">
                            <span>Últimos 7 dias</span>
                        </button>
                        <button id="last_30_days"
                            class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-primary/10 text-primary px-4 text-sm font-semibold">
                            <span>Últimos 30 dias</span>
                        </button>
                        <button id="last_year"
                            class="flex h-9 shrink-0 items-center justify-center gap-x-2 rounded-lg bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark px-4 text-sm font-medium hover:border-primary hover:text-primary">
                            <span>Este Ano</span>
                        </button>
                    </div>
                </div>
                <!-- Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div
                        class="flex flex-col gap-2 rounded-xl p-6 bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark">
                        <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium">Produtos
                            em Estoque</p>
                        <p id="products_stock" class="text-text-light-primary dark:text-text-dark-primary text-3xl font-bold">1,234</p>
                    </div>
                    <div
                        class="flex flex-col gap-2 rounded-xl p-6 bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark">
                        <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium">Usuários
                            Ativos</p>
                        <p id="active_users" class="text-text-light-primary dark:text-text-dark-primary text-3xl font-bold">567</p>
                    </div>
                    <div
                        class="flex flex-col gap-2 rounded-xl p-6 bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark">
                        <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium">Vendas do
                            Mês</p>
                        <p id="sales_month" class="text-text-light-primary dark:text-text-dark-primary text-3xl font-bold">R$ 25.480</p>
                    </div>
                    <div
                        class="flex flex-col gap-2 rounded-xl p-6 bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark">
                        <p class="text-text-light-secondary dark:text-text-dark-secondary text-sm font-medium">Alertas
                            de Estoque Baixo</p>
                        <p id="low_stock_alerts" class="text-text-light-primary dark:text-text-dark-primary text-3xl font-bold">12</p>
                    </div>
                </div>
                <!-- Charts -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Line Chart -->
                    <div
                        class="lg:col-span-2 flex flex-col rounded-xl p-6 bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark">
                        <h3 class="text-lg font-semibold text-text-light-primary dark:text-text-dark-primary mb-4">
                            Movimentações de Estoque</h3>
                        <div id="moviments_stock_chart" class="flex-1">
                            <img alt="A line chart showing stock entries in green and stock exits in blue over the last 30 days, with peaks and valleys indicating activity."
                                class="w-full h-full object-contain"
                                data-alt="Gráfico de linha de movimentações de estoque"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCaSRlKAAoGmWvcxY3SrQZfaFJFodRpK6az3JJD6sWrXEii8rrMjD9A6-Jcxx5PJ7XcZfSxrfGpyED9e-tY0idDZqpyB5Sf9e3fIjBGptBoBU7IxvlIAj2Y4CEEGXFzDOx305ycOcabEycQmRX-pHiB12pXPbf69Dn5mujEjAhjfJ1kBpQpGrIYtZ-mjpxf0_iCuIskwYqTXizYnnvxT2sK0RbQi110u1RSDsPSC5GqLlbyZfWsTS8wIPNtyasradLc_YqICcEBpZc" />
                        </div>
                    </div>
                    <!-- Donut Chart -->
                    <div
                        class="flex flex-col rounded-xl p-6 bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark">
                        <h3 class="text-lg font-semibold text-text-light-primary dark:text-text-dark-primary mb-4">
                            Usuários por Tipo</h3>
                        <div id="type_user_chart" class="flex-1 flex items-center justify-center">
                            <img alt="A donut chart displaying user distribution by type. The largest segment is 'Standard Users' in blue, followed by 'Managers' in teal, and a smaller segment for 'Admins' in purple."
                                class="w-full h-full max-h-64 object-contain"
                                data-alt="Gráfico de rosca de usuários por tipo"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuAjtuHTpMl3uQ7yyZKfCAWaGT1U4EYt0Ys23F0SUt66TkMvGH920nob2Wl0ktsULd8uWgJsXp2mG_ehjpabM5fdVrvy3RpEty9JQKnK9xi0ZSeQHjSmuRMXaWc75KKoQi_rXhJUqx_ZTJ9Mf9XE9RWymm9At-nLxmAdziL80CUNk_AFUtdBRnkEOF8B16WprSp-AxHiD-uOlX-Wxz4dA704CMsLtJ65l9HJbmMrQY8RMJIq1o3qroBZAKSQcw-dT-EUewR253ZTn48" />
                        </div>
                    </div>
                    <!-- Bar Chart -->
                    <div
                        class="lg:col-span-3 flex flex-col rounded-xl p-6 bg-surface-light dark:bg-surface-dark border border-border-light dark:border-border-dark">
                        <h3 class="text-lg font-semibold text-text-light-primary dark:text-text-dark-primary mb-4">
                            Vendas por Categoria</h3>
                        <div id="sales_category_chart" class="flex-1">
                            <img alt="A vertical bar chart comparing sales across different product categories. 'Eletrônicos' has the highest bar in blue, followed by 'Vestuário' in teal, and 'Alimentos' in orange."
                                class="w-full h-full object-contain"
                                data-alt="Gráfico de barras de vendas por categoria"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCqaqJlH8-AurjiC3mqLcj-_lI5UYzgN8OZLcFUrAaXuJ4jtUCdqqGtqMITD6Vwn8I22fnHl-HqBWqQUckOQYIsaiIfN8i-8BkhMWNQKN8HICL-s3rQDPQ2cvbQYhOYVi_XfErG5CqrPk3jYMxuBv6KHfoNRhA3HB4RtBQeHOpdIgV-1XkCFQwSHD6SiAXkYJLamG3kv_KOI_tcy0F4QBNKmjsUUw7WHYZV4x5RrXk3EhFjZ1MU8o2p2mFqDmzDARZXYoJKuQ4OUyQ" />
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>