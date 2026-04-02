<div id="modal-delete-location" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 hidden">
    <div class="w-full max-w-md rounded-xl bg-white dark:bg-background-dark p-6 shadow-lg">
        <div class="flex items-center justify-between mb-2">
            <h2 class="text-lg font-semibold text-[#0d141b] dark:text-slate-200">Excluir local</h2>
            <button id="btn-modal-close-location-delete" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                ✕
            </button>
        </div>

        <p class="text-sm text-[#4c739a] dark:text-slate-400">
            Tem certeza que deseja excluir este local? Esta acao nao podera ser desfeita.
        </p>

        <input id="input-delete-location-id" type="hidden" />

        <div class="mt-6 flex justify-end gap-3 border-t border-slate-100 dark:border-slate-700 pt-5">
            <button type="button" id="btn-modal-cancel-location-delete"
                class="h-11 px-6 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 text-sm font-semibold">
                Cancelar
            </button>

            <button id="btn-modal-confirm-location-delete" type="button"
                class="h-11 px-6 rounded-lg bg-red-600 hover:bg-red-700 text-white text-sm font-semibold shadow-sm">
                Excluir
            </button>
        </div>
    </div>
</div>
