<x-layouts::landing :title="__('Daftar Warisan')">
    <main class="pt-24 md:pt-32 pb-16 md:pb-24 px-4 md:px-6 lg:px-12 max-w-7xl mx-auto">
        {{-- Header Section --}}
        <header class="mb-8 md:mb-16">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 md:gap-8">
                <div class="max-w-2xl">
                    <span class="text-secondary font-semibold tracking-[0.2em] uppercase text-xs mb-4 block">Eksplorasi
                        Budaya</span>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-headline font-bold text-primary tracking-tight leading-tight">
                        Katalog Warisan Budaya</h1>
                    <p class="mt-4 md:mt-6 text-base md:text-lg text-on-surface-variant leading-relaxed max-w-xl">
                        Menelusuri jejak peradaban Tanah Malind melalui dokumentasi digital situs prasejarah, artefak
                        sakral, dan tradisi lisan yang hidup.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                    {{-- Search Input --}}
                    <div class="relative group flex-1 sm:w-64">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-secondary transition-colors"
                            data-icon="search">search</span>
                        <input
                            class="w-full pl-12 pr-4 py-3.5 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-secondary/20 focus:bg-surface-container-lowest transition-all placeholder:text-outline-variant"
                            placeholder="Cari situs..." type="text" />
                    </div>
                    {{-- Sort Dropdown --}}
                    <div class="relative flex-none">
                        <select
                            class="appearance-none w-full sm:w-48 px-6 py-3.5 bg-surface-container-highest rounded-xl border-none focus:ring-2 focus:ring-secondary/20 cursor-pointer font-medium text-primary pr-12">
                            <option>Terbaru</option>
                            <option>Populer</option>
                            <option>Alfabetis</option>
                            <option>Lokasi Terdekat</option>
                        </select>
                        <span
                            class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-primary"
                            data-icon="expand_more">expand_more</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- Heritage Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
            {{-- Card 1 --}}
            <article
                class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col">
                <div class="aspect-[4/3] overflow-hidden relative">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="Detail of intricate traditional Malind wood carving with earthy pigments and tribal motifs under soft museum lighting"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBuT1iZ27SJFj3WIfCLGjLQ3YA-keDLC0cTQ-CjAKV4fX5VNwL6RMib6cLIf7d1_jdRmIqDDqjG3GV9-2ajI9NS_XxwJLAB2JQ08JzO3u6sJpNq-Ihke5-ndpy7-DKfx6BDEjNWTIDCPXlhQebs5pPkAMhmver3RSA6oxz6YSBdYYDLYgbsQUiWL_KyQTRhHZXMq_QIKWhTyyuteg_ahQA9AZF1LDQ6JlSwUOyeAERR_p8wdH1kryz5cWzHAi9Itgln6gTcb0Q2ka4" />
                    <div class="absolute top-4 left-4">
                        <span
                            class="px-4 py-1.5 bg-tertiary text-white text-xs font-bold rounded-full tracking-wider uppercase">Situs
                            Sakral</span>
                    </div>
                </div>
                <div class="p-8 flex-1 flex flex-col">
                    <h3
                        class="text-2xl font-headline font-bold text-primary group-hover:text-secondary transition-colors">
                        Tugu Peringatan Ndun</h3>
                    <p class="mt-4 text-on-surface-variant line-clamp-3 leading-relaxed">
                        Simbol ketahanan dan spiritualitas masyarakat pesisir, Ndun merupakan monumen kayu ulin yang
                        diukir dengan narasi leluhur ribuan tahun silam.
                    </p>
                    <div class="mt-auto pt-8 flex items-center justify-between">
                        <a class="text-primary font-bold text-sm inline-flex items-center gap-2 group/link" href="#">
                            Pelajari Lebih Lanjut
                            <span
                                class="material-symbols-outlined text-sm transition-transform group-hover/link:translate-x-2"
                                data-icon="arrow_forward">arrow_forward</span>
                        </a>
                        <span class="text-[10px] text-outline font-medium tracking-widest uppercase">Merauke</span>
                    </div>
                </div>
            </article>

            {{-- Card 2 --}}
            <article
                class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col">
                <div class="aspect-[4/3] overflow-hidden relative">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="Ancient rock art site in a lush tropical jungle cave with dramatic shadows and sunbeams hitting the walls"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDly0jbkN2KbqyEXVIdZeBTbWDy5XK3Wlkxk65wwmkYpTAr-tpOHd0TmUBTm0jhkQmoXnkcRfXDhdFEAQPeLoBRjY9rLu9rEVARZ5WwE7sJgA0hbArB5jYJQ5nknl0AU-hhQvGwqDb5Y7Eosj2xeLSX_FCikdW9uCR8efioScbH_20IwCNLcH79rUFoU5aGvLvcuWGPl_MbBsDfcVgIkbbyPbF4C_VY8KYGRsSJjBUBo56rowWQ6ajxB-gCdbG3mSmYG8yBMXOs9Qs" />
                    <div class="absolute top-4 left-4">
                        <span
                            class="px-4 py-1.5 bg-tertiary text-white text-xs font-bold rounded-full tracking-wider uppercase">Artefak</span>
                    </div>
                </div>
                <div class="p-8 flex-1 flex flex-col">
                    <h3
                        class="text-2xl font-headline font-bold text-primary group-hover:text-secondary transition-colors">
                        Batu Ukir Sangas</h3>
                    <p class="mt-4 text-on-surface-variant line-clamp-3 leading-relaxed">
                        Formasi geologi alami yang dihiasi dengan piktogram merah tanah, menggambarkan rasi bintang yang
                        digunakan nelayan Malind untuk navigasi.
                    </p>
                    <div class="mt-auto pt-8 flex items-center justify-between">
                        <a class="text-primary font-bold text-sm inline-flex items-center gap-2 group/link" href="#">
                            Pelajari Lebih Lanjut
                            <span
                                class="material-symbols-outlined text-sm transition-transform group-hover/link:translate-x-2"
                                data-icon="arrow_forward">arrow_forward</span>
                        </a>
                        <span class="text-[10px] text-outline font-medium tracking-widest uppercase">Kimaam</span>
                    </div>
                </div>
            </article>

            {{-- Card 3 --}}
            <article
                class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col">
                <div class="aspect-[4/3] overflow-hidden relative">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="Panoramic view of a traditional village at dusk with thatched roofs and smoke rising against a golden sky"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBqwDvOKwfGSgbhMp_k0bXUNSQjqcQpUhnHjtOOsxiQqUfcQDx0H7uYruixdouxFt5wzT-6pNQlnBppXbNds1pwpbKIkPVi9bC1YKusC0vHfnhZhWaPjszx06HDajiAXCQcT867-zhm9kJgPPKOhlfuBxzZNxHC_6LtbIWThpzNQN0JEtLddHLsYe5l-TPYnX7d0H8wHAO3TXRvDifHTxYXo22JFc9jSsAOZ_Xc51r5sDfmxjC7Iw4VT5m3uwLr5fpaxS1-_SVyc4Q" />
                    <div class="absolute top-4 left-4">
                        <span
                            class="px-4 py-1.5 bg-tertiary text-white text-xs font-bold rounded-full tracking-wider uppercase">Tradisi</span>
                    </div>
                </div>
                <div class="p-8 flex-1 flex flex-col">
                    <h3
                        class="text-2xl font-headline font-bold text-primary group-hover:text-secondary transition-colors">
                        Balai Adat Mbe</h3>
                    <p class="mt-4 text-on-surface-variant line-clamp-3 leading-relaxed">
                        Pusat musyawarah adat yang telah berdiri selama lima generasi. Arsitekturnya mencerminkan
                        struktur sosial klan Anim Ha.
                    </p>
                    <div class="mt-auto pt-8 flex items-center justify-between">
                        <a class="text-primary font-bold text-sm inline-flex items-center gap-2 group/link" href="#">
                            Pelajari Lebih Lanjut
                            <span
                                class="material-symbols-outlined text-sm transition-transform group-hover/link:translate-x-2"
                                data-icon="arrow_forward">arrow_forward</span>
                        </a>
                        <span class="text-[10px] text-outline font-medium tracking-widest uppercase">Okaba</span>
                    </div>
                </div>
            </article>

            {{-- Card 4 --}}
            <article
                class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col">
                <div class="aspect-[4/3] overflow-hidden relative">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="Macro shot of a woven ceremonial headpiece with vibrant bird feathers and shells, shallow depth of field"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAIe3If60CbOCRGXX3qG6i1UNTs1NcC6Oi572Eb2cJsD3aHhXWtUEWL62WYtv1VKDxjchLmfWsJrbI4tTwE7hUZLHoM22esZ0-1mT_JpyrruTBcpz1Q0x-MbbhM3VbP7I13U29dFR5v3mnRdOlbi7bGqiX9ORjtLja3qnPesku463OR-iZQKqeXN9oucym9fuCuA_uurPrSaUpszoGUxV0_FM6DZ40u_Pq0CRvPuFdckOHHtBCZu_Ra-z8NNQRtJOOVUzgNPVXCzX4" />
                    <div class="absolute top-4 left-4">
                        <span
                            class="px-4 py-1.5 bg-tertiary text-white text-xs font-bold rounded-full tracking-wider uppercase">Kriya</span>
                    </div>
                </div>
                <div class="p-8 flex-1 flex flex-col">
                    <h3
                        class="text-2xl font-headline font-bold text-primary group-hover:text-secondary transition-colors">
                        Tenun Serat Kayu</h3>
                    <p class="mt-4 text-on-surface-variant line-clamp-3 leading-relaxed">
                        Teknik menenun langka menggunakan serat kulit kayu yang dipukul halus, menciptakan tekstur kain
                        yang kokoh namun lembut.
                    </p>
                    <div class="mt-auto pt-8 flex items-center justify-between">
                        <a class="text-primary font-bold text-sm inline-flex items-center gap-2 group/link" href="#">
                            Pelajari Lebih Lanjut
                            <span
                                class="material-symbols-outlined text-sm transition-transform group-hover/link:translate-x-2"
                                data-icon="arrow_forward">arrow_forward</span>
                        </a>
                        <span class="text-[10px] text-outline font-medium tracking-widest uppercase">Muting</span>
                    </div>
                </div>
            </article>

            {{-- Card 5 --}}
            <article
                class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col">
                <div class="aspect-[4/3] overflow-hidden relative">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="Wide landscape of a sacred mountain range in Papua with mist rolling over dense emerald green canopies"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCkRZhgxBDNyV-Wcjk6JaZpCrBRlpieLBaoMmKrAKCy4LT4IgFMZSZ8qLpr0GLWwHHRWA6aMreaNsThZj4Gkgh6Zih2B_3oAlxsmNvuMKkekv6carjjTPzz9Nvtx0YetxfUmRpVJAvbn9EoH8Ra7vMHi4R9RPx8vZU2IWncvxR2ItWIV7Gw9WpaM63C6Lj5oQDOGqMV6B3Z_4Z-4cZpE_MmTNhar8qD5hSqmWT-vYPyl7pyVmKLkwMdsIpdqAmHg-ZzgJjAnU3YQJs" />
                    <div class="absolute top-4 left-4">
                        <span
                            class="px-4 py-1.5 bg-tertiary text-white text-xs font-bold rounded-full tracking-wider uppercase">Alam</span>
                    </div>
                </div>
                <div class="p-8 flex-1 flex flex-col">
                    <h3
                        class="text-2xl font-headline font-bold text-primary group-hover:text-secondary transition-colors">
                        Hutan Larangan Wayu</h3>
                    <p class="mt-4 text-on-surface-variant line-clamp-3 leading-relaxed">
                        Kawasan konservasi berbasis kearifan lokal yang melarang penebangan pohon tertentu, menjaga
                        keseimbangan ekosistem dan sumber air.
                    </p>
                    <div class="mt-auto pt-8 flex items-center justify-between">
                        <a class="text-primary font-bold text-sm inline-flex items-center gap-2 group/link" href="#">
                            Pelajari Lebih Lanjut
                            <span
                                class="material-symbols-outlined text-sm transition-transform group-hover/link:translate-x-2"
                                data-icon="arrow_forward">arrow_forward</span>
                        </a>
                        <span class="text-[10px] text-outline font-medium tracking-widest uppercase">Ilwayab</span>
                    </div>
                </div>
            </article>

            {{-- Card 6 --}}
            <article
                class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col">
                <div class="aspect-[4/3] overflow-hidden relative">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        data-alt="Vintage photograph aesthetics showing tribal elders sharing stories around a small fire, warm grainy texture"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBfVnmt2KinwZWLvIVasSlV1VdZdYFBd2FSHmuvrvZpWdjql8c3vGVHlpYyM0-eE3MTxgTqFh0qSaDv71DLDh9uEDZ9ZoUlN4ktzjv7BZyZqH2CCTvDf_9wCZ_dTCFlHvnFolSFQRQf4RKJjCR9pD8FSiFFw-gidYyQWna72CLcSARmOr3tzYkTbcZxTEKt8OCrYt6li6KZV0SzOia_v6_iEM3uh4eNZfjtseCnESYGz7ykN63CKCQgfun-ulUByWi9-7T7n9EAenc" />
                    <div class="absolute top-4 left-4">
                        <span
                            class="px-4 py-1.5 bg-tertiary text-white text-xs font-bold rounded-full tracking-wider uppercase">Lisan</span>
                    </div>
                </div>
                <div class="p-8 flex-1 flex flex-col">
                    <h3
                        class="text-2xl font-headline font-bold text-primary group-hover:text-secondary transition-colors">
                        Nyanyian Gada</h3>
                    <p class="mt-4 text-on-surface-variant line-clamp-3 leading-relaxed">
                        Kumpulan mantra dan syair puitis yang dinyanyikan selama masa panen, berisi ucapan syukur dan
                        doa keselamatan bagi tanah.
                    </p>
                    <div class="mt-auto pt-8 flex items-center justify-between">
                        <a class="text-primary font-bold text-sm inline-flex items-center gap-2 group/link" href="#">
                            Pelajari Lebih Lanjut
                            <span
                                class="material-symbols-outlined text-sm transition-transform group-hover/link:translate-x-2"
                                data-icon="arrow_forward">arrow_forward</span>
                        </a>
                        <span class="text-[10px] text-outline font-medium tracking-widest uppercase">Merauke</span>
                    </div>
                </div>
            </article>
        </div>

        {{-- Pagination --}}
        <div class="mt-20 flex justify-center items-center gap-2">
            <button
                class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-high text-primary hover:bg-secondary-container transition-colors">
                <span class="material-symbols-outlined" data-icon="chevron_left">chevron_left</span>
            </button>
            <button
                class="w-12 h-12 flex items-center justify-center rounded-full bg-primary text-white font-bold">1</button>
            <button
                class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-high text-primary hover:bg-secondary-container transition-colors">2</button>
            <button
                class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-high text-primary hover:bg-secondary-container transition-colors">3</button>
            <span class="mx-2 text-outline">...</span>
            <button
                class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-high text-primary hover:bg-secondary-container transition-colors">12</button>
            <button
                class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-high text-primary hover:bg-secondary-container transition-colors">
                <span class="material-symbols-outlined" data-icon="chevron_right">chevron_right</span>
            </button>
        </div>
    </main>
</x-layouts::landing>
