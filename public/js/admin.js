/**
 * Admin Panel — Warisan Malind CMS
 * SPA-like Navigation & Interaction Logic
 */
document.addEventListener('DOMContentLoaded', () => {
    // ---- SPA Navigation ----
    const navItems = document.querySelectorAll('.nav-item[data-page]');
    const pageSections = document.querySelectorAll('.page-section');

    function navigateTo(page) {
        // Update nav active state
        navItems.forEach(item => {
            item.classList.toggle('active', item.dataset.page === page);
        });

        // Show/hide pages
        pageSections.forEach(section => {
            section.classList.toggle('active', section.id === page);
        });

        // Close mobile sidebar
        closeSidebar();
    }

    navItems.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            navigateTo(item.dataset.page);
        });
    });

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

    // ---- Tab Filters (Daftar Warisan & Verifikasi) ----
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

    // Kelola Berita — show/hide form
    const addBeritaBtn = document.getElementById('btn-add-berita');
    const beritaListView = document.getElementById('berita-list-view');
    const beritaFormView = document.getElementById('berita-form-view');
    const cancelBeritaBtn = document.getElementById('cancel-berita-form');

    if (addBeritaBtn && beritaListView && beritaFormView) {
        addBeritaBtn.addEventListener('click', () => {
            beritaListView.style.display = 'none';
            beritaFormView.style.display = 'block';
        });
    }

    if (cancelBeritaBtn && beritaListView && beritaFormView) {
        cancelBeritaBtn.addEventListener('click', () => {
            beritaFormView.style.display = 'none';
            beritaListView.style.display = 'block';
        });
    }

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
