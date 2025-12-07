<!DOCTYPE html>
<html class="light" lang="pt-BR">
@vite (['resources/ts/app.ts', 'resources/css/app.css'])
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Esqueci a senha</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#005A9C",
                        "button-primary": "#1A365D",
                        "secondary": "#4DB8A9",
                        "background-light": "#F4F7FA",
                        "background-dark": "#101922",
                        "text-light": "#333333",
                        "text-dark": "#F4F7FA",
                        "text-secondary-light": "#6b7280",
                        "text-secondary-dark": "#9ca3af",
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
        }
    </style>
</head>

<body class="font-display">
    <div
        class="relative flex h-auto min-h-screen w-full flex-col bg-background-light dark:bg-background-dark group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <div class="flex flex-1">
                <div
                    class="relative hidden lg:flex w-1/2 flex-col items-center justify-center bg-gray-100 dark:bg-background-dark p-12 text-center">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-primary/80 to-secondary/60 opacity-90 dark:opacity-70">
                    </div>
                    <div class="relative z-10 flex flex-col items-center gap-6">
                        <span class="material-symbols-outlined text-white text-8xl">inventory_2</span>
                        <h1 class="text-5xl font-black text-white leading-tight tracking-tighter">Tecnologia para transformar sua rotina de gestão.</h1>
                        <p class="text-lg font-medium text-white/80 max-w-md">Seu negócio no controle, sempre.</p>
                    </div>
                </div>
                <div
                    class="flex w-full lg:w-1/2 flex-col items-center justify-center p-6 sm:p-12 bg-background-light dark:bg-background-dark">
                    <div class="layout-content-container flex flex-col max-w-md w-full flex-1 justify-center">
                        <div class="flex flex-col gap-3 mb-8">
                            <h2
                                class="text-text-light dark:text-text-dark text-4xl font-black leading-tight tracking-[-0.033em]">
                                Esqueceu sua senha?</h2>
                            <p
                                class="text-text-secondary-light dark:text-text-secondary-dark text-base font-normal leading-normal">
                                Não se preocupe! Insira seu e-mail para receber as instruções de recuperação.</p>
                        </div>
                        <div class="flex flex-col gap-4">
                            <label class="flex flex-col w-full">
                                <p class="text-text-light dark:text-text-dark text-sm font-medium leading-normal pb-2">
                                    E-mail ou Usuário</p>
                                <div
                                    class="flex w-full flex-1 items-stretch rounded-lg border border-gray-300 dark:border-gray-700 focus-within:ring-2 focus-within:ring-primary/50 transition-shadow">
                                    <div
                                        class="text-text-secondary-light dark:text-text-secondary-dark flex bg-background-light dark:bg-gray-800 items-center justify-center pl-4 pr-2 rounded-l-lg">
                                        <span class="material-symbols-outlined text-xl">person</span>
                                    </div>
                                    <input
                                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden text-text-light dark:text-text-dark focus:outline-0 focus:ring-0 border-0 bg-background-light dark:bg-gray-800 h-12 placeholder:text-text-secondary-light dark:placeholder:text-text-secondary-dark p-3 text-base font-normal leading-normal rounded-r-lg"
                                        placeholder="Digite seu e-mail ou usuário" value="" />
                                </div>
                            </label>
                        </div>
                        <div class="flex pt-6 pb-4 justify-center">
                            <button id="button"
                                class="flex min-w-[84px] w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 focus:ring-4 focus:ring-primary/30 transition-all">
                                <span class="truncate">Enviar Instruções</span>
                            </button>
                        </div>
                        <div class="flex items-center justify-center">
                            <a class="font-semibold text-primary dark:text-secondary hover:underline text-sm" href="#">
                                <span class="flex items-center gap-2"><span
                                        class="material-symbols-outlined">arrow_back</span>Voltar ao Login</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<style>


</style>

</html>