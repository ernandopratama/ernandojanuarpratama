// Admin console — vanilla JavaScript behaviors (no frameworks).

document.addEventListener('DOMContentLoaded', () => {
    // Mobile sidebar drawer
    const menuBtn = document.getElementById('mobile-menu-btn');
    const sidebar = document.querySelector('aside');
    if (menuBtn && sidebar) {
        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        document.querySelectorAll('[data-sidebar-close]').forEach((link) => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    sidebar.classList.add('-translate-x-full');
                }
            });
        });
    }

    // Delete confirmation via native <dialog>
    const dialog = document.getElementById('confirm-dialog');
    if (dialog) {
        const messageEl = dialog.querySelector('[data-confirm-message]');
        const confirmBtn = dialog.querySelector('[data-dialog-confirm]');
        const cancelBtn = dialog.querySelector('[data-dialog-cancel]');
        let pendingForm = null;

        dialog.addEventListener('close', () => {
            pendingForm = null;
        });

        document.querySelectorAll('form[data-confirm]').forEach((form) => {
            form.addEventListener('submit', (event) => {
                event.preventDefault();
                pendingForm = form;
                if (messageEl) {
                    messageEl.textContent = form.dataset.confirm || 'Are you sure you want to delete this record? This action cannot be undone.';
                }
                dialog.showModal();
            });
        });

        if (confirmBtn) {
            confirmBtn.addEventListener('click', () => {
                dialog.close();
                if (pendingForm) {
                    const form = pendingForm;
                    pendingForm = null;
                    form.submit();
                }
            });
        }

        if (cancelBtn) {
            cancelBtn.addEventListener('click', () => dialog.close());
        }
    }

    // Image upload preview
    document.querySelectorAll('[data-preview-input]').forEach((input) => {
        input.addEventListener('change', () => {
            const preview = document.getElementById(input.dataset.previewTarget);
            if (!preview || !input.files || !input.files[0]) {
                return;
            }
            const reader = new FileReader();
            reader.onload = (event) => {
                preview.src = event.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        });
    });
});