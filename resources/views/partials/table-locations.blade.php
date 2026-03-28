<div class="mb-8 flex flex-wrap items-center justify-between gap-4">
    <div class="flex flex-col gap-1">
        <h1 class="text-3xl font-bold tracking-tight text-[#0d141b]">Gestao de locais</h1>
        <p class="text-base text-[#4c739a] dark:text-slate-400">Gerencie locais e unidades cadastradas.</p>
    </div>

    <button id="btn-open-create-location"
        class="flex h-10 items-center justify-center rounded-lg bg-primary text-white px-6 text-sm font-bold gap-2 hover:bg-primary/90 transition-colors">
        <span class="material-symbols-outlined text-xl">add</span>
        Adicionar local
    </button>
</div>

<div class="mb-6 flex flex-col sm:flex-row gap-4 justify-between items-center rounded-xl bg-white dark:bg-background-dark p-4 shadow-sm">
    <div class="w-full sm:max-w-xs relative">
        <span class="material-symbols-outlined absolute left-3 top-3 text-[#4c739a]">search</span>
        <input id="input-search-location"
            class="form-input h-10 w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] text-[#0d141b]  placeholder:text-[#94a3b8] dark:placeholder:text-slate-500 bg-[#F4F7FA] pl-10 pr-4 text-base font-normal"
            placeholder="Buscar por nome" value="" />
    </div>
    <div class="flex gap-2 w-full sm:w-auto">
        <div class="relative w-full sm:w-48">
            <select id="select-filter-location-state">
                <option value="all">Estados</option>
                <option value="all">Todos</option>
            </select>
        </div>
        <div class="relative w-full sm:w-48">
            <select id="select-filter-location-city">
                <option value="all">Cidades</option>
                <option value="all">Todas</option>
            </select>
        </div>
    </div>
    <button id="btn-submit-search-location"
        class="flex h-10 items-center justify-center rounded-lg bg-primary text-white px-6 text-sm font-bold gap-2 hover:bg-primary/90 transition-colors">
        <span class="material-symbols-outlined text-xl">search</span>
        Buscar
    </button>
</div>

<div class="rounded-xl bg-white dark:bg-background-dark shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table id="table-locations"
            class="w-full text-sm text-left text-[#4c739a] dark:text-slate-400"></table>
    </div>
</div>
