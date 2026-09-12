{{-- Mitra Strategis Section --}}
<section class="py-16 md:py-24 bg-surface relative overflow-hidden border-t border-emerald-900/10">
    {{-- Decorative Background Glow --}}
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-3/4 max-w-4xl h-48 bg-gradient-to-r from-emerald-100/30 via-secondary-container/20 to-emerald-100/30 dark:from-emerald-900/10 dark:via-emerald-950/20 dark:to-emerald-900/10 rounded-full blur-3xl pointer-events-none -z-0"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 md:px-8">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-12 md:mb-16">
            {{-- Pill Badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-secondary-container/20 text-secondary text-xs font-semibold tracking-widest uppercase rounded-full mb-4 border border-secondary/20 shadow-xs">
                <span class="w-1.5 h-1.5 rounded-full bg-secondary animate-pulse"></span>
                <span>Kolaborasi</span>
            </div>

            {{-- Headline --}}
            <h2 class="font-headline text-3xl sm:text-4xl md:text-5xl font-bold text-primary dark:text-emerald-50 tracking-tight leading-tight">
                Mitra Strategis Kami
            </h2>

            {{-- Description --}}
            <p class="mt-4 text-base md:text-lg text-on-surface-variant dark:text-emerald-200/70 leading-relaxed font-body">
                Bekerja sama dengan kementerian dan lembaga terkemuka dalam upaya pelestarian, dokumentasi, dan pemajuan warisan budaya suku Malind Anim di wilayah Merauke.
            </p>
        </div>

        {{-- Logos Row --}}
        <div class="flex flex-wrap items-center justify-center gap-8 sm:gap-12 md:gap-16 lg:gap-20">
            {{-- Kementerian Kebudayaan RI --}}
            <a href="https://kebudayaan.kemdikbud.go.id"
               target="_blank"
               rel="noopener noreferrer"
               class="group relative flex items-center justify-center p-4 sm:p-6 rounded-2xl bg-white/60 dark:bg-emerald-950/40 hover:bg-white dark:hover:bg-emerald-900/40 border border-emerald-900/5 dark:border-emerald-800/30 shadow-xs hover:shadow-md hover:-translate-y-1 transition-all duration-300 min-w-[200px] h-24 sm:h-28"
               title="Kementerian Kebudayaan Republik Indonesia">
                <img src="{{ asset('LogoKembud.webp') }}"
                     alt="Kementerian Kebudayaan Republik Indonesia"
                     class="max-h-12 sm:max-h-14 w-auto object-contain filter grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-105 transition-all duration-300">
            </a>

            {{-- LPDP --}}
            <a href="https://lpdp.kemenkeu.go.id"
               target="_blank"
               rel="noopener noreferrer"
               class="group relative flex items-center justify-center p-4 sm:p-6 rounded-2xl bg-white/60 dark:bg-emerald-950/40 hover:bg-white dark:hover:bg-emerald-900/40 border border-emerald-900/5 dark:border-emerald-800/30 shadow-xs hover:shadow-md hover:-translate-y-1 transition-all duration-300 min-w-[180px] h-24 sm:h-28"
               title="Lembaga Pengelola Dana Pendidikan (LPDP)">
                <img src="{{ asset('LogoLPDP.png') }}"
                     alt="Lembaga Pengelola Dana Pendidikan"
                     class="max-h-12 sm:max-h-14 w-auto object-contain filter grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-105 transition-all duration-300">
            </a>

            {{-- Dana Indonesiana --}}
            <a href="https://danaindonesiana.kemdikbud.go.id"
               target="_blank"
               rel="noopener noreferrer"
               class="group relative flex items-center justify-center p-4 sm:p-6 rounded-2xl bg-white/60 dark:bg-emerald-950/40 hover:bg-white dark:hover:bg-emerald-900/40 border border-emerald-900/5 dark:border-emerald-800/30 shadow-xs hover:shadow-md hover:-translate-y-1 transition-all duration-300 min-w-[220px] h-24 sm:h-28"
               title="Dana Indonesiana">
                <img src="{{ asset('LOGOdanaIndonesiana.png') }}"
                     alt="Dana Indonesiana"
                     class="max-h-10 sm:max-h-12 w-auto object-contain filter grayscale opacity-70 group-hover:grayscale-0 group-hover:opacity-100 group-hover:scale-105 transition-all duration-300">
            </a>
        </div>
    </div>
</section>
