<x-layouts::landing :title="__('Beranda')">
    {{-- Hero Section --}}
    <header class="relative h-screen w-full flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img alt="Tanah Malind Landscape" class="w-full h-full object-cover"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBlRRSWmEYIop32FmBjp8vrrDs12iYR2njp6n0lqnsgV5LTmmhtyrDP_LCmZRhfva_WFfpOmo1etxA4jkk7iO7ZOGFa6Q-zEq78qnjE-E6L0Rs_Ic9U4-DA5eAfZhqTIt4vBTE2hSoV9LGNvm9DqHV8pl54JoiZ7AyN0rY0sNUQ1oSBmVPwX5EoHlABDwMh0lNeyGD44wLB4_UyWKqkKM_onoNT3Izq-mLWKzWEE3gNnD1EorM7sdKzWPZs8PtEyWtWHoqf6DHzrkU" />
            <div class="absolute inset-0 bg-gradient-to-b from-primary/60 via-primary/40 to-surface"></div>
        </div>
        <div class="relative z-10 max-w-5xl px-6 md:px-8 text-center text-on-primary">
            <h1 class="font-headline text-3xl sm:text-4xl md:text-6xl lg:text-7xl font-bold tracking-tight mb-4 md:mb-6 leading-tight">
                Selamat Datang di Portal Geospasial Warisan Budaya Tanah Malind
            </h1>
            <p class="text-base md:text-xl font-light opacity-90 mb-8 md:mb-10 max-w-3xl mx-auto leading-relaxed">
                Jelajahi jejak sejarah, situs sakral, dan kekayaan budaya leluhur melalui pemetaan digital interaktif
                yang didedikasikan untuk kelestarian identitas adat Malind.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4">
                <a class="w-full sm:w-auto px-8 md:px-10 py-3 md:py-4 bg-primary-container text-white font-medium rounded-xl hover:bg-primary transition-all scale-95 hover:scale-100 flex items-center justify-center gap-2"
                    href="#gis-map">
                    <span class="material-symbols-outlined">map</span>
                    Jelajahi Peta
                </a>
                <a class="w-full sm:w-auto px-8 md:px-10 py-3 md:py-4 border border-white/30 backdrop-blur-md bg-white/10 text-white font-medium rounded-xl hover:bg-white/20 transition-all scale-95 hover:scale-100 text-center"
                    href="{{ route('landing.tentang-budaya') }}">
                    Pelajari Budaya
                </a>
            </div>
        </div>
    </header>

    {{-- Intro Section --}}
    <section class="py-16 md:py-24 bg-surface">
        <div class="max-w-7xl mx-auto px-6 md:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            <div class="space-y-6 md:space-y-8">
                <div
                    class="inline-block px-4 py-1.5 bg-secondary-container/20 text-secondary text-sm font-semibold tracking-widest uppercase rounded-full">
                    Warisan Abadi
                </div>
                <h2 class="font-headline text-3xl md:text-4xl lg:text-5xl text-primary leading-tight">
                    Menjaga Akar Budaya di Era Digital
                </h2>
                <div class="space-y-4 md:space-y-6 text-on-surface-variant text-base md:text-lg leading-relaxed">
                    <p>
                        Digitalisasi Peta Warisan Kebudayaan Tanah Malind merupakan inisiatif untuk mendokumentasikan
                        secara spasial titik-titik sakral dan peninggalan sejarah suku Malind Anim di wilayah Merauke.
                    </p>
                    <p>
                        Setiap koordinat menyimpan narasi yang diturunkan melalui lisan, dari totem leluhur hingga
                        monumen yang telah berdiri berabad-abad, memastikan pengetahuan ini tetap hidup untuk generasi
                        mendatang.
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 md:gap-6">
                <div
                    class="p-5 md:p-8 bg-surface-container-low rounded-xl flex flex-col justify-center border-l-4 border-secondary">
                    <span class="text-3xl md:text-4xl font-headline font-bold text-primary mb-1 md:mb-2">50+</span>
                    <span class="text-on-surface-variant font-medium text-sm md:text-base">Situs Terdokumentasi</span>
                </div>
                <div
                    class="p-5 md:p-8 bg-surface-container-low rounded-xl flex flex-col justify-center border-l-4 border-tertiary-container">
                    <span class="text-3xl md:text-4xl font-headline font-bold text-primary mb-1 md:mb-2">10+</span>
                    <span class="text-on-surface-variant font-medium text-sm md:text-base">Kategori Warisan</span>
                </div>
                <div
                    class="p-5 md:p-8 bg-surface-container-low rounded-xl flex flex-col justify-center border-l-4 border-primary">
                    <span class="text-3xl md:text-4xl font-headline font-bold text-primary mb-1 md:mb-2">100%</span>
                    <span class="text-on-surface-variant font-medium text-sm md:text-base">Akses Publik</span>
                </div>
                <div
                    class="p-5 md:p-8 bg-surface-container-low rounded-xl flex flex-col justify-center border-l-4 border-secondary">
                    <span class="text-3xl md:text-4xl font-headline font-bold text-primary mb-1 md:mb-2">24/7</span>
                    <span class="text-on-surface-variant font-medium text-sm md:text-base">Pemantauan Digital</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Interactive Web GIS Section --}}
    <section class="py-12 md:py-20 bg-surface-container-low" id="gis-map">
        <div class="max-w-7xl mx-auto px-6 md:px-8 mb-8 md:mb-12 flex flex-col md:flex-row items-start md:items-end justify-between gap-4 md:gap-6">
            <div class="max-w-2xl">
                <h2 class="font-headline text-2xl md:text-4xl text-primary mb-2 md:mb-4">Peta Interaktif Warisan Budaya</h2>
                <p class="text-on-surface-variant text-sm md:text-base">Gunakan kontrol di bawah untuk menelusuri lokasi situs sakral, rumah
                    adat, dan titik sejarah di seluruh Tanah Malind secara presisi.</p>
            </div>
            <button class="flex items-center gap-2 text-primary font-semibold hover:gap-3 transition-all text-sm md:text-base">
                Buka Layar Penuh <span class="material-symbols-outlined">fullscreen</span>
            </button>
        </div>
        <div class="relative w-full h-[400px] md:h-[600px] lg:h-[819px] max-w-7xl mx-auto rounded-xl overflow-hidden shadow-2xl bg-surface-dim">
            {{-- Mockup Map Background --}}
            <div class="absolute inset-0 z-0">
                <img alt="Satellite Map View" class="w-full h-full object-cover"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBq9sJQASx9w4rwxwEZ59GBAT7Be_qnqGHL5dyik_JlgP9JS7lEpn8pfATuvJlQXpR1Yzjcq3gehFnnxlrJAdG02J2A3NS8tZN3UVaW7N4gLfM559m7-h4CJ54H7oFTZ7C44Hj615GMZQt5c4C8p4znwrXC-S_f-cjfVvG6TItIuh-szPwEKQ3PrvuauRigpKyVS_oiGunTvLkcKggbF6o0bq5erpbF9kjGwqk4MW8qL3nnJKHovOGnLeCS9M5iDuoF7gxP93LDVC0" />
            </div>
            {{-- Glassmorphic Sidebar — hidden on mobile --}}
            <aside
                class="hidden md:flex absolute top-6 left-6 bottom-6 w-80 z-20 flex-col bg-white/70 backdrop-blur-xl rounded-xl border border-white/20 shadow-xl">
                <div class="p-4 border-b border-on-surface/5">
                    <div class="relative mb-4">
                        <input
                            class="w-full bg-surface-container/50 border-none rounded-lg pl-10 focus:ring-secondary text-sm"
                            placeholder="Cari situs atau wilayah..." type="text" />
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                    </div>
                    <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide">
                        <button class="px-4 py-1.5 bg-primary text-white rounded-full text-xs font-medium whitespace-nowrap">Semua</button>
                        <button class="px-4 py-1.5 bg-surface-container-highest text-on-surface rounded-full text-xs font-medium whitespace-nowrap">Situs Sakral</button>
                        <button class="px-4 py-1.5 bg-surface-container-highest text-on-surface rounded-full text-xs font-medium whitespace-nowrap">Rumah Adat</button>
                    </div>
                </div>
                <div class="flex-1 overflow-y-auto p-4 space-y-4">
                    <div class="p-3 bg-white/40 hover:bg-white/80 rounded-lg cursor-pointer transition-colors border border-transparent hover:border-secondary/20">
                        <h4 class="font-bold text-primary text-sm">Situs Monumen Kapsul Waktu</h4>
                        <p class="text-xs text-on-surface-variant line-clamp-1">Kecamatan Merauke, Papua Selatan</p>
                    </div>
                    <div class="p-3 bg-white/40 hover:bg-white/80 rounded-lg cursor-pointer transition-colors border border-transparent hover:border-secondary/20">
                        <h4 class="font-bold text-primary text-sm">Rumah Adat Gotad</h4>
                        <p class="text-xs text-on-surface-variant line-clamp-1">Kampung Wayau, Distrik Anim Ha</p>
                    </div>
                    <div class="p-3 bg-white/40 hover:bg-white/80 rounded-lg cursor-pointer transition-colors border border-transparent hover:border-secondary/20">
                        <h4 class="font-bold text-primary text-sm">Hutan Sakral Ndalir</h4>
                        <p class="text-xs text-on-surface-variant line-clamp-1">Kawasan Konservasi Tradisional</p>
                    </div>
                </div>
            </aside>
            {{-- Map Markers --}}
            <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 z-10 cursor-pointer group">
                <span class="material-symbols-outlined text-secondary text-4xl md:text-5xl group-hover:scale-110 transition-transform drop-shadow-md"
                    style="font-variation-settings: 'FILL' 1;">location_on</span>
            </div>
            <div class="absolute bottom-1/4 right-1/3 z-10 cursor-pointer group">
                <span class="material-symbols-outlined text-tertiary-container text-3xl md:text-4xl group-hover:scale-110 transition-transform drop-shadow-md"
                    style="font-variation-settings: 'FILL' 1;">location_on</span>
            </div>
            {{-- Active Popup Card — hidden on small mobile --}}
            <div class="hidden sm:block absolute top-[35%] left-[55%] z-30 w-64 md:w-72 bg-white rounded-xl shadow-2xl overflow-hidden border border-white/30">
                <img alt="Situs Detail" class="w-full h-24 md:h-32 object-cover"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAGx7j_0cCdHmbvz-IJ1Cxj5RS30wY3iGO5X2-PbpW--GkywTLkh9Q3L3rVpnZEooqyFqg94x7VTsK1zQof6hqT39e9CYA482-G6DPpEEJPQBZ-T6aZ669fNtlrDfXgSmB8h105nnToCCNP_UlNZYztqhAddhGxE4LTDCU_zbReHoJpQQvqXZTgybB4Sfoqo4XpTJszHeKLLSrVrxztQVDDrCsion56tUqGuVl-suTISS8FxJI9hqJuv57DNzVrX_aysxhzYnM0bEE" />
                <div class="p-3 md:p-4">
                    <span class="text-[10px] uppercase tracking-widest text-secondary font-bold">Kategori: Rumah Adat</span>
                    <h3 class="font-headline text-base md:text-lg text-primary mt-1">Gotad Tradisional Malind</h3>
                    <p class="text-xs text-on-surface-variant mt-2 leading-relaxed">Pusat inisiasi pemuda adat Malind
                        yang masih terjaga keasliannya sejak ratusan tahun.</p>
                    <button class="mt-3 md:mt-4 w-full py-2 bg-primary-container text-white text-xs font-bold rounded-lg hover:bg-primary transition-colors">Lihat Detail Situs</button>
                </div>
                <div class="absolute top-2 right-2 flex items-center justify-center w-8 h-8 rounded-full bg-black/20 backdrop-blur-md text-white cursor-pointer hover:bg-black/40 transition-colors">
                    <span class="material-symbols-outlined text-sm">close</span>
                </div>
            </div>
            {{-- Zoom Controls --}}
            <div class="absolute bottom-4 right-4 md:bottom-10 md:right-10 z-20 flex flex-col gap-2">
                <button class="w-10 h-10 md:w-12 md:h-12 bg-white/80 backdrop-blur-md rounded-xl flex items-center justify-center shadow-lg hover:bg-white transition-all">
                    <span class="material-symbols-outlined text-primary">add</span>
                </button>
                <button class="w-10 h-10 md:w-12 md:h-12 bg-white/80 backdrop-blur-md rounded-xl flex items-center justify-center shadow-lg hover:bg-white transition-all">
                    <span class="material-symbols-outlined text-primary">remove</span>
                </button>
                <button class="w-10 h-10 md:w-12 md:h-12 bg-white/80 backdrop-blur-md rounded-xl flex items-center justify-center shadow-lg hover:bg-white transition-all mt-2 md:mt-4">
                    <span class="material-symbols-outlined text-primary">my_location</span>
                </button>
            </div>
        </div>
    </section>
</x-layouts::landing>
