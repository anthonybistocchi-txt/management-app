<div id="modal-create-product" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
    <div class="w-full max-w-2xl rounded-xl bg-white dark:bg-background-dark p-6 shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-[#0d141b] dark:text-slate-200">
                Adicionar produto
            </h2>
            <button id="btn-modal-close-product" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                ✕
            </button>
        </div>

        <form id="form-create-product" class="mt-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                <div class="flex flex-col gap-1 md:col-span-2">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">Nome*</label>
                    <input id="input-create-product-name" type="text" placeholder="Ex: Teclado mecanico"
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-[#edf2f7] dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200" />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">Categoria*</label>
                    <select id="select-create-product-category"></select>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">Fornecedor*</label>
                    <select id="select-create-product-provider"></select>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">Preco*</label>
                    <input id="input-create-product-price" type="text" inputmode="decimal" placeholder="0,00"
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-[#edf2f7] dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200" />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">Estoque inicial</label>
                    <input id="input-create-product-quantity" type="number" min="0" placeholder="0"
                        class="h-11 w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-[#edf2f7] dark:bg-slate-800 px-3 text-sm text-[#0d141b] dark:text-slate-200" />
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">Localizacao</label>
                    <select id="select-create-product-location"></select>
                </div>

                <div class="flex flex-col gap-1 md:col-span-2">
                    <label class="text-sm font-medium text-[#0d141b] dark:text-slate-300">Descricao</label>
                    <textarea id="textarea-create-product-description" rows="3"
                        class="w-full rounded-lg border border-[#cfdbe7] dark:border-slate-700 bg-[#edf2f7] dark:bg-slate-800 px-3 py-2 text-sm text-[#0d141b] dark:text-slate-200"></textarea>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3 border-t border-slate-100 dark:border-slate-700 pt-5">
                <button type="button" id="btn-modal-cancel-product"
                    class="h-11 px-6 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 text-sm font-semibold">
                    Cancelar
                </button>

                <button id="btn-modal-save-product" type="button"
                    class="h-11 px-6 rounded-lg bg-primary hover:bg-primary/90 text-white text-sm font-semibold shadow-sm">
                    Salvar
                </button>
            </div>
        </form>
    </div>
</div>
