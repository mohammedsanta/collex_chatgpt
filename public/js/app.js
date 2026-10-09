(() => {
    const sidebar = document.getElementById('app-sidebar');
    const overlay = document.getElementById('app-overlay');
    const closeSidebar = () => { sidebar?.classList.remove('is-open'); overlay?.classList.remove('is-open'); document.body.classList.remove('overflow-hidden'); };
    document.querySelectorAll('[data-sidebar-toggle]').forEach(button => button.addEventListener('click', () => { sidebar?.classList.add('is-open'); overlay?.classList.add('is-open'); document.body.classList.add('overflow-hidden'); }));
    document.querySelectorAll('[data-sidebar-close]').forEach(button => button.addEventListener('click', closeSidebar));
    document.querySelectorAll('[data-modal-open]').forEach(button => button.addEventListener('click', () => { const modal = document.getElementById(button.dataset.modalOpen); if (modal) { modal.classList.remove('hidden'); modal.classList.add('flex'); } }));
    document.querySelectorAll('[data-modal-close]').forEach(button => button.addEventListener('click', () => { const modal = document.getElementById(button.dataset.modalClose); if (modal) { modal.classList.add('hidden'); modal.classList.remove('flex'); } }));
    document.querySelectorAll('[data-modal]').forEach(modal => modal.addEventListener('click', event => { if (event.target === modal) { modal.classList.add('hidden'); modal.classList.remove('flex'); } }));
    document.addEventListener('keydown', event => { if (event.key === 'Escape') { closeSidebar(); document.querySelectorAll('[data-modal]').forEach(modal => { modal.classList.add('hidden'); modal.classList.remove('flex'); }); } });
})();
