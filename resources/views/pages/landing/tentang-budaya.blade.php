<x-layouts::landing :title="__('Tentang Budaya')">
    {{-- Hero Section --}}
    <header class="relative h-[500px] md:h-[700px] lg:h-[870px] w-full flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img class="w-full h-full object-cover"
                data-alt="cinematic wide shot of mist-covered dense tropical rainforest in Papua at dawn with soft golden light rays piercing through the canopy"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCllKcRuyJ-1tub7e6pc24AAAPLGJHtGNx110zFbSoRNSqkXgMGO1PW4BWZUw58P3i7h9EisPiZZCeNU4CK7_3G1GvrxSkytMr9oAPgDvp8pkQoO9Px7CwTCVcbXxVzoTsOwPyMCSR8PqjGY_9VEhjEu_ZwwzWOgxmcIeOK7IDMlte7Opikh1xbMGqhZ1PloH6FDtDsZOK0TNFPq7a2KuaUmobF0FpZvcMBDGRUG2tvfwMVClYHecu9SblO37FB4Nl72VyWdg8SpnM" />
            <div class="absolute inset-0 bg-gradient-to-b from-primary/60 via-primary/40 to-background"></div>
        </div>
        <div class="relative z-10 text-center px-6 max-w-4xl">
            <span
                class="inline-block px-4 py-1 mb-6 rounded-full border border-outline-variant/30 text-white/90 text-sm tracking-[0.2em] uppercase bg-white/10 backdrop-blur-md">
                Eksplorasi Peradaban
            </span>
            <h1 class="font-headline text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-bold text-white tracking-tight leading-tight">
                Mengenal Lebih Dekat Budaya Tanah Malind
            </h1>
            <p class="mt-4 md:mt-6 text-base md:text-xl text-white/80 font-light max-w-2xl mx-auto">
                Menelusuri jejak leluhur di tanah selatan Papua, di mana alam dan tradisi menyatu dalam harmoni yang
                kekal.
            </p>
        </div>
    </header>

    <main class="relative z-20 -mt-16 md:-mt-20 px-4 md:px-6 pb-16 md:pb-24">
        {{-- Introduction Section --}}
        <section
            class="max-w-4xl mx-auto bg-surface-container-lowest p-6 sm:p-10 md:p-20 rounded-xl shadow-sm relative overflow-hidden">
            <div class="cultural-pattern absolute inset-0 pointer-events-none"></div>
            <article class="relative space-y-12">
                <div class="space-y-6">
                    <p class="drop-cap text-base md:text-lg leading-relaxed text-on-surface-variant">
                        Masyarakat Malind Anim, yang mendiami wilayah selatan Papua, khususnya di sekitar Merauke,
                        memiliki kekayaan budaya yang sangat mendalam dan terikat erat dengan lingkungan alamnya.
                        Sebagai "Anak Alam," filosofi hidup suku Malind berpusat pada keseimbangan antara manusia, roh
                        leluhur, dan tanah tempat mereka berpijak. Keberadaan mereka bukan sekadar menetap, melainkan
                        menjaga titipan para dewa.
                    </p>
                    <p class="text-lg leading-relaxed text-on-surface-variant">
                        Budaya ini bukan sekadar peninggalan statis, melainkan sebuah "Living Archive" yang terus
                        bernapas melalui ritual, bahasa, dan struktur sosial. Dari upacara inisiasi hingga pembagian
                        klan yang berdasarkan totem hewan, setiap aspek kehidupan Malind adalah manifestasi dari
                        penghormatan terhadap semesta.
                    </p>
                </div>
                {{-- Asymmetric Image Layout --}}
                <div class="grid grid-cols-12 gap-6 items-center">
                    <div class="col-span-12 md:col-span-7 rounded-xl overflow-hidden shadow-xl transform -rotate-1">
                        <img class="w-full h-48 sm:h-64 md:h-80 object-cover"
                            data-alt="detailed close-up of traditional Papua wood carving with intricate spiral patterns and tribal motifs on dark aged wood"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDiiUV_E9tjAekSbWvu-pwvV1X5LpEyG6Pm7_c30Ekl4u5yNRcTRnJ5ulQqi8egEKbvZp1y8Bcy-c6VwLUoUK1fOAh1L3YaYguPwmg1KVumXUnncrRhr5fggvE2ZqRDAipsmEUvVkwvZ5Kr-jS4BJK-JJlfkZp4_J2mw5tqA0Kjv1YylFDQQ5Bf3bqbm7rqZUMTg3cQi7q3ysCHp2MyBiHBtS0Geqn5atMQzRoZxRtUpxzpR1JQ7h_UkQKLvHD1Lx1GsleZiv68bjs" />
                    </div>
                    <div
                        class="col-span-12 md:col-span-5 bg-secondary-container/20 p-5 md:p-8 rounded-xl mt-4 md:mt-6 md:-ml-12 relative z-10 backdrop-blur-sm border border-secondary/10">
                        <h3 class="font-headline text-2xl font-bold text-primary mb-4">Filosofi Ukiran</h3>
                        <p class="text-on-surface-variant text-sm leading-relaxed">
                            Setiap torehan pada kayu bukan sekadar hiasan. Ia adalah bahasa visual yang menceritakan
                            asal-usul klan, keberanian prajurit, dan penghormatan pada roh-roh pelindung hutan.
                        </p>
                    </div>
                </div>
                {{-- Section: Carvings and Traditions --}}
                <div class="pt-12 space-y-8">
                    <div class="flex items-center space-x-4">
                        <div class="h-px flex-1 bg-gradient-to-r from-transparent via-secondary/40 to-transparent">
                        </div>
                        <span class="material-symbols-outlined text-secondary"
                            style="font-variation-settings: 'FILL' 1;">eco</span>
                        <div class="h-px flex-1 bg-gradient-to-r from-transparent via-secondary/40 to-transparent">
                        </div>
                    </div>
                    <h2 class="font-headline text-2xl md:text-3xl font-bold text-center text-primary">Seni Ukir &amp; Tradisi Lisan
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 pt-6 md:pt-8">
                        <div class="space-y-4">
                            <h4 class="font-headline text-xl text-secondary flex items-center gap-2">
                                <span class="material-symbols-outlined">auto_stories</span>
                                Mitologi Dema
                            </h4>
                            <p class="text-on-surface-variant leading-relaxed">
                                Dema adalah sosok-sosok leluhur mitis yang diyakini menciptakan dunia dan segala isinya.
                                Dalam tradisi Malind, representasi Dema sering ditemukan dalam tiang-tiang rumah adat
                                dan perlengkapan ritual, melambangkan kehadiran yang abadi di tengah masyarakat.
                            </p>
                        </div>
                        <div class="space-y-4">
                            <h4 class="font-headline text-xl text-secondary flex items-center gap-2">
                                <span class="material-symbols-outlined">palette</span>
                                Warna Alami
                            </h4>
                            <p class="text-on-surface-variant leading-relaxed">
                                Penggunaan warna tanah—merah dari oker, putih dari kapur sirih, dan hitam dari
                                arang—mencerminkan hubungan simbiosis dengan bumi. Warna-warna ini tidak hanya menghias,
                                tetapi mensucikan benda-benda budaya yang digunakan.
                            </p>
                        </div>
                    </div>
                </div>
            </article>
        </section>

        {{-- Bento Grid Highlights --}}
        <section class="max-w-7xl mx-auto mt-12 md:mt-24">
            <h3 class="font-headline text-2xl md:text-4xl text-center mb-8 md:mb-16 text-primary">Pilar Kehidupan Malind</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 auto-rows-[200px] md:auto-rows-[250px]">
                <div
                    class="sm:col-span-2 md:col-span-2 md:row-span-2 bg-primary-container rounded-xl p-6 md:p-8 flex flex-col justify-end relative overflow-hidden group">
                    <img class="absolute inset-0 w-full h-full object-cover opacity-50 group-hover:scale-110 transition-transform duration-700"
                        data-alt="atmospheric photo of traditional Papua tribal elders in ceremonial attire sitting by a fire at night"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuC8ACLVhWvAA_XSa7s5qzfsjXY7UxiP5fqrg0bOhKJvvbcNRjSohEj4bc4tdKL1Kwgw76dRMZJc-RIBwmUU164A37c4UoOdkSoYA3zT9x1GtYsg5pGPKoz_tNqp4UM5XKIyTf8Y4xCQGDTcsYws86i_ZXJR2HYDDdxRdhAloMs1MomDxDfvh66aP4Y4yKU85JeQ7vwBUHum-sbSJ9KCMft35wGssWJXhr4zMfDr3f_f3m3ZQfgx1K9f1bTDiCynxAXAZ2Z8j8PYPgc" />
                    <div class="relative z-10">
                        <h4 class="text-white font-headline text-2xl md:text-3xl mb-2">Sistem Klan</h4>
                        <p class="text-white/70">Pembagian masyarakat berdasarkan totem pelindung dari alam semesta.</p>
                    </div>
                </div>
                <div
                    class="bg-surface-container-highest rounded-xl p-6 flex flex-col justify-between border border-outline-variant/10">
                    <span class="material-symbols-outlined text-secondary text-4xl">water_drop</span>
                    <div>
                        <h4 class="font-bold text-primary">Penjaga Air</h4>
                        <p class="text-xs text-on-surface-variant mt-1">Penghormatan terhadap sungai dan rawa sebagai
                            sumber kehidupan.</p>
                    </div>
                </div>
                <div
                    class="bg-surface-container-highest rounded-xl p-6 flex flex-col justify-between border border-outline-variant/10">
                    <span class="material-symbols-outlined text-secondary text-4xl">forest</span>
                    <div>
                        <h4 class="font-bold text-primary">Rimba Suci</h4>
                        <p class="text-xs text-on-surface-variant mt-1">Area terlarang yang dijaga untuk keberlangsungan
                            ekosistem.</p>
                    </div>
                </div>
                <div
                    class="sm:col-span-2 md:col-span-2 bg-secondary rounded-xl p-6 md:p-8 flex items-center justify-between group overflow-hidden">
                    <div class="relative z-10 text-white">
                        <h4 class="font-headline text-2xl">Festival Budaya</h4>
                        <p class="text-white/80 text-sm mt-1">Perayaan tahunan syukur hasil bumi.</p>
                    </div>
                    <span
                        class="material-symbols-outlined text-white text-6xl opacity-30 transform group-hover:rotate-12 transition-transform">celebration</span>
                </div>
            </div>
        </section>

        {{-- CTA Section --}}
        <section
            class="max-w-4xl mx-auto mt-12 md:mt-24 text-center bg-primary text-white p-8 md:p-16 rounded-xl relative overflow-hidden">
            <div
                class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/natural-paper.png')]">
            </div>
            <h2 class="font-headline text-2xl md:text-3xl mb-4 md:mb-6 relative z-10">Mari Menjaga Warisan Ini Bersama</h2>
            <p class="text-white/70 text-sm md:text-base mb-6 md:mb-10 max-w-xl mx-auto relative z-10">Digitalisasi hanyalah langkah awal.
                Partisipasi Anda dalam melaporkan dan mendokumentasikan situs warisan sangat berarti.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4 relative z-10">
                <a href="{{ route('landing.daftar-warisan') }}"
                    class="px-8 py-4 bg-secondary text-on-secondary rounded-full font-semibold hover:bg-secondary-container transition-colors shadow-lg">
                    Daftar Warisan
                </a>
                <a href="{{ route('landing.lapor-situs') }}"
                    class="px-8 py-4 border border-white/30 rounded-full font-semibold hover:bg-white/10 transition-colors backdrop-blur-sm">
                    Lapor Situs Baru
                </a>
            </div>
        </section>
    </main>
</x-layouts::landing>
