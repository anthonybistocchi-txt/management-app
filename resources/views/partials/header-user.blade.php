{{--
    Cabeçalho com avatar, nome e tipo de usuário (preenchidos via JS: showUserLogged).

    Parâmetros opcionais:
    - $withBorder (bool): default true — borda inferior
    - $textAlignRight (bool): default false — texto alinhado à direita (ex.: dashboard)
    - $avatarUrl (string): URL da imagem do avatar
--}}
@php
    $withBorder = $withBorder ?? true;
    $textAlignRight = $textAlignRight ?? false;
    $avatarUrl = $avatarUrl ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuDi65Kk7LckmcrS0auPUyvjF94HASToPWM2d3WnpsZxslUUCKNs7xA7mxUSf0AVxlCmiREoOoQG7Rdmpu1I8kWDLom4l-GLvDIzJsagJYxZ87ey45xNUNMyXhLkVNpZYoabM-59t-X6Z939OpdLFfNg9owdAGbCiWMG9FWNI-T29RPcy4QpMF5JNjFr2ScdBqBS3HqG7AKXLe8T5wXQ9ANUcyQqyk72El6Xu_MI_KsYkHTccu6cly77v2AqjCdfaWh0jLWhIyds3q0';
    $textColClass = 'flex flex-col text-sm' . ($textAlignRight ? ' text-right' : '');
@endphp

<header
    class="flex h-16 shrink-0 items-center justify-end whitespace-nowrap bg-white dark:bg-background-dark px-8">
    <div class="flex items-center gap-4">
        <div class="flex items-center gap-3">
            <div id="header-user-avatar"
                class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                data-alt="Avatar do usuário"
                style="background-image: url('{{ $avatarUrl }}');">
            </div>
            <div class="{{ $textColClass }}">
                <h1 id="text-header-username" class="font-medium text-[#0d141b] "></h1>
                <p id="text-header-type-user" class="text-[#4c739a] dark:text-slate-500"></p>
            </div>
        </div>
    </div>
</header>
