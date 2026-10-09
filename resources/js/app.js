import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
if (csrf) window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrf;

// Collex progressive-enhancement helpers: dialogs, menus, mobile sidebar and bulk checkboxes.
document.addEventListener('click', (event) => {
    const target = event.target instanceof Element ? event.target : event.target?.parentElement;
    if (!target) return;

    const sidebarToggle = target.closest('[data-sidebar-toggle]');
    const sidebarClose = target.closest('[data-sidebar-close]');
    const sidebar = document.getElementById('app-sidebar');
    const overlay = document.getElementById('app-overlay');

    if (sidebarToggle && sidebar) {
        sidebar.classList.toggle('is-open');
        overlay?.classList.toggle('is-visible', sidebar.classList.contains('is-open'));
        document.body.classList.toggle('overflow-hidden', sidebar.classList.contains('is-open'));
        return;
    }
    if (sidebarClose && sidebar) {
        sidebar.classList.remove('is-open');
        overlay?.classList.remove('is-visible');
        document.body.classList.remove('overflow-hidden');
        return;
    }

    const modalOpener = target.closest('[data-open-modal], [data-modal-open]');
    if (modalOpener) {
        const id = modalOpener.dataset.openModal || modalOpener.dataset.modalOpen;
        const modal = id ? document.getElementById(id) : null;
        if (modal instanceof HTMLDialogElement) modal.showModal();
        else if (modal) { modal.classList.remove('hidden'); modal.classList.add('flex'); modal.setAttribute('aria-modal', 'true'); }
        return;
    }

    const modalCloser = target.closest('[data-close-modal], [data-modal-close]');
    if (modalCloser) {
        const id = modalCloser.dataset.modalClose;
        const modal = id ? document.getElementById(id) : modalCloser.closest('dialog, [data-modal]');
        if (modal instanceof HTMLDialogElement) modal.close();
        else if (modal) { modal.classList.add('hidden'); modal.classList.remove('flex'); modal.removeAttribute('aria-modal'); }
        return;
    }

    if (target.matches('dialog')) target.close();

    document.querySelectorAll('details[data-menu][open]').forEach((menu) => {
        if (!menu.contains(target)) menu.removeAttribute('open');
    });

    // Close custom modal when clicking its backdrop (not its inner card).
    const backdrop = target.closest('[data-modal]');
    if (backdrop && target === backdrop) {
        backdrop.classList.add('hidden');
        backdrop.classList.remove('flex');
        backdrop.removeAttribute('aria-modal');
    }
});

document.addEventListener('change', (event) => {
    const target = event.target;
    if (!(target instanceof HTMLInputElement)) return;
    const selector = target.dataset.checkAll;
    if (!selector) return;
    try {
        document.querySelectorAll(selector).forEach((checkbox) => {
            if (checkbox instanceof HTMLInputElement && checkbox.type === 'checkbox') {
                checkbox.checked = target.checked;
                checkbox.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });
    } catch (error) {
        console.warn('Collex: invalid data-check-all selector.', error);
    }
});

// Keep keyboard users able to dismiss custom modal panels with Escape.
document.addEventListener('keydown', (event) => {
    if (event.key !== 'Escape') return;
    document.querySelectorAll('[data-modal]:not(.hidden)').forEach((modal) => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        modal.removeAttribute('aria-modal');
    });
    const sidebar = document.getElementById('app-sidebar');
    const overlay = document.getElementById('app-overlay');
    sidebar?.classList.remove('is-open');
    overlay?.classList.remove('is-visible');
    document.body.classList.remove('overflow-hidden');
});
