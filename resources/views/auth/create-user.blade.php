<!DOCTYPE html>

<html class="light" lang="pt-br">
@vite (['resources/ts/app.ts', 'resources/css/app.css'])
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Criar Conta</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
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
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-size: 24px;
        }
    </style>
</head>

<body class="font-display">
    <div
        class="relative flex min-h-screen w-full flex-col items-center justify-center bg-background-light dark:bg-background-dark p-4">
        <div class="w-full max-w-md space-y-8">
            <div class="flex flex-col items-center text-center">
                <h1 class="text-4xl font-black tracking-tighter text-[#0d141b] dark:text-white">Crie sua conta</h1>
                <p class="mt-2 text-base text-gray-500 dark:text-gray-400">Insira suas informações para começar.</p>
            </div>
            <div
                class="rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-background-dark/50 p-6 sm:p-8 shadow-sm">
                <form class="space-y-6">
                    <div>
                        <label class="flex flex-col">
                            <p class="text-base font-medium leading-normal pb-2 text-[#0d141b] dark:text-gray-200">Nome
                                Completo</p>
                            <input
                                class="form-input flex w-full flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-gray-600 bg-background-light dark:bg-gray-800 h-14 p-[15px] text-base font-normal leading-normal text-[#0d141b] dark:text-white placeholder:text-[#4c739a] dark:placeholder:text-gray-500 focus:border-primary dark:focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20"
                                placeholder="ex: João da Silva" type="text" />
                        </label>
                    </div>
                    <div>
                        <label class="flex flex-col">
                            <p class="text-base font-medium leading-normal pb-2 text-[#0d141b] dark:text-gray-200">
                                E-mail</p>
                            <input
                                class="form-input flex w-full flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-gray-600 bg-background-light dark:bg-gray-800 h-14 p-[15px] text-base font-normal leading-normal text-[#0d141b] dark:text-white placeholder:text-[#4c739a] dark:placeholder:text-gray-500 focus:border-primary dark:focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20"
                                placeholder="seuemail@exemplo.com" type="email" />
                        </label>
                    </div>
                    <div>
                        <label class="flex flex-col">
                            <p class="text-base font-medium leading-normal pb-2 text-[#0d141b] dark:text-gray-200">Senha
                            </p>
                            <div class="relative flex w-full items-center">
                                <input
                                    class="form-input flex w-full flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-gray-600 bg-background-light dark:bg-gray-800 h-14 p-[15px] text-base font-normal leading-normal text-[#0d141b] dark:text-white placeholder:text-[#4c739a] dark:placeholder:text-gray-500 focus:border-primary dark:focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20"
                                    placeholder="Crie uma senha forte" type="password" />
                                <div class="absolute right-0 flex items-center pr-3 text-[#4c739a] dark:text-gray-500">
                                    <span class="material-symbols-outlined cursor-pointer"
                                        data-icon="Eye">visibility</span>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div>
                        <label class="flex flex-col">
                            <p class="text-base font-medium leading-normal pb-2 text-[#0d141b] dark:text-gray-200">
                                Confirmação de Senha</p>
                            <div class="relative flex w-full items-center">
                                <input
                                    class="form-input flex w-full flex-1 resize-none overflow-hidden rounded-lg border border-[#cfdbe7] dark:border-gray-600 bg-background-light dark:bg-gray-800 h-14 p-[15px] text-base font-normal leading-normal text-[#0d141b] dark:text-white placeholder:text-[#4c739a] dark:placeholder:text-gray-500 focus:border-primary dark:focus:border-primary focus:outline-0 focus:ring-2 focus:ring-primary/20"
                                    placeholder="Repita a senha" type="password" />
                                <div class="absolute right-0 flex items-center pr-3 text-[#4c739a] dark:text-gray-500">
                                    <span class="material-symbols-outlined cursor-pointer"
                                        data-icon="Eye">visibility</span>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="pt-2">
                        <button
                            class="flex h-14 w-full items-center justify-center rounded-lg bg-primary px-6 text-base font-bold text-white shadow-sm transition-colors hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 dark:focus:ring-offset-background-dark"
                            type="submit">
                            Criar Conta
                        </button>
                    </div>
                </form>
            </div>
            <div class="text-center">
                <p class="text-base text-gray-500 dark:text-gray-400">
                    Já tem uma conta?
                    <a class="font-semibold text-primary hover:underline" href="#">Faça Login</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>