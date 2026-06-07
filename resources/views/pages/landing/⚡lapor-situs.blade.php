<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use App\Models\Laporan;
use App\Models\LaporanFoto;
use Illuminate\Support\Facades\Storage;

new
#[Layout('layouts.landing', ['title' => 'Lapor Situs'])]
class extends Component {
    use WithFileUploads;

    public string $nama_pelapor = '';
    public string $kontak = '';
    public string $nama_situs = '';
    public string $lokasi = '';
    public string $latitude = '';
    public string $longitude = '';
    public string $deskripsi = '';
    public array $fotos = [];
    public bool $submitted = false;

    public function submit(): void
    {
        $this->validate([
            'nama_pelapor' => 'required|string|max:255',
            'kontak' => 'nullable|string|max:50',
            'nama_situs' => 'required|string|max:255',
            'lokasi' => 'nullable|string|max:500',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'deskripsi' => 'nullable|string|max:5000',
            'fotos' => 'nullable|array|max:5',
            'fotos.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'nama_pelapor.required' => 'Nama pelapor wajib diisi.',
            'nama_situs.required' => 'Nama situs atau jenis benda wajib diisi.',
            'fotos.max' => 'Maksimal 5 foto.',
            'fotos.*.max' => 'Ukuran foto maksimal 5MB per file.',
            'fotos.*.image' => 'File harus berupa gambar.',
            'fotos.*.mimes' => 'Format foto harus JPG, PNG, atau WebP.',
        ]);

        $laporan = Laporan::create([
            'nama_pelapor' => $this->nama_pelapor,
            'kontak' => $this->kontak ?: null,
            'nama_situs' => $this->nama_situs,
            'lokasi' => $this->lokasi ?: null,
            'latitude' => $this->latitude ?: null,
            'longitude' => $this->longitude ?: null,
            'deskripsi' => $this->deskripsi ?: null,
            'status' => 'menunggu',
        ]);

        foreach ($this->fotos as $foto) {
            $path = $foto->store('laporan', 'public');
            LaporanFoto::create([
                'laporan_id' => $laporan->id,
                'file_path' => $path,
                'file_size' => $foto->getSize(),
            ]);
        }

        $this->reset(['nama_pelapor', 'kontak', 'nama_situs', 'lokasi', 'latitude', 'longitude', 'deskripsi', 'fotos']);
        $this->submitted = true;
    }

    public function resetForm(): void
    {
        $this->submitted = false;
        $this->reset(['nama_pelapor', 'kontak', 'nama_situs', 'lokasi', 'latitude', 'longitude', 'deskripsi', 'fotos']);
        $this->resetValidation();
    }
};
?>

<div>
    {{-- Leaflet CSS & JS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

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

    {{-- Main Content --}}
    <main class="max-w-4xl mx-auto px-4 md:px-6 pb-16 md:pb-24">

        @if($submitted)
            {{-- Success State --}}
            <div class="bg-surface-container-low rounded-xl p-8 md:p-16 text-center">
                <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-6">
                    <span class="material-symbols-outlined text-green-600 text-4xl">check_circle</span>
                </div>
                <h2 class="font-headline text-2xl md:text-3xl text-primary font-bold mb-4">Laporan Berhasil Dikirim!</h2>
                <p class="text-on-surface-variant text-base md:text-lg max-w-xl mx-auto leading-relaxed mb-8">
                    Terima kasih atas kontribusi Anda. Tim kami akan segera meninjau dan melakukan verifikasi lapangan terhadap laporan ini.
                </p>
                <button wire:click="resetForm"
                    class="px-8 py-4 bg-primary text-on-primary font-semibold rounded-full hover:bg-primary-container hover:scale-[1.02] active:scale-95 transition-all shadow-xl shadow-primary/10">
                    Kirim Laporan Lagi
                </button>
            </div>
        @else
            {{-- Form --}}
            <div class="bg-surface-container-low rounded-xl p-5 sm:p-8 md:p-12 relative">
                <form wire:submit="submit" class="space-y-10" x-data="{
                    map: null,
                    marker: null,
                    selectedFiles: [],

                    initMap() {
                        if (this.map) return;
                        const mapEl = document.getElementById('lapor-map');
                        if (!mapEl) return;

                        const waitForLeaflet = (cb) => {
                            if (typeof L !== 'undefined') cb();
                            else setTimeout(() => waitForLeaflet(cb), 100);
                        };

                        waitForLeaflet(() => {
                            this.map = L.map('lapor-map', {
                                scrollWheelZoom: true,
                                zoomControl: true,
                            }).setView([-8.49, 140.40], 12);

                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; OpenStreetMap',
                                maxZoom: 19,
                            }).addTo(this.map);

                            // If coordinates already set, place marker
                            const lat = parseFloat($wire.latitude);
                            const lng = parseFloat($wire.longitude);
                            if (lat && lng) {
                                this.marker = L.marker([lat, lng]).addTo(this.map);
                                this.map.setView([lat, lng], 15);
                            }

                            this.map.on('click', (e) => {
                                const { lat, lng } = e.latlng;
                                if (this.marker) {
                                    this.marker.setLatLng([lat, lng]);
                                } else {
                                    this.marker = L.marker([lat, lng]).addTo(this.map);
                                }
                                $wire.set('latitude', lat.toFixed(7));
                                $wire.set('longitude', lng.toFixed(7));
                            });

                            setTimeout(() => this.map.invalidateSize(), 200);
                        });
                    },

                    handleFileSelect(e) {
                        this.selectedFiles = [...e.target.files].map(f => f.name);
                    },

                    clearFiles() {
                        this.selectedFiles = [];
                        if (this.$refs.fotoInput) this.$refs.fotoInput.value = '';
                        $wire.set('fotos', []);
                    }
                }">
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
                                    for="nama_pelapor">NAMA PELAPOR <span class="text-red-500">*</span></label>
                                <input wire:model="nama_pelapor"
                                    class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-4 focus:ring-2 focus:ring-secondary/20 transition-all outline-none text-on-surface"
                                    id="nama_pelapor" placeholder="Masukkan nama lengkap" type="text" />
                                @error('nama_pelapor') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label class="font-label text-sm font-semibold tracking-wide text-on-surface-variant"
                                    for="kontak">NOMOR TELEPON / WA</label>
                                <input wire:model="kontak"
                                    class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-4 focus:ring-2 focus:ring-secondary/20 transition-all outline-none text-on-surface"
                                    id="kontak" placeholder="0812-xxxx-xxxx" type="text" />
                                @error('kontak') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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
                                    for="nama_situs">NAMA SITUS / JENIS BENDA <span class="text-red-500">*</span></label>
                                <input wire:model="nama_situs"
                                    class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-4 focus:ring-2 focus:ring-secondary/20 transition-all outline-none text-on-surface"
                                    id="nama_situs" placeholder="Contoh: Menhir Kayu Malind atau Situs Peninggalan"
                                    type="text" />
                                @error('nama_situs') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="font-label text-sm font-semibold tracking-wide text-on-surface-variant">PERKIRAAN
                                    LOKASI</label>
                                <input wire:model="lokasi"
                                    class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-4 focus:ring-2 focus:ring-secondary/20 transition-all outline-none text-on-surface mb-3"
                                    placeholder="Masukkan nama daerah atau keterangan lokasi" type="text" />
                                @error('lokasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            {{-- Map Picker --}}
                            <div class="space-y-2">
                                <label class="font-label text-sm font-semibold tracking-wide text-on-surface-variant">
                                    PIN LOKASI DI PETA <span class="text-on-surface-variant/60 text-xs font-normal">(Klik pada peta untuk menandai lokasi)</span>
                                </label>
                                <div class="rounded-xl overflow-hidden border border-outline-variant/20"
                                     x-init="$nextTick(() => initMap())">
                                    <div id="lapor-map" style="height: 300px; width: 100%; z-index: 1;"></div>
                                </div>
                                <div class="flex flex-col md:flex-row gap-3 mt-2">
                                    <div class="flex-1 space-y-1">
                                        <label class="text-xs text-on-surface-variant font-medium">Latitude</label>
                                        <input wire:model="latitude" readonly
                                            class="w-full bg-surface-container-highest border-none rounded-lg px-3 py-2.5 text-sm text-on-surface outline-none opacity-80"
                                            placeholder="— klik peta —" type="text" />
                                    </div>
                                    <div class="flex-1 space-y-1">
                                        <label class="text-xs text-on-surface-variant font-medium">Longitude</label>
                                        <input wire:model="longitude" readonly
                                            class="w-full bg-surface-container-highest border-none rounded-lg px-3 py-2.5 text-sm text-on-surface outline-none opacity-80"
                                            placeholder="— klik peta —" type="text" />
                                    </div>
                                </div>
                                @error('latitude') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                @error('longitude') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="font-label text-sm font-semibold tracking-wide text-on-surface-variant"
                                    for="deskripsi">DESKRIPSI SINGKAT TEMUAN</label>
                                <textarea wire:model="deskripsi"
                                    class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-4 focus:ring-2 focus:ring-secondary/20 transition-all outline-none text-on-surface resize-none"
                                    id="deskripsi"
                                    placeholder="Ceritakan kondisi, ukuran, atau sejarah lisan yang Anda ketahui tentang temuan ini..."
                                    rows="4"></textarea>
                                @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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
                            <div class="border-2 border-dashed border-outline-variant rounded-xl p-10 flex flex-col items-center justify-center gap-4 bg-surface-container-lowest/50 hover:bg-surface-container-lowest transition-all cursor-pointer"
                                 x-on:click="$refs.fotoInput.click()">
                                <template x-if="selectedFiles.length === 0">
                                    <div class="flex flex-col items-center gap-4">
                                        <div class="w-16 h-16 rounded-full bg-secondary-container/20 flex items-center justify-center text-secondary">
                                            <span class="material-symbols-outlined text-3xl">add_a_photo</span>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-on-surface font-semibold">Tarik dan lepaskan foto di sini</p>
                                            <p class="text-on-surface-variant text-sm mt-1">Format JPG, PNG, WebP (Maks. 5MB per file, maks. 5 foto)</p>
                                        </div>
                                        <span class="text-secondary font-bold text-sm uppercase tracking-widest hover:underline">PILIH FILE</span>
                                    </div>
                                </template>
                                <template x-if="selectedFiles.length > 0">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-14 h-14 rounded-full bg-green-100 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-green-600 text-2xl">check_circle</span>
                                        </div>
                                        <p class="text-on-surface font-semibold" x-text="selectedFiles.length + ' foto dipilih'"></p>
                                        <div class="flex flex-wrap gap-2 justify-center max-w-lg">
                                            <template x-for="(name, i) in selectedFiles" :key="i">
                                                <span class="text-xs px-3 py-1 bg-secondary-container/30 rounded-full text-on-surface-variant" x-text="name"></span>
                                            </template>
                                        </div>
                                        <button type="button" class="text-red-500 text-xs font-semibold hover:underline mt-1"
                                            x-on:click.stop="clearFiles()">Hapus semua</button>
                                    </div>
                                </template>
                            </div>
                            <input type="file" x-ref="fotoInput" wire:model="fotos" multiple
                                accept="image/jpeg,image/png,image/webp"
                                class="hidden"
                                x-on:change="handleFileSelect($event)" />
                        </div>
                        @error('fotos') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        @error('fotos.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                        {{-- Upload Progress --}}
                        <div wire:loading wire:target="fotos" class="flex items-center gap-3 p-3 bg-secondary-container/20 rounded-xl">
                            <span class="material-symbols-outlined text-secondary animate-spin">progress_activity</span>
                            <span class="text-sm text-on-surface-variant">Mengupload foto...</span>
                        </div>
                    </section>

                    {{-- Footer Action --}}
                    <div class="pt-6 flex flex-col items-center gap-6">
                        <p class="text-center text-on-surface-variant text-sm italic">
                            Dengan mengirimkan laporan ini, Anda berkontribusi pada pelestarian kebudayaan Papua. Tim kami
                            akan melakukan verifikasi lapangan segera.
                        </p>
                        <button
                            class="w-full md:w-auto px-12 py-5 bg-primary text-on-primary font-semibold text-lg rounded-full hover:bg-primary-container hover:scale-[1.02] active:scale-95 transition-all shadow-xl shadow-primary/10 disabled:opacity-50 disabled:cursor-not-allowed"
                            type="submit"
                            wire:loading.attr="disabled"
                            wire:target="submit,fotos">
                            <span wire:loading.remove wire:target="submit">Kirim Laporan Warisan</span>
                            <span wire:loading wire:target="submit" class="flex items-center gap-2">
                                <span class="material-symbols-outlined animate-spin text-xl">progress_activity</span>
                                Mengirim...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        @endif

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
</div>
