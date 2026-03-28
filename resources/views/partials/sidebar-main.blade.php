{{--
    Menu lateral reutilizável.

    Uso: @include('partials.sidebar-main', ['active' => 'dashboard'])

    Valores de $active: dashboard | salesNew | salesHistory | stockIn |
    stockMoves | inventory | products | providers | users | categories |
    reportSalesPeriod | reportStockTurnover | reportInOut
--}}
@php
    $active = $active ?? null;
    $navActive = 'flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/10 text-primary transition-colors hover:text-white';
    $navInactive = 'flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors hover:text-white hover:bg-primary/10 transition-colors';
    $nav = fn (string $key) => $active === $key ? $navActive : $navInactive;
    $reportsOpen = in_array($active, ['reportSalesPeriod', 'reportStockTurnover', 'reportInOut'], true);
    $subNav = fn (string $key) => $active === $key
        ? 'block rounded-md px-2 py-1.5 text-sm font-semibold text-primary bg-primary/10'
        : 'block rounded-md px-2 py-1.5 text-sm text-slate-200 hover:bg-primary/10 hover:text-primary transition-colors';
@endphp

<aside id="sidebar-main"
    class="flex h-full w-64 flex-col justify-between bg-surface-blue text-text-white p-4">
    <div class="flex flex-col gap-8">
        <div class="flex items-center justify-center px-2">
            <div class="p-2 rounded-xl w-full shadow-sm flex items-center justify-center">
                <img id="img-sidebar-logo" src="/images/logo.jpg" alt="Logo Empresa"
                    class="h-12 w-auto object-contain max-w-full">
            </div>
        </div>

        <nav class="flex flex-col gap-2">
            <a id="link-sidebar-dashboard" href="{{ route('dashboard') }}" class="{{ $nav('dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <p class="text-sm font-semibold">Dashboard</p>
            </a>

            <div class="mt-2 text-xs uppercase tracking-widest text-slate-300">Vendas</div>
            <a id="link-sidebar-sales-new" href="{{ route('stockOut') }}" class="{{ $nav('salesNew') }}">
                <span class="material-symbols-outlined">shopping_cart</span>
                <p class="text-sm font-medium hover:text-white hover:bg-primary/10 transition-colors">Nova venda</p>
            </a>
            <a id="link-sidebar-sales-history" href="#" class="{{ $nav('salesHistory') }} hover:text-white hover:bg-primary/10 transition-colors">
                <span class="material-symbols-outlined">history</span>
                <p class="text-sm font-medium">Histórico de vendas</p>
            </a>

            <div class="mt-2 hover:text-white hover:bg-primary/10 transition-colors text-xs uppercase tracking-widest text-slate-300 ">Estoque</div>
            <a id="link-sidebar-stock-in" href="{{ route('stock') }}" class="{{ $nav('stockIn') }}">
                <span class="material-symbols-outlined">inventory_2</span>
                <p class="text-sm font-medium">Entrada de mercadoria</p>
            </a>
            <a id="link-sidebar-stock-moves" href="#" class="{{ $nav('stockMoves') }} hover:text-white hover:bg-primary/10 transition-colors">
                <span class="material-symbols-outlined">swap_horiz</span>
                <p class="text-sm font-medium">Movimentações</p>
            </a>
            <a id="link-sidebar-inventory" href="{{ route('reportInventory') }}" class="{{ $nav('inventory') }} hover:text-white hover:bg-primary/10 transition-colors">
                <span class="material-symbols-outlined">assignment</span>
                <p class="text-sm font-medium">Inventário</p>
            </a>

            <div class="mt-2 text-xs uppercase tracking-widest text-slate-300 hover:text-white hover:bg-primary/10 transition-colors">Cadastros</div>
            <a id="link-sidebar-products" href="#" class="{{ $nav('products') }} hover:text-white hover:bg-primary/10 transition-colors">
                <span class="material-symbols-outlined">inventory</span>
                <p class="text-sm font-medium">Produtos</p>
            </a>
            <a id="link-sidebar-providers" href="{{ route('providers') }}" class="{{ $nav('providers') }} hover:text-white hover:bg-primary/10 transition-colors">
                <span class="material-symbols-outlined">local_shipping</span>
                <p class="text-sm font-medium">Fornecedores</p>
            </a>
            <a id="link-sidebar-users" href="{{ route('users') }}" class="{{ $nav('users') }} hover:text-white hover:bg-primary/10 transition-colors">
                <span class="material-symbols-outlined">group</span>
                <p class="text-sm font-medium">Operadores</p>
            </a>
            <a id="link-sidebar-categories" href="#" class="{{ $nav('categories') }} hover:text-white hover:bg-primary/10 transition-colors">
                <span class="material-symbols-outlined">category</span>
                <p class="text-sm font-medium">Categorias</p>
            </a>

            <details id="sidebar-reports-group" class="group" {{ $reportsOpen ? 'open' : '' }}>
                <summary
                    class="{{ $reportsOpen ? $navActive : $navInactive }} list-none cursor-pointer flex items-center justify-between gap-2 [&::-webkit-details-marker]:hidden hover:text-white hover:bg-primary/10 transition-colors">
                    <span class="flex min-w-0 items-center gap-3">
                        <span class="material-symbols-outlined shrink-0 hover:text-white hover:bg-primary/10 transition-colors">summarize</span>
                        <p class="text-sm font-medium hover:text-white hover:bg-primary/10 transition-colors">Relatórios</p>
                    </span>
                    <span
                        class="material-symbols-outlined shrink-0 text-lg transition-transform group-open:rotate-180">expand_more</span>
                </summary>
                <div class="mt-1 ml-2 flex flex-col gap-0.5 border-l border-white/15 pl-3 ">
                    <a id="link-sidebar-report-sales-period" href="#" class="{{ $subNav('reportSalesPeriod') }} hover:text-white hover:bg-primary/10 transition-colors">
                        Vendas por periodo
                    </a>
                    <a id="link-sidebar-report-stock-turnover" href="{{ route('reportStockTurnover') }}"
                        class="{{ $subNav('reportStockTurnover') }} hover:text-white hover:bg-primary/10 transition-colors">
                        Giro de estoque
                    </a>
                    <a id="link-sidebar-report-in-out" href="{{ route('reportInOut') }}" class="{{ $subNav('reportInOut') }} hover:text-white hover:bg-primary/10 transition-colors">
                        Entrada e saída
                    </a>
                </div>
            </details>

        </nav>
    </div>

    <div class="flex flex-col gap-1">
        <a id="link-sidebar-settings"
            class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-white hover:bg-primary/10 transition-colors"
            href="#">
            <span class="material-symbols-outlined text-2xl">settings</span>
            <p class="text-sm font-medium">Configuracoes</p>
        </a>
        <a id="link-sidebar-logout"
            class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-white hover:bg-primary/10 transition-colors"
            href="#">
            <span class="material-symbols-outlined text-2xl">logout</span>
            <p class="text-sm font-medium">Sair</p>
        </a>
    </div>
</aside>
