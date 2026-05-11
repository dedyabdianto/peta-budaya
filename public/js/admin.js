/**
 * Admin Panel — Warisan Malind CMS
 * Interaction Logic (non-SPA)
 */
document.addEventListener('DOMContentLoaded', () => {
    // ---- Mobile Sidebar Toggle ----
    const sidebar = document.getElementById('admin-sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const mobileToggle = document.getElementById('mobile-toggle');

    function openSidebar() {
        if (sidebar) sidebar.classList.add('open');
        if (overlay) overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        if (sidebar) sidebar.classList.remove('open');
        if (overlay) overlay.classList.remove('open');
        document.body.style.overflow = '';
    }

    if (mobileToggle) {
        mobileToggle.addEventListener('click', () => {
            if (sidebar && sidebar.classList.contains('open')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });
    }

    if (overlay) {
        overlay.addEventListener('click', closeSidebar);
    }

    // ---- Tab Filters ----
    document.querySelectorAll('.filter-tabs').forEach(tabGroup => {
        const tabs = tabGroup.querySelectorAll('.filter-tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
            });
        });
    });

    // ---- Toggle Add Form Views ----
    // Kelola Daftar — show/hide form
    const addWisataBtn = document.getElementById('btn-add-wisata');
    const wisataListView = document.getElementById('wisata-list-view');
    const wisataFormView = document.getElementById('wisata-form-view');
    const cancelWisataBtn = document.getElementById('cancel-wisata-form');

    if (addWisataBtn && wisataListView && wisataFormView) {
        addWisataBtn.addEventListener('click', () => {
            wisataListView.style.display = 'none';
            wisataFormView.style.display = 'block';
        });
    }

    if (cancelWisataBtn && wisataListView && wisataFormView) {
        cancelWisataBtn.addEventListener('click', () => {
            wisataFormView.style.display = 'none';
            wisataListView.style.display = 'block';
        });
    }

    // Kelola Berita — now uses SPA-style navigation (wire:navigate) to separate create/edit pages

    // ---- Upload Zone Drag & Drop Visual ----
    document.querySelectorAll('.upload-zone').forEach(zone => {
        zone.addEventListener('dragover', (e) => {
            e.preventDefault();
            zone.style.borderColor = '#D4AF37';
            zone.style.background = 'rgba(212,175,55,0.06)';
        });

        zone.addEventListener('dragleave', () => {
            zone.style.borderColor = '';
            zone.style.background = '';
        });

        zone.addEventListener('drop', (e) => {
            e.preventDefault();
            zone.style.borderColor = '';
            zone.style.background = '';
        });
    });

    // ---- Simple rich text editor toolbar ----
    document.querySelectorAll('.editor-toolbar button').forEach(btn => {
        btn.addEventListener('click', () => {
            const cmd = btn.dataset.cmd;
            if (cmd) {
                document.execCommand(cmd, false, null);
            }
        });
    });
});
