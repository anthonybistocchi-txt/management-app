@vite(['resources/ts/components/Layout/SidebarPermissions.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])
@php
    $active = $active ?? null;
    $navActive = 'flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/10 text-primary transition-colors hover:text-white';
    $navInactive = 'flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors hover:text-white hover:bg-primary/10 transition-colors';
    $nav = fn(string $key) => $active === $key ? $navActive : $navInactive;
    $reportsOpen = in_array($active, ['reportSalesPeriod', 'reportStockTurnover', 'reportInOut', 'reportStockCard'], true);
    $subNav = fn(string $key) => $active === $key
        ? 'block rounded-md px-2 py-1.5 text-sm font-semibold text-primary bg-primary/10'
        : 'block rounded-md px-2 py-1.5 text-sm text-slate-200 hover:bg-primary/10 hover:text-primary transition-colors';
@endphp


<aside id="sidebar-main"
    class="fixed inset-y-0 left-0 z-50 flex h-full w-64 -translate-x-full flex-col overflow-hidden bg-surface-blue p-4 text-text-white transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0">

    <div class="flex flex-col gap-6 flex-1 overflow-hidden">

        <div class="flex items-center justify-between px-2 shrink-0">
            <div class="p-2 rounded-xl w-full shadow-sm flex items-center justify-center">
                <img id="img-sidebar-logo" src="/images/logo.jpg" alt="Logo Empresa"
                    class="h-12 w-auto object-contain max-w-full">
            </div>

            <button id="btn-close-sidebar"
                class="lg:hidden p-1 rounded-md text-slate-300 hover:bg-white/10 hover:text-white transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        {{-- Nav com barra de rolagem super fina e elegante --}}
        <nav class="flex flex-col gap-2 flex-1 overflow-y-auto pr-2 pb-2 
            [&::-webkit-scrollbar]:w-1 
            [&::-webkit-scrollbar-track]:bg-transparent 
            [&::-webkit-scrollbar-thumb]:bg-white/10 
            [&::-webkit-scrollbar-thumb]:rounded-full 
            hover:[&::-webkit-scrollbar-thumb]:bg-white/20 
            transition-all">

            <button id="btn-open-sidebar"
                class="lg:hidden flex items-center justify-center p-2 rounded-md text-slate-500 hover:bg-slate-200 hover:text-slate-800 transition-colors focus:outline-none">
                <span class="material-symbols-outlined text-2xl">menu</span>
            </button>

            <a id="link-sidebar-dashboard" href="{{ route('dashboard') }}" class="{{ $nav('dashboard') }}">
                <span class="material-symbols-outlined">dashboard</span>
                <p class="text-sm font-semibold">Dashboard</p>
            </a>

            <div class="mt-2 text-xs uppercase tracking-widest text-slate-300">Vendas</div>
            <a id="link-sidebar-sales-new" href="{{ route('stockOut') }}" class="{{ $nav('salesNew') }}">
                <span class="material-symbols-outlined">shopping_cart</span>
                <p class="text-sm font-medium hover:text-white hover:bg-primary/10 transition-colors">Nova venda</p>
            </a>

            <div
                class="mt-2 hover:text-white hover:bg-primary/10 transition-colors text-xs uppercase tracking-widest text-slate-300 ">
                Estoque</div>
            <a id="link-sidebar-stock-in" href="{{ route('stock') }}" class="{{ $nav('stockIn') }}">
                <span class="material-symbols-outlined">inventory_2</span>
                <p class="text-sm font-medium">Entrada de mercadoria</p>
            </a>
            <a id="link-sidebar-inventory" href="{{ route('reportInventory') }}"
                class="{{ $nav('inventory') }} hover:text-white hover:bg-primary/10 transition-colors">
                <span class="material-symbols-outlined">assignment</span>
                <p class="text-sm font-medium">Inventário</p>
            </a>

            <div
                class="mt-2 text-xs uppercase tracking-widest text-slate-300 hover:text-white hover:bg-primary/10 transition-colors">
                Cadastros</div>
            <a id="link-sidebar-products" href="{{ route('products') }}"
                class="{{ $nav('products') }} hover:text-white hover:bg-primary/10 transition-colors">
                <span class="material-symbols-outlined">inventory</span>
                <p class="text-sm font-medium">Produtos</p>
            </a>
            <a id="link-sidebar-providers" href="{{ route('providers') }}"
                class="{{ $nav('providers') }} hover:text-white hover:bg-primary/10 transition-colors">
                <span class="material-symbols-outlined">local_shipping</span>
                <p class="text-sm font-medium">Fornecedores</p>
            </a>
            <a id="link-sidebar-locations" href="{{ route('locations') }}"
                class="{{ $nav('locations') }} hover:text-white hover:bg-primary/10 transition-colors">
                <span class="material-symbols-outlined">pin_drop</span>
                <p class="text-sm font-medium">Locais</p>
            </a>
            <a id="link-sidebar-users" href="{{ route('users') }}"
                class="{{ $nav('users') }} hover:text-white hover:bg-primary/10 transition-colors">
                <span class="material-symbols-outlined">group</span>
                <p class="text-sm font-medium">Operadores</p>
            </a>
            <a id="link-sidebar-categories" href="{{ route('categories') }}"
                class="{{ $nav('categories') }} hover:text-white hover:bg-primary/10 transition-colors">
                <span class="material-symbols-outlined">category</span>
                <p class="text-sm font-medium">Categorias</p>
            </a>

            <details id="sidebar-reports-group" class="group shrink-0" {{ $reportsOpen ? 'open' : '' }}>
                <summary
                    class="{{ $reportsOpen ? $navActive : $navInactive }} list-none cursor-pointer flex items-center justify-between gap-2 [&::-webkit-details-marker]:hidden hover:text-white hover:bg-primary/10 transition-colors">
                    <span class="flex min-w-0 items-center gap-3">
                        <span
                            class="material-symbols-outlined shrink-0 hover:text-white hover:bg-primary/10 transition-colors">summarize</span>
                        <p class="text-sm font-medium hover:text-white hover:bg-primary/10 transition-colors">Relatórios
                        </p>
                    </span>
                    <span
                        class="material-symbols-outlined shrink-0 text-lg transition-transform duration-300 group-open:rotate-180">expand_more</span>
                </summary>

                {{-- Submenu com efeito de hover na borda e nos itens --}}
                <div
                    class="mt-2 ml-4 flex flex-col gap-1 border-l border-white/15 pl-3 transition-colors duration-300 hover:border-white/40">
                    <a id="link-sidebar-report-sales-period" href="#"
                        class="{{ $subNav('reportSalesPeriod') }} hover:text-white hover:bg-primary/10 hover:translate-x-1 transition-all duration-200">
                        Vendas por periodo
                    </a>
                    <a id="link-sidebar-report-stock-turnover" href="{{ route('reportStockTurnover') }}"
                        class="{{ $subNav('reportStockTurnover') }} hover:text-white hover:bg-primary/10 hover:translate-x-1 transition-all duration-200">
                        Giro de estoque
                    </a>
                    <a id="link-sidebar-report-in-out" href="{{ route('reportInOut') }}"
                        class="{{ $subNav('reportInOut') }} hover:text-white hover:bg-primary/10 hover:translate-x-1 transition-all duration-200">
                        Entrada e saída
                    </a>
                    <a id="link-sidebar-report-stock-card" href="{{ route('reportStockCard') }}"
                        class="{{ $subNav('reportStockCard') }} hover:text-white hover:bg-primary/10 hover:translate-x-1 transition-all duration-200">
                        Ficha de estoque
                    </a>
                </div>
            </details>
        </nav>
    </div>

    {{-- Divisor fixo --}}
    <hr class="border-t border-white/10 my-4 shrink-0" />

    {{-- Rodapé fixo --}}
    <div class="flex flex-col gap-1 shrink-0">
        <a id="link-sidebar-settings"
            class="flex items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-white hover:bg-primary/10 transition-colors"
            href="#">
            <span class="material-symbols-outlined text-2xl">settings</span>
            <p class="text-sm font-medium">Configuracoes</p>
        </a>
        <form id="form-sidebar-logout" method="POST" action="{{ url('/logout') }}">
            @csrf
            <button type="submit"
                class="flex w-full items-center gap-3 rounded-lg px-3 py-2 text-slate-300 hover:text-white hover:bg-primary/10 transition-colors">
                <span class="material-symbols-outlined text-2xl">logout</span>
                <p class="text-sm font-medium">Sair</p>
            </button>
        </form>
    </div>
</aside>