export function buildCrudActionButtonsHtml(entityName: string, rowId: number): string {
    return `
        <div class="flex items-center justify-end gap-2">
            <button type="button"
                class="btn-edit-${entityName} p-2 rounded-lg text-gray-500 hover:bg-gray-200 hover:scale-110 transition-all duration-200"
                data-id="${rowId}">
                <span class="material-symbols-outlined text-[20px]">edit</span>
            </button>
            <button type="button"
                class="btn-delete-${entityName} p-2 rounded-lg text-red-500 hover:text-red-600 hover:bg-red-100 hover:scale-110 transition-all duration-200"
                data-id="${rowId}">
                <span class="material-symbols-outlined text-[20px]">delete</span>
            </button>
        </div>`;
}