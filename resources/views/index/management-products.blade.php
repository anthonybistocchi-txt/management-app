<!DOCTYPE html>
<html lang="pt-BR">
@vite(['resources/ts/pages/index/management-products.ts'])
@vite(['resources/ts/app.ts', 'resources/css/app.css'])

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Produtos - Gestao de Estoque</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
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
    <div class="relative flex h-screen min-h-screen w-full flex-col bg-background-light dark:bg-background-dark text-[#0d141b] dark:text-slate-200">
        <div class="flex h-full w-full">

            @include('partials.sidebar-main', ['active' => 'products'])

            <div class="flex flex-1 flex-col overflow-y-auto">
                @include('partials.header-user')

                <main class="flex-1 p-8">
                    <div class="mx-auto max-w-7xl">
                        @include('partials.table-products')
                    </div>
                </main>

                @include('partials.footer-main')
                @include('modals.create-product')
                @include('modals.edit-product')
                @include('modals.delete-product')
            </div>
        </div>
    </div>
</body>

</html>
