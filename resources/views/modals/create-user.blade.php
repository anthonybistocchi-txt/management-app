<div id="modal-create-user" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
    <div class="w-full max-w-lg rounded-xl bg-white dark:bg-background-dark p-6 shadow-lg">

        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-[#0d141b] dark:text-slate-200">
                Adicionar novo usuário
            </h2>
            <button id="btn-modal-close" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                ✕
            </button>
        </div>

        <form id="form-create-user" class="mt-4">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">

                <div class="flex flex-col gap-1 md:col-span-2"> <label
                        class="text-sm font-medium text-[#0d141b] dark:text-slate-800">
                        Nome completo*
                    </label>
                    <input id="input-create-name" type="text" placeholder="Ex: João Silva" value=""
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light px-3 text-sm text-[#0d141b] dark:text-slate-200 placeholder:text-slate-400 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all" />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-800">
                        Username*
                    </label>
                    <input id="input-create-username" type="text" placeholder="Ex: joaosilva" value=""
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light px-3 text-sm text-[#0d141b] dark:text-slate-800 placeholder:text-slate-400 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all" />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-800">
                        CPF*
                    </label>
                    <input id="input-create-cpf" type="text" placeholder="Ex: 123.456.789-00" value=""
                        maxlength="14"
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light px-3 text-sm text-[#0d141b] dark:text-slate-800 placeholder:text-slate-400 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all" />
                </div>

                <div class="flex flex-col gap-1 md:col-span-2"> <label
                        class="text-sm font-medium text-[#0d141b] dark:text-slate-800">
                        Email*
                    </label>
                    <input id="input-create-email" type="email" placeholder="Ex: joao.silva@example.com" value=""
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-800 placeholder:text-slate-400 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all" />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-800">
                        Senha*
                    </label>
                    <input id="input-create-password" type="password" value=""
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-800 placeholder:text-slate-400 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all" />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-800">
                        Tipo de permissão*
                    </label>
                    <select id="select-create-type-user" value=""
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-background-light dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-500 focus:border-primary focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all">
                        <option value="" disabled selected>Selecione um perfil</option>
                        <option value="1">Administrador</option>
                        <option value="2">Gestor</option>
                        <option value="3">Usuário</option>
                    </select>
                </div>

            </div>

            <div class="mt-8 flex justify-end gap-3 border-t border-slate-100 dark:border-slate-700 pt-5">
                <button type="button" id="btn-modal-cancel"
                    class="h-11 px-6 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-800 text-sm font-semibold transition-colors">
                    Cancelar
                </button>

                <button id="btn-modal-save" type="button"
                    class="h-11 px-6 rounded-lg bg-primary hover:bg-primary/90 text-white text-sm font-semibold shadow-sm transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Salvar
                </button>
            </div>

        </form>


    </div>
</div>
