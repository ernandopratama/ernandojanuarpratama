<dialog id="confirm-dialog" class="m-auto bg-surface-container text-on-background border border-outline-variant/40 rounded-lg p-8 max-w-sm w-full backdrop:bg-[#0A2947]/80">
    <div class="flex items-start gap-4">
        <span class="material-symbols-outlined text-error text-[28px]">warning</span>
        <div class="flex-grow">
            <h2 class="font-headline-sm text-headline-sm mb-2">Confirm Deletion</h2>
            <p class="font-body-md text-body-md text-on-surface-variant" data-confirm-message>Are you sure you want to delete this record? This action cannot be undone.</p>
        </div>
    </div>
    <div class="flex justify-end gap-3 mt-8">
        <button type="button" data-dialog-cancel class="border border-outline-variant/30 text-on-surface-variant hover:border-secondary hover:text-secondary px-6 py-2.5 rounded font-label-caps text-label-caps uppercase transition-colors">
            Cancel
        </button>
        <button type="button" data-dialog-confirm class="bg-error text-on-error font-label-caps text-label-caps uppercase px-6 py-2.5 rounded hover:opacity-90 transition-opacity">
            Delete
        </button>
    </div>
</dialog>