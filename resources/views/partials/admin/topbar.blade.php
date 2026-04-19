{{-- Admin Top Header Bar --}}
<header class="admin-topbar">
    <div class="topbar-left">
        {{-- Mobile hamburger --}}
        <button id="mobile-toggle" class="mobile-toggle">
            <span class="material-symbols-outlined">menu</span>
        </button>

        <span class="topbar-brand">Malind Heritage Archive</span>

        <div class="topbar-search">
            <span class="material-symbols-outlined">search</span>
            <input type="text" placeholder="Search archive..." />
        </div>
    </div>

    <div class="topbar-right">
        <a href="{{ route('home') }}" class="topbar-public-btn" target="_blank">
            <span class="material-symbols-outlined" style="font-size:16px">open_in_new</span>
            <span>Lihat Situs Publik</span>
        </a>

        <button class="topbar-icon-btn">
            <span class="material-symbols-outlined">notifications</span>
            <span class="notification-dot"></span>
        </button>

        <img class="topbar-profile" src="https://ui-avatars.com/api/?name=Admin+User&background=1A362D&color=D4AF37&bold=true&size=72" alt="Admin Profile" />
    </div>
</header>
