@vite(['resources/ts/components/Layout/SidebarPermissions.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])
@php
    $withBorder = $withBorder ?? true;
    $textAlignRight = $textAlignRight ?? false;
    $avatarUrl = $avatarUrl ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuDi65Kk7LckmcrS0auPUyvjF94HASToPWM2d3WnpsZxslUUCKNs7xA7mxUSf0AVxlCmiREoOoQG7Rdmpu1I8kWDLom4l-GLvDIzJsagJYxZ87ey45xNUNMyXhLkVNpZYoabM-59t-X6Z939OpdLFfNg9owdAGbCiWMG9FWNI-T29RPcy4QpMF5JNjFr2ScdBqBS3HqG7AKXLe8T5wXQ9ANUcyQqyk72El6Xu_MI_KsYkHTccu6cly77v2AqjCdfaWh0jLWhIyds3q0';
    $textColClass = 'flex flex-col text-sm' . ($textAlignRight ? ' text-right' : '');
@endphp
<header class="flex h-16 w-full shrink-0 items-center bg-white dark:bg-background-dark px-4 lg:px-8 border-b border-slate-200 dark:border-slate-800">

    <button id="btn-open-sidebar" class="lg:hidden flex items-center justify-center p-2 -ml-2 rounded-md text-slate-500 hover:bg-slate-100 hover:text-slate-800 transition-colors focus:outline-none">
        <span class="material-symbols-outlined text-2xl">menu</span>
    </button>
    
    <div class="flex items-center gap-3 ml-auto whitespace-nowrap">
        <div id="header-user-avatar"
            class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10 shadow-sm"
            data-alt="Avatar do usuário"
            style="background-image: url('{{ $avatarUrl }}');">
        </div>
        <div class="{{ $textColClass }}">
            <h1 id="text-header-username" class="font-medium text-[#0d141b] dark:text-slate-200"></h1>
            <p id="text-header-type-user" class="text-sm text-[#4c739a] dark:text-slate-500"></p>
        </div>
    </div>
    
</header>
