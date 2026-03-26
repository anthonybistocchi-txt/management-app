{{--
    Tabela de usuários reutilizável (filtros + DataTable).

    Uso: @include('partials.table-users', ['showActions' => true])

    Parâmetros opcionais:
      - $showActions  (bool)  Exibir botão "Adicionar operador" (default: true)
--}}
@php
    $showActions = $showActions ?? true;
@endphp

@if ($showActions)
<div class="mb-8 flex flex-wrap items-center justify-between gap-4">
    <div class="flex flex-col gap-1">
        <h1 class="text-3xl font-bold tracking-tight text-[#0d141b]">Gestão de operadores</h1>
        <p class="text-base text-[#4c739a] dark:text-slate-400">Gerencie os usuários do sistema,
            adicione novos, edite perfis e altere status.</p>
    </div>

    <button id="btn-open-create-user"
        class="flex h-10 items-center justify-center rounded-lg bg-primary text-white px-6 text-sm font-bold gap-2 hover:bg-primary/90 transition-colors">
        <span class="material-symbols-outlined text-xl">add</span>
        Adicionar operador
    </button>
</div>
@endif

<div
    class="mb-6 flex flex-col sm:flex-row gap-4 justify-between items-center rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-background-dark p-4 shadow-sm">
    <div class="w-full sm:max-w-xs relative">
        <span class="material-symbols-outlined absolute left-3 top-3 text-[#4c739a]">search</span>
        <input id="input-search-user"
            class="form-input h-10 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] bg-background-light text-[#0d141b] dark:text-slate-800 placeholder:text-[#4c739a] focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20 pl-10 pr-4 text-base font-normal"
            placeholder="Buscar por nome" value="" />
    </div>
    <div class="flex gap-2 w-full sm:w-auto">
        <div class="relative w-full sm:w-48">
            <select id="select-filter-type-user">
                <option value="all">Tipos de operadores</option>
                <option value="all">Todos</option>
                <option value="1">Administrador</option>
                <option value="2">Gestor</option>
                <option value="3">Operador</option>
            </select>
        </div>
        <div class="relative w-full sm:w-48">
            <select id="select-filter-status">
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
