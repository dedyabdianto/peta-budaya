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
                    href="{{ route('landing.peta-digital') }}">
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
</x-layouts::landing>
