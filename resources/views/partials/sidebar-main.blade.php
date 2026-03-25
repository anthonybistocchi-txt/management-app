{{--
    Menu lateral reutilizável.

    Uso: @include('partials.sidebar-main', ['active' => 'dashboard'])

    Valores de $active: dashboard | stock | stockOut | users | providers | reports
--}}
@php
    $active = $active ?? null;
    $navActive = 'flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/10 text-primary transition-colors';
    $navInactive = 'flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors';
    $nav = fn (string $key) => $active === $key ? $navActive : $navInactive;
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

            <a id="link-sidebar-stock-in" href="{{ route('stock') }}" class="{{ $nav('stock') }}">
                <span class="material-symbols-outlined">inventory_2</span>
                <p class="text-sm font-medium">Registrar entrada</p>
            </a>

            <a id="link-sidebar-users" href="{{ route('users') }}" class="{{ $nav('users') }}">
                <span class="material-symbols-outlined">group</span>
                <p class="text-sm font-medium">Operadores</p>
            </a>

            <a id="link-sidebar-stock-out" href="{{ route('stockOut') }}" class="{{ $nav('stockOut') }}">
                <span class="material-symbols-outlined">shopping_cart</span>
                <p class="text-sm font-medium">Registrar venda</p>
            </a>

            <a id="link-sidebar-reports" href="{{ route('movements') }}" class="{{ $nav('reports') }}">
                <span class="material-symbols-outlined">summarize</span>
                <p class="text-sm font-medium">Relatórios</p>
            </a>

            <a id="link-sidebar-providers" href="{{ route('providers') }}" class="{{ $nav('providers') }}">
                <span class="material-symbols-outlined">local_shipping</span>
                <p class="text-sm font-medium">Fornecedores</p>
            </a>
        </nav>
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
