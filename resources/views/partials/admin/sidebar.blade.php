{{-- Admin Sidebar --}}
<aside id="admin-sidebar" class="admin-sidebar">
    {{-- Logo --}}
    <div class="sidebar-logo">
        <h2>The Living Archive</h2>
        <span>Tanah Malind CMS</span>
    </div>

    {{-- Navigation --}}
    <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}" wire:navigate class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="material-symbols-outlined">dashboard</span>
            Dashboard
        </a>

        <a href="{{ route('peta.index') }}" wire:navigate class="nav-item {{ request()->routeIs('peta.*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">map</span>
            Kelola Peta & GIS
        </a>

        {{-- <a href="{{ route('warisan.index') }}" wire:navigate class="nav-item {{ request()->routeIs('warisan.*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">museum</span>
            Kelola Daftar Wisata & Warisan
        </a> --}}

        <a href="{{ route('kategori-budaya.index') }}" wire:navigate class="nav-item {{ request()->routeIs('kategori-budaya.*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">category</span>
            Kelola Kategori Budaya
        </a>

         <a href="{{ route('cagar-budaya.index') }}" wire:navigate class="nav-item {{ request()->routeIs('cagar-budaya.*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">category</span>
            Kelola Cagar Budaya
        </a>

     
        <a href="{{ route('galeri.index') }}" wire:navigate class="nav-item {{ request()->routeIs('galeri.*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">photo_library</span>
            Kelola Galeri
        </a>

        <a href="{{ route('berita.index') }}" wire:navigate class="nav-item {{ request()->routeIs('berita.*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">article</span>
            Kelola Berita
        </a>

        <a href="{{ route('verifikasi.index') }}" wire:navigate class="nav-item {{ request()->routeIs('verifikasi.*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">fact_check</span>
            Verifikasi Laporan
        </a>

        <a href="{{ route('pengaturan.index') }}" wire:navigate class="nav-item {{ request()->routeIs('pengaturan.*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">settings</span>
            Pengaturan
        </a>
    </nav>

    {{-- Footer --}}
    <div class="sidebar-footer">
        <a href="{{ route('warisan.index') }}" wire:navigate class="sidebar-new-record">
            <span class="material-symbols-outlined" style="font-size:18px">add</span>
            New Record
        </a>

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
