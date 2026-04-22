{{-- Admin Sidebar --}}
<aside id="admin-sidebar" class="admin-sidebar">
    {{-- Logo --}}
    <div class="sidebar-logo">
        <h2>The Living Archive</h2>
        <span>Tanah Malind CMS</span>
    </div>

    {{-- Navigation --}}
    <nav class="sidebar-nav">
        <button class="nav-item active" data-page="page-dashboard">
            <span class="material-symbols-outlined">dashboard</span>
            Dashboard
        </button>

        <button class="nav-item" data-page="page-peta">
            <span class="material-symbols-outlined">map</span>
            Kelola Peta & GIS
        </button>

        <button class="nav-item" data-page="page-warisan">
            <span class="material-symbols-outlined">museum</span>
            Kelola Daftar Wisata & Warisan
        </button>

        <a href="{{ route('kategori-budaya.index') }}" wire:navigate class="nav-item {{ request()->routeIs('kategori-budaya.*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">category</span>
            Kelola Kategori Budaya
        </a>

         <a href="{{ route('cagar-budaya.index') }}" wire:navigate class="nav-item {{ request()->routeIs('cagar-budaya.*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">category</span>
            Kelola Cagar Budaya
        </a>

        <button class="nav-item" data-page="page-galeri">
            <span class="material-symbols-outlined">photo_library</span>
            Kelola Galeri
        </button>

        <button class="nav-item" data-page="page-berita">
            <span class="material-symbols-outlined">article</span>
            Kelola Berita
        </button>

        <button class="nav-item" data-page="page-verifikasi">
            <span class="material-symbols-outlined">fact_check</span>
            Verifikasi Laporan
        </button>

        <button class="nav-item" data-page="page-pengaturan">
            <span class="material-symbols-outlined">settings</span>
            Pengaturan
        </button>
    </nav>

    {{-- Footer --}}
    <div class="sidebar-footer">
        <button class="sidebar-new-record" onclick="document.querySelector('[data-page=page-warisan]').click()">
            <span class="material-symbols-outlined" style="font-size:18px">add</span>
            New Record
        </button>

        <div class="sidebar-user">
            <img class="sidebar-user-avatar"
                src="https://ui-avatars.com/api/?name=Admin+User&background=1A362D&color=D4AF37&bold=true&size=72"
                alt="Admin Avatar" />
            <div class="sidebar-user-info">
                <h4>Admin User</h4>
                <p>Archivist</p>
            </div>
        </div>
    </div>
</aside>
