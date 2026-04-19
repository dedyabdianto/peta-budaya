<x-layouts::landing :title="__('Lapor Situs')">
    {{-- Hero Section / Header --}}
    <header class="relative pt-24 md:pt-32 pb-10 md:pb-16 px-4 md:px-6 overflow-hidden">
        <div class="max-w-4xl mx-auto text-center relative z-10">
            <span
                class="font-label text-xs tracking-[0.2em] uppercase text-secondary font-semibold mb-4 block">Partisipasi
                Masyarakat</span>
            <h1 class="font-headline text-3xl sm:text-4xl md:text-6xl text-primary font-bold tracking-tight mb-4 md:mb-6">Jaga Jejak
                Peradaban Tanah Malind</h1>
            <p class="text-on-surface-variant text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
                Setiap temuan Anda adalah bagian dari puzzle sejarah yang belum terpecahkan. Bantu kami
                mendokumentasikan dan melindungi situs budaya Merauke.
            </p>
        </div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full pointer-events-none opacity-5">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/natural-paper.png')]">
            </div>
        </div>
    </header>

    {{-- Main Content: Reporting Form --}}
    <main class="max-w-4xl mx-auto px-4 md:px-6 pb-16 md:pb-24">
        <div class="bg-surface-container-low rounded-xl p-5 sm:p-8 md:p-12 relative">
            <form action="#" class="space-y-10">
                {{-- Section 1: Identitas Pelapor --}}
                <section class="space-y-6">
                    <div class="flex items-center gap-3">
                        <span
                            class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-sm">01</span>
                        <h2 class="font-headline text-xl text-primary font-bold">Identitas Pelapor</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="font-label text-sm font-semibold tracking-wide text-on-surface-variant"
                                for="nama_pelapor">NAMA PELAPOR</label>
                            <input
                                class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-4 focus:ring-2 focus:ring-secondary/20 transition-all outline-none text-on-surface"
                                id="nama_pelapor" placeholder="Masukkan nama lengkap" type="text" />
                        </div>
                        <div class="space-y-2">
                            <label class="font-label text-sm font-semibold tracking-wide text-on-surface-variant"
                                for="kontak">NOMOR TELEPON / WA</label>
                            <input
                                class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-4 focus:ring-2 focus:ring-secondary/20 transition-all outline-none text-on-surface"
                                id="kontak" placeholder="0812-xxxx-xxxx" type="text" />
                        </div>
                    </div>
                </section>

                {{-- Section 2: Detail Situs --}}
                <section class="space-y-6">
                    <div class="flex items-center gap-3">
                        <span
                            class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-sm">02</span>
                        <h2 class="font-headline text-xl text-primary font-bold">Detail Situs / Benda</h2>
                    </div>
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="font-label text-sm font-semibold tracking-wide text-on-surface-variant"
                                for="nama_situs">NAMA SITUS / JENIS BENDA</label>
                            <input
                                class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-4 focus:ring-2 focus:ring-secondary/20 transition-all outline-none text-on-surface"
                                id="nama_situs" placeholder="Contoh: Menhir Kayu Malind atau Situs Peninggalan"
                                type="text" />
                        </div>
                        <div class="space-y-2">
                            <label
                                class="font-label text-sm font-semibold tracking-wide text-on-surface-variant">PERKIRAAN
                                LOKASI</label>
                            <div class="flex flex-col md:flex-row gap-4">
                                <input
                                    class="flex-grow bg-surface-container-highest border-none rounded-xl px-4 py-4 focus:ring-2 focus:ring-secondary/20 transition-all outline-none text-on-surface"
                                    placeholder="Masukkan koordinat atau nama daerah" type="text" />
                                <button
                                    class="flex items-center justify-center gap-2 px-6 py-4 bg-surface-container-highest text-primary font-semibold rounded-xl border border-outline-variant/20 hover:bg-surface-variant transition-colors group"
                                    type="button">
                                    <span
                                        class="material-symbols-outlined text-lg group-hover:scale-110 transition-transform">location_on</span>
                                    Pin di Peta
                                </button>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="font-label text-sm font-semibold tracking-wide text-on-surface-variant"
                                for="deskripsi">DESKRIPSI SINGKAT TEMUAN</label>
                            <textarea
                                class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-4 focus:ring-2 focus:ring-secondary/20 transition-all outline-none text-on-surface resize-none"
                                id="deskripsi"
                                placeholder="Ceritakan kondisi, ukuran, atau sejarah lisan yang Anda ketahui tentang temuan ini..."
                                rows="4"></textarea>
                        </div>
                    </div>
                </section>

                {{-- Section 3: Dokumentasi --}}
                <section class="space-y-6">
                    <div class="flex items-center gap-3">
                        <span
                            class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-sm">03</span>
                        <h2 class="font-headline text-xl text-primary font-bold">Dokumentasi Visual</h2>
                    </div>
                    <div class="relative group">
                        <div
                            class="border-2 border-dashed border-outline-variant rounded-xl p-10 flex flex-col items-center justify-center gap-4 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-all cursor-pointer">
                            <div
                                class="w-16 h-16 rounded-full bg-secondary-container/20 flex items-center justify-center text-secondary">
                                <span class="material-symbols-outlined text-3xl">add_a_photo</span>
                            </div>
                            <div class="text-center">
                                <p class="text-on-surface font-semibold">Tarik dan lepaskan foto di sini</p>
                                <p class="text-on-surface-variant text-sm mt-1">Format JPG, PNG (Maks. 5MB per file)</p>
                            </div>
                            <button
                                class="mt-2 text-secondary font-bold text-sm uppercase tracking-widest hover:underline"
                                type="button">PILIH FILE</button>
                        </div>
                        <input class="absolute inset-0 opacity-0 cursor-pointer" type="file" />
                    </div>
                </section>

                {{-- Footer Action --}}
                <div class="pt-6 flex flex-col items-center gap-6">
                    <p class="text-center text-on-surface-variant text-sm italic">
                        Dengan mengirimkan laporan ini, Anda berkontribusi pada pelestarian kebudayaan Papua. Tim kami
                        akan melakukan verifikasi lapangan segera.
                    </p>
                    <button
                        class="w-full md:w-auto px-12 py-5 bg-primary text-on-primary font-semibold text-lg rounded-full hover:bg-primary-container hover:scale-[1.02] active:scale-95 transition-all shadow-xl shadow-primary/10"
                        type="submit">
                        Kirim Laporan Warisan
                    </button>
                </div>
            </form>
        </div>

        {{-- Asymmetric Sidebar Info (Bento Style) --}}
        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div
                class="md:col-span-2 bg-primary-container text-on-primary-container p-8 rounded-xl flex items-center justify-between relative overflow-hidden group">
                <div class="relative z-10">
                    <h3 class="font-headline text-2xl font-bold mb-2">Butuh Bantuan Cepat?</h3>
                    <p class="opacity-80 mb-6">Hubungi petugas lapangan kami via WhatsApp untuk konsultasi temuan
                        mendesak.</p>
                    <a class="inline-flex items-center gap-2 px-6 py-3 bg-secondary-container text-on-secondary-container font-bold rounded-full hover:scale-105 transition-transform"
                        href="#">
                        Hubungi WhatsApp
                    </a>
                </div>
                <div
                    class="absolute -right-10 -bottom-10 opacity-10 scale-150 rotate-12 group-hover:rotate-0 transition-transform duration-700">
                    <span class="material-symbols-outlined text-[200px]" data-weight="fill">temple_buddhist</span>
                </div>
            </div>
            <div class="bg-surface-container-highest p-8 rounded-xl flex flex-col justify-center">
                <div class="text-secondary mb-4">
                    <span class="material-symbols-outlined text-4xl">verified_user</span>
                </div>
                <h3 class="font-bold text-lg mb-2">Privasi Terjamin</h3>
                <p class="text-sm text-on-surface-variant leading-relaxed">Identitas Anda akan kami rahasiakan dan hanya
                    digunakan untuk keperluan verifikasi situs.</p>
            </div>
        </div>
    </main>
</x-layouts::landing>
