<div id="modal-create-location" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
    <div class="w-full max-w-lg rounded-xl bg-white dark:bg-background-dark p-6 shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-[#0d141b] dark:text-slate-200">
                Adicionar local
            </h2>
            <button id="btn-modal-close-location" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                ✕
            </button>
        </div>

        <form id="form-create-location" class="mt-4">
            <div class="grid grid-cols-1 gap-4">
                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">Nome*</label>
                    <input id="input-create-location-name" type="text" placeholder="Ex: Matriz"
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-[#edf2f7] dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200" />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">Endereco*</label>
                    <input id="input-create-location-address" type="text" placeholder="Rua Exemplo, 123"
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-[#edf2f7] dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200" />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">Cidade*</label>
                    <input id="input-create-location-city" type="text" placeholder="Sao Paulo"
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-[#edf2f7] dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200" />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">Estado*</label>
                    <input id="input-create-location-state" type="text" placeholder="SP"
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-[#edf2f7] dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200" />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">CEP*</label>
                    <input id="input-create-location-cep" type="text" placeholder="00000-000"
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-[#edf2f7] dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200" />
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3 border-t border-slate-100 dark:border-slate-700 pt-5">
                <button type="button" id="btn-modal-cancel-location"
                    class="h-11 px-6 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 text-sm font-semibold">
                    Cancelar
                </button>

                <button id="btn-modal-save-location" type="button"
                    class="h-11 px-6 rounded-lg bg-primary hover:bg-primary/90 text-white text-sm font-semibold shadow-sm">
                    Salvar
                </button>
            </div>
        </form>
    </div>
</div>
