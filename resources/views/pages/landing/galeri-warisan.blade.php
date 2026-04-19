<x-layouts::landing :title="__('Galeri Warisan')">
    <main class="pt-24 md:pt-32 pb-16 md:pb-24 px-4 md:px-6 lg:px-12 max-w-7xl mx-auto">
        {{-- Header Section --}}
        <header class="mb-8 md:mb-16 max-w-3xl">
            <span class="font-label text-xs uppercase tracking-[0.2em] text-secondary font-semibold mb-4 block">Arsip
                Visual</span>
            <h1 class="font-headline text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-primary tracking-tighter leading-tight mb-4 md:mb-6">
                Galeri Warisan Tanah Malind</h1>
            <p class="text-base md:text-lg text-on-surface-variant leading-relaxed opacity-80">Menelusuri jejak peradaban melalui
                fragmen visual. Setiap gambar menceritakan filosofi mendalam, ritme alam, dan identitas luhur masyarakat
                Malind.</p>
        </header>

        {{-- Filter Chips --}}
        <div class="flex flex-wrap gap-2 md:gap-3 mb-8 md:mb-12">
            <button class="px-6 py-2.5 bg-primary text-on-primary rounded-full text-sm font-medium transition-all">Semua
                Foto</button>
            <button
                class="px-6 py-2.5 bg-surface-container-high text-on-surface hover:bg-surface-variant rounded-full text-sm font-medium transition-all">Artefak</button>
            <button
                class="px-6 py-2.5 bg-surface-container-high text-on-surface hover:bg-surface-variant rounded-full text-sm font-medium transition-all">Tarian
                Adat</button>
            <button
                class="px-6 py-2.5 bg-surface-container-high text-on-surface hover:bg-surface-variant rounded-full text-sm font-medium transition-all">Situs
                Sejarah</button>
            <button
                class="px-6 py-2.5 bg-surface-container-high text-on-surface hover:bg-surface-variant rounded-full text-sm font-medium transition-all">Upacara
                Ritual</button>
        </div>

        {{-- Masonry Gallery --}}
        <div class="gallery-masonry">
            {{-- Item 1: Large Artifact --}}
            <div class="gallery-item group relative overflow-hidden rounded-xl bg-surface-container-highest">
                <img alt="Ukiran kayu tradisional Malind"
                    class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110"
                    data-alt="close-up of intricate traditional wood carvings on a dark mahogany surface with dramatic museum-style spotlighting"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuA8TPqERWP3rzwdlzBjreLdyR_phRvRhO6cHEtSwVz5MbXsqGCzoqEK5CfkUtInts58fvxP5qZF9Q87AyM9IhoEhlnFhE_jfqHKcXmWghP44aCHOkNNcNyajrrQPKAbMBrEg7NkSTOunt_e6l2e8D5JhUwl4wFWLjo_7qYI9xaryaOW4fiNfgTLoTExSo4-yMJQA2LJNuIK6qB5cztT9e5sj3nlyj9wPaD-mC8H7pI4qvYVzcuYOIxffI5WeqN9rvklXg-5N2vl1dw" />
                <div
                    class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                    <span class="text-secondary font-label text-xs tracking-widest uppercase mb-2">Artefak</span>
                    <h3 class="text-white font-headline text-2xl font-bold">Patung Leluhur Totem</h3>
                    <p class="text-white/70 text-sm mt-2 font-light">Simbol perlindungan dan koneksi spiritual antar
                        generasi.</p>
                </div>
            </div>

            {{-- Item 2: Vertical Dance --}}
            <div class="gallery-item group relative overflow-hidden rounded-xl bg-surface-container-highest">
                <img alt="Tarian adat Malind"
                    class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110"
                    data-alt="dynamic action shot of indigenous dancers in traditional feathered regalia performing under golden sunset light in a forest clearing"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDBZ4uiTdKitX2nBE9pj1-VltxmFoKhKDLvi34XZHJ6itDXL2dEdwJinMOODz-7FckoUaLlpYkY4N-JrJQy0Ov32Vj0tCMXG-gjg6AUB1jGEalcENmG7cMHagJGD99j7ipUD9Vm873aT7w1q2yg72GP_gMTGSOYjeOKdnaq-JF4O0BtM9ND1_AOG7fYi2D3k-P_s6ByKLeohnj0ifFtu_IR-4MI0ZzrngObe6OUI9RvZWZ5uhXvWvV3pngJwmtv-1OPW5G6QM5S3GM" />
                <div
                    class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                    <span class="text-secondary font-label text-xs tracking-widest uppercase mb-2">Tarian Adat</span>
                    <h3 class="text-white font-headline text-2xl font-bold">Tari Gats</h3>
                    <p class="text-white/70 text-sm mt-2 font-light">Gerakan yang merefleksikan harmoni antara manusia
                        dan alam semesta.</p>
                </div>
            </div>

            {{-- Item 3: Wide Historical Site --}}
            <div class="gallery-item group relative overflow-hidden rounded-xl bg-surface-container-highest">
                <img alt="Situs kuno di tengah hutan"
                    class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110"
                    data-alt="ancient stone monolithic structures partially covered in moss located deep within a misty tropical rainforest at dawn"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuA0tv25A0hE4phwjfHv-V13un0AzEQdnrVq1jc3amsccmqlS_hvWgrS2AmJvvlkhRbI2kv23Ar2PKtRXri8JFKyoDtdPcGaNzYeixmikgTc9jggtfbUWIdC-uXKnPjQ6Zz_u5pHFIDARErP73sWDxc2tmMDdXxNG08DVNxkycvsIawX5c-FVlhFjs97i0gGiAHvaqyTW8e6zyA6GUeEn9gbwdB15JNOaX8vKXKHICenthzzypvKNNf1FrAXQwBNOm_J3bWS7-UO6Ws" />
                <div
                    class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                    <span class="text-secondary font-label text-xs tracking-widest uppercase mb-2">Situs Sejarah</span>
                    <h3 class="text-white font-headline text-2xl font-bold">Situs Megalitik Malind</h3>
                    <p class="text-white/70 text-sm mt-2 font-light">Peninggalan era prasejarah yang masih terjaga
                        keasliannya.</p>
                </div>
            </div>

            {{-- Item 4: Close up Jewelry --}}
            <div class="gallery-item group relative overflow-hidden rounded-xl bg-surface-container-highest">
                <img alt="Perhiasan tradisional"
                    class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110"
                    data-alt="macro photo of handcrafted tribal jewelry made from shells and dark beads resting on a rustic woven textile background"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAKk4nw56TR5ARStOgidIEOW1RCqYzgNBHxw4B6AiaCH-tq8Sz_O7QkuGjpjq5SXKUo_KhKAA1IgQ13I2kT9XuZVHf3lmtAePLP53PqNOl1V_Nz__nFxtRvsHv_3dZFyAZTmW_YsHcvvWU0pmM24xZM_cF8CaVke7GpI34zxfybKhGs7hFgw49xKr1c0plBiZgmCPJHI9ZWoLNjbXdAYOQEEQ6hqDG-UfEt2-JqSR7MT-ZT20AdYCzodfsO9fqtMfMgqDpDbuszM5E" />
                <div
                    class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                    <span class="text-secondary font-label text-xs tracking-widest uppercase mb-2">Artefak</span>
                    <h3 class="text-white font-headline text-2xl font-bold">Kalung Cangkang Suci</h3>
                    <p class="text-white/70 text-sm mt-2 font-light">Aksesori ritual yang melambangkan kemurnian dan
                        status sosial.</p>
                </div>
            </div>

            {{-- Item 5: Ritual Fire --}}
            <div class="gallery-item group relative overflow-hidden rounded-xl bg-surface-container-highest">
                <img alt="Upacara ritual api"
                    class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110"
                    data-alt="mystical night scene showing a ritual fire with embers flying in the air, silhouetted figures standing around in a circle"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBQYJklyawAQpxvHvYc5viglqZPWeEx49u6UMb_DqPNgjxlG1Ctld8Vh2AWKqen7-yimRd90X-_24_dPAdUIiAYI7Pg6VZEMDUgMydd9Rmod72JKSWzsGv1um12MNPr_8qLldLNlyiXSXNMk11YEfGAp8wEA4T6394KUUYjJC7Z0XclZLMdWNhK_4TCTAQOTSADu_dnH0sxfqMfRoh4_0clLifGQ3nKNi4oiyaxRaW-Q_VGJ3M7qPbpAJ70-AwsIHAii6jevbf2JQI" />
                <div
                    class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                    <span class="text-secondary font-label text-xs tracking-widest uppercase mb-2">Upacara Ritual</span>
                    <h3 class="text-white font-headline text-2xl font-bold">Ritual Malam Bulan Purnama</h3>
                    <p class="text-white/70 text-sm mt-2 font-light">Penghormatan kepada roh penjaga hutan dan sumber
                        air.</p>
                </div>
            </div>

            {{-- Item 6: House Structure --}}
            <div class="gallery-item group relative overflow-hidden rounded-xl bg-surface-container-highest">
                <img alt="Arsitektur rumah adat"
                    class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110"
                    data-alt="traditional stilt house with high thatched roof made from organic materials, surrounded by lush tropical vegetation in soft morning light"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBPP0GyyUn4RdvQZ4Zhp0z_iK_8_qq9QVdZ4HKyS9TH9H56qWeATp2EzcQaCFAJ_qyrrdhHHh4yBr7I_YZf12zR0xrGgueYrn9XxXWowS6w--WHVkSvqMpRn0eCuSlxyYJ9xj6MTBNdHY8M2NozJH-QXo_zHoHr6_7_NQaQsBUYAFbH4y8u52x1WYaRh4nEpTAEwON7rDtF8_Ck18Y649YGtZSKbWAazSlPS4Sk8AuhPtzXFAdi9Zj619Dc338VVwPbCdEFU_ck2mw" />
                <div
                    class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-8">
                    <span class="text-secondary font-label text-xs tracking-widest uppercase mb-2">Situs Sejarah</span>
                    <h3 class="text-white font-headline text-2xl font-bold">Rumah Khas Malind</h3>
                    <p class="text-white/70 text-sm mt-2 font-light">Arsitektur berkelanjutan yang mengadaptasi iklim
                        tropis lembab.</p>
                </div>
            </div>
        </div>

        {{-- Load More Section --}}
        <div class="mt-16 flex justify-center">
            <button
                class="px-10 py-4 bg-surface-container-highest text-primary font-semibold rounded-xl border border-outline-variant/20 hover:bg-primary hover:text-on-primary transition-all duration-300">
                Muat Lebih Banyak Karya
            </button>
        </div>
    </main>
</x-layouts::landing>
