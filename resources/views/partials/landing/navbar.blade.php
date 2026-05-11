{{-- Landing Page Navbar --}}
<nav
    class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-4 md:px-8 py-3 w-[95%] max-w-7xl mx-auto mt-4 rounded-full bg-white/70 dark:bg-emerald-950/70 backdrop-blur-xl shadow-[0_40px_60px_-15px_rgba(27,28,25,0.06)]">
    <div class="flex items-center gap-2">
        <a href="{{ route('home') }}">
            <span
                class="font-headline text-xl md:text-2xl font-bold tracking-tighter text-emerald-900 dark:text-emerald-50">Warisan
                Malind</span>
        </a>
    </div>

    {{-- Desktop Navigation --}}
    <div class="hidden md:flex items-center gap-8 font-label text-base tracking-tight">
        <a class="{{ request()->routeIs('home') ? 'text-yellow-600 dark:text-yellow-500 font-semibold' : 'text-emerald-800 dark:text-emerald-200 opacity-80' }} hover:opacity-100 hover:scale-105 transition-all"
            href="{{ route('home') }}">Beranda</a>
        <a class="{{ request()->routeIs('landing.tentang-budaya') ? 'text-yellow-600 dark:text-yellow-500 font-semibold' : 'text-emerald-800 dark:text-emerald-200 opacity-80' }} hover:opacity-100 hover:scale-105 transition-all"
            href="{{ route('landing.tentang-budaya') }}">Tentang Budaya</a>
        <a class="{{ request()->routeIs('landing.daftar-warisan') ? 'text-yellow-600 dark:text-yellow-500 font-semibold' : 'text-emerald-800 dark:text-emerald-200 opacity-80' }} hover:opacity-100 hover:scale-105 transition-all"
            href="{{ route('landing.daftar-warisan') }}">Daftar Warisan</a>
        <a class="{{ request()->routeIs('landing.galeri-warisan') ? 'text-yellow-600 dark:text-yellow-500 font-semibold' : 'text-emerald-800 dark:text-emerald-200 opacity-80' }} hover:opacity-100 hover:scale-105 transition-all"
            href="{{ route('landing.galeri-warisan') }}">Galeri</a>
        <a class="{{ request()->routeIs('landing.peta-digital') ? 'text-yellow-600 dark:text-yellow-500 font-semibold' : 'text-emerald-800 dark:text-emerald-200 opacity-80' }} hover:opacity-100 hover:scale-105 transition-all flex items-center gap-1"
            href="{{ route('landing.peta-digital') }}"><span class="material-symbols-outlined text-base">map</span>Peta</a>
        <a class="{{ request()->routeIs('landing.lapor-situs') ? 'text-yellow-600 dark:text-yellow-500 font-semibold' : 'text-emerald-800 dark:text-emerald-200 opacity-80' }} hover:opacity-100 hover:scale-105 transition-all"
            href="{{ route('landing.lapor-situs') }}">Lapor Situs</a>
    </div>

    <div class="flex items-center gap-2">
        {{-- Login Button --}}
        <a href="{{ route('login') }}"
            class="flex items-center gap-2 px-4 md:px-5 py-2 bg-primary-container text-white text-sm font-medium rounded-full hover:bg-primary transition-all hover:scale-105">
            <span class="material-symbols-outlined text-lg">login</span>
            <span class="hidden sm:inline">Masuk</span>
        </a>

        {{-- Mobile Hamburger Button --}}
        <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
            class="md:hidden flex items-center justify-center w-10 h-10 rounded-full hover:bg-emerald-100/50 transition-colors">
            <span class="material-symbols-outlined text-emerald-900">menu</span>
        </button>
    </div>
</nav>

{{-- Mobile Navigation Menu --}}
<div id="mobile-menu"
    class="hidden fixed top-20 left-0 right-0 z-40 mx-4 bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-emerald-100/50 md:hidden">
    <div class="flex flex-col p-4 space-y-1">
        <a class="px-4 py-3 rounded-xl text-base font-medium transition-colors {{ request()->routeIs('home') ? 'bg-emerald-50 text-yellow-600 font-semibold' : 'text-emerald-800 hover:bg-emerald-50/50' }}"
            href="{{ route('home') }}">Beranda</a>
        <a class="px-4 py-3 rounded-xl text-base font-medium transition-colors {{ request()->routeIs('landing.tentang-budaya') ? 'bg-emerald-50 text-yellow-600 font-semibold' : 'text-emerald-800 hover:bg-emerald-50/50' }}"
            href="{{ route('landing.tentang-budaya') }}">Tentang Budaya</a>
        <a class="px-4 py-3 rounded-xl text-base font-medium transition-colors {{ request()->routeIs('landing.daftar-warisan') ? 'bg-emerald-50 text-yellow-600 font-semibold' : 'text-emerald-800 hover:bg-emerald-50/50' }}"
            href="{{ route('landing.daftar-warisan') }}">Daftar Warisan</a>
        <a class="px-4 py-3 rounded-xl text-base font-medium transition-colors {{ request()->routeIs('landing.galeri-warisan') ? 'bg-emerald-50 text-yellow-600 font-semibold' : 'text-emerald-800 hover:bg-emerald-50/50' }}"
            href="{{ route('landing.galeri-warisan') }}">Galeri Warisan</a>
        <a class="px-4 py-3 rounded-xl text-base font-medium transition-colors flex items-center gap-2 {{ request()->routeIs('landing.peta-digital') ? 'bg-emerald-50 text-yellow-600 font-semibold' : 'text-emerald-800 hover:bg-emerald-50/50' }}"
            href="{{ route('landing.peta-digital') }}"><span class="material-symbols-outlined text-lg">map</span>Peta Digital</a>
        <a class="px-4 py-3 rounded-xl text-base font-medium transition-colors {{ request()->routeIs('landing.lapor-situs') ? 'bg-emerald-50 text-yellow-600 font-semibold' : 'text-emerald-800 hover:bg-emerald-50/50' }}"
            href="{{ route('landing.lapor-situs') }}">Lapor Situs</a>
    </div>
</div>
