<!DOCTYPE html>
<html class="light" lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Página de Login</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />

    @vite(['resources/ts/app.ts', 'resources/css/app.css'])
    @vite(['resources/ts/pages/auth/login.ts']) 
</head>

<body class="font-display">
    <div class="relative flex h-auto min-h-screen w-full flex-col bg-background-light dark:bg-background-dark group/design-root overflow-x-hidden">
        <div class="layout-container flex h-full grow flex-col">
            <div class="flex flex-1">
                <div class="relative hidden lg:flex w-1/2 flex-col items-center justify-center bg-gray-100 dark:bg-background-dark p-12 text-center">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/80 to-secondary/60 opacity-90 dark:opacity-70"></div>
                    <div class="relative z-10 flex flex-col items-center gap-6">
                        <span class="material-symbols-outlined text-white text-8xl">inventory_2</span>
                        <h1 class="text-5xl font-black text-white leading-tight tracking-tighter">
                            Centralize tarefas<br>Simplifique processos<br>Aumente resultados
                        </h1>
                        <p class="text-lg font-medium text-white/80 max-w-md">A maneira mais simples de administrar suas vendas</p>
                    </div>
                </div>

                <div class="flex w-full lg:w-1/2 flex-col items-center justify-center p-6 sm:p-12 bg-background-light dark:bg-background-dark">
                    <div class="layout-content-container flex flex-col max-w-md w-full flex-1 justify-center">
                        
                        <div class="flex flex-col gap-3 mb-8">
                            <h2 class="text-text-light dark:text-text-dark text-4xl font-black leading-tight tracking-[-0.033em]">Acesse sua conta</h2>
                            <p class="text-text-secondary-light dark:text-text-secondary-dark text-base font-normal leading-normal">Bem-vindo de volta! Por favor, insira seus dados.</p>
                        </div>

                        <form id="form-login" class="flex flex-col gap-4">
                            
                            <label class="flex flex-col w-full">
                                <p class="text-text-light dark:text-text-dark text-sm font-medium leading-normal pb-2">Username</p>
                                <div class="flex w-full flex-1 items-stretch rounded-lg border border-gray-300 dark:border-gray-700 focus-within:ring-2 focus-within:ring-primary/50 transition-shadow">
                                    <div class="text-text-secondary-light dark:text-text-secondary-dark flex bg-background-light dark:bg-gray-800 items-center justify-center pl-4 pr-2 rounded-l-lg">
                                        <span class="material-symbols-outlined text-xl">mail</span> </div>
                                    <input 
                                        type="text" 
                                        name="username" 
                                        id="username"
                                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden text-text-light dark:text-text-dark focus:outline-0 focus:ring-0 border-0 bg-background-light dark:bg-gray-800 h-12 placeholder:text-text-secondary-light dark:placeholder:text-text-secondary-dark p-3 text-base font-normal leading-normal rounded-r-lg"
                                        placeholder="Digite seu username" 
                                        autocomplete="username"
                                    
                                    />
                                </div>
                            </label>

                            <label class="flex flex-col w-full">
                                <p class="text-text-light dark:text-text-dark text-sm font-medium leading-normal pb-2">Senha</p>
                                <div class="flex w-full flex-1 items-stretch rounded-lg border border-gray-300 dark:border-gray-700 focus-within:ring-2 focus-within:ring-primary/50 transition-shadow">
                                    <div class="text-text-secondary-light dark:text-text-secondary-dark flex bg-background-light dark:bg-gray-800 items-center justify-center pl-4 pr-2 rounded-l-lg">
                                        <span class="material-symbols-outlined text-xl">lock</span>
                                    </div>
                                    <input 
                                        type="password" 
                                        name="password" 
                                        id="password"
                                        class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden text-text-light dark:text-text-dark focus:outline-0 focus:ring-0 border-0 bg-background-light dark:bg-gray-800 h-12 placeholder:text-text-secondary-light dark:placeholder:text-text-secondary-dark p-3 text-base font-normal leading-normal"
                                        placeholder="Digite sua senha" 
                                        autocomplete="current-password"
                                    
                                    />
                                    <button type="button" id="button-visibility" class="text-text-secondary-light dark:text-text-secondary-dark flex bg-background-light dark:bg-gray-800 items-center justify-center px-4 rounded-r-lg cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                                        <span class="material-symbols-outlined text-xl">visibility</span>
                                    </button>
                                </div>
                            </label>

                            <div class="flex pt-6 pb-4 justify-center">
                                <button type="submit" id="submit-button" class="flex min-w-[84px] w-full cursor-pointer items-center justify-center overflow-hidden rounded-lg h-12 px-5 bg-primary text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 focus:ring-4 focus:ring-primary/30 transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span class="truncate">Entrar</span>
                                </button>
                            </div>

                        </form> </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>