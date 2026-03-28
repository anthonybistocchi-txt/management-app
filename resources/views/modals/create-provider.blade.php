<div id="modal-create-provider" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
    <div class="w-full max-w-2xl rounded-xl bg-white dark:bg-background-dark p-6 shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-[#0d141b] dark:text-slate-200">
                Adicionar fornecedor
            </h2>
            <button id="btn-modal-close-provider" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                ✕
            </button>
        </div>

        <form id="form-create-provider" class="mt-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                <div class="flex flex-col gap-1 md:col-span-2">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">Nome*</label>
                    <input id="input-create-provider-name" type="text" placeholder="Ex: ABC Distribuidora"
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-[#edf2f7] dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200 placeholder:text-[#94a3b8] dark:placeholder:text-slate-500" />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">CNPJ*</label>
                    <input id="input-create-provider-cnpj" type="text" placeholder="00.000.000/0000-00"
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-[#edf2f7] dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200 placeholder:text-[#94a3b8] dark:placeholder:text-slate-500" />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">Telefone</label>
                    <input id="input-create-provider-phone" type="text" placeholder="(00) 00000-0000"
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-[#edf2f7] dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200 placeholder:text-[#94a3b8] dark:placeholder:text-slate-500" />
                </div>

                <div class="flex flex-col gap-1 md:col-span-2">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">Email*</label>
                    <input id="input-create-provider-email" type="email" placeholder="contato@fornecedor.com"
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-[#edf2f7] dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200 placeholder:text-[#94a3b8] dark:placeholder:text-slate-500" />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">CEP*</label>
                    <input id="input-create-provider-cep" type="text" placeholder="00000-000"
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-[#edf2f7] dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200 placeholder:text-[#94a3b8] dark:placeholder:text-slate-500" />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">Rua*</label>
                    <input id="input-create-provider-street" type="text" placeholder="Rua Exemplo"
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-[#edf2f7] dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200 placeholder:text-[#94a3b8] dark:placeholder:text-slate-500" />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">Numero*</label>
                    <input id="input-create-provider-number" type="text" placeholder="123"
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-[#edf2f7] dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200 placeholder:text-[#94a3b8] dark:placeholder:text-slate-500" />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">Cidade*</label>
                    <select id="select-create-provider-city"></select>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">Estado*</label>
                    <select id="select-create-provider-state"></select>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3 border-t border-slate-100 dark:border-slate-700 pt-5">
                <button type="button" id="btn-modal-cancel-provider"
                    class="h-11 px-6 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 text-sm font-semibold">
                    Cancelar
                </button>

                <button id="btn-modal-save-provider" type="button"
                    class="h-11 px-6 rounded-lg bg-primary hover:bg-primary/90 text-white text-sm font-semibold shadow-sm">
                    Salvar
                </button>
            </div>
        </form>
    </div>
</div>
