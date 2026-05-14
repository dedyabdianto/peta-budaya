<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Galeri;

new #[Layout('layouts.landing')] class extends Component
{
    public Galeri $galeri;

    public function mount(string $id): void
    {
        $this->galeri = Galeri::with([
            'cagarBudaya:id,nama_cagar_budaya,kategori_budaya_id,deskripsi,alamat,thumbnail',
            'cagarBudaya.kategoriBudaya:id,nama_kategori,warna_badge,icon_marker',
            'user:id,name',
        ])->findOrFail($id);
    }

    public function render()
    {
        // Other media from the same cagar budaya
        $relatedMedia = collect();
        if ($this->galeri->cagar_budaya_id) {
            $relatedMedia = Galeri::where('cagar_budaya_id', $this->galeri->cagar_budaya_id)
                ->where('id', '!=', $this->galeri->id)
                ->latest()
                ->take(8)
                ->get();
        }

        // Recent media (different from current)
        $recentMedia = Galeri::with('cagarBudaya:id,nama_cagar_budaya')
            ->where('id', '!=', $this->galeri->id)
            ->when($this->galeri->cagar_budaya_id, fn ($q) => $q->where('cagar_budaya_id', '!=', $this->galeri->cagar_budaya_id))
            ->latest()
            ->take(6)
            ->get();

        return $this->view(compact('relatedMedia', 'recentMedia'))
            ->title($this->galeri->judul . ' — Galeri');
    }
};
?>

<div>
    <main class="pt-24 md:pt-32 pb-16 md:pb-24 px-4 md:px-6 lg:px-12 max-w-7xl mx-auto">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs md:text-sm text-on-surface-variant mb-6 md:mb-8 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-sm">home</span>
                Beranda
            </a>
            <span class="material-symbols-outlined text-sm opacity-40">chevron_right</span>
            <a href="{{ route('landing.galeri-warisan') }}" class="hover:text-primary transition-colors">Galeri</a>
            <span class="material-symbols-outlined text-sm opacity-40">chevron_right</span>
            <span class="text-primary font-semibold line-clamp-1">{{ $galeri->judul }}</span>
        </nav>

        {{-- Main Content --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12">

            {{-- Media Display --}}
            <div class="lg:col-span-2">
                <div class="rounded-2xl overflow-hidden shadow-2xl shadow-primary/10 bg-surface-container-highest">
                    @if($galeri->file_type === 'video')
                        <video class="w-full h-auto max-h-[70vh] object-contain bg-black"
                            src="{{ asset('storage/' . $galeri->file_path) }}" controls preload="metadata">
                        </video>
                    @else
                        <img class="w-full h-auto max-h-[70vh] object-contain cursor-zoom-in"
                            src="{{ asset('storage/' . $galeri->file_path) }}"
                            alt="{{ $galeri->judul }}"
                            onclick="openDetailLightbox(this.src, '{{ addslashes($galeri->judul) }}')" />
                    @endif
                </div>

                {{-- Media Info Bar --}}
                <div class="mt-4 flex flex-wrap items-center gap-4 text-sm text-on-surface-variant">
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-base text-outline">calendar_today</span>
                        {{ $galeri->created_at->translatedFormat('d F Y, H:i') }}
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-base text-outline">{{ $galeri->file_type === 'video' ? 'videocam' : 'image' }}</span>
                        {{ ucfirst($galeri->file_type) }}
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-base text-outline">hard_drive</span>
                        {{ $galeri->file_size_formatted }}
                    </div>
                    @if($galeri->user)
                        <div class="flex items-center gap-1.5 ml-auto">
                            <span class="material-symbols-outlined text-base text-outline">person</span>
                            {{ $galeri->user->name }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Sidebar Info --}}
            <div class="lg:col-span-1 flex flex-col gap-6">
                {{-- Title --}}
                <div>
                    <h1 class="text-2xl md:text-3xl font-headline font-bold text-primary tracking-tight leading-tight">
                        {{ $galeri->judul }}
                    </h1>
                </div>

                {{-- Linked Cagar Budaya Card --}}
                @if($galeri->cagarBudaya)
                    <div class="bg-surface-container-lowest rounded-2xl overflow-hidden shadow-sm border border-surface-variant/30">
                        <div class="p-1.5">
                            @if($galeri->cagarBudaya->thumbnail)
                                <div class="rounded-xl overflow-hidden aspect-[16/9]">
                                    <img class="w-full h-full object-cover"
                                        src="{{ asset('storage/' . $galeri->cagarBudaya->thumbnail) }}"
                                        alt="{{ $galeri->cagarBudaya->nama_cagar_budaya }}" loading="lazy" />
                                </div>
                            @endif
                        </div>
                        <div class="p-5">
                            <p class="text-[10px] uppercase tracking-[0.15em] font-bold text-outline mb-2">Cagar Budaya Terkait</p>
                            @if($galeri->cagarBudaya->kategoriBudaya)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold mb-3"
                                    style="background: color-mix(in srgb, {{ $galeri->cagarBudaya->kategoriBudaya->warna_badge ?: '#1A362D' }} 12%, transparent); color: {{ $galeri->cagarBudaya->kategoriBudaya->warna_badge ?: '#1A362D' }}">
                                    <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1">{{ $galeri->cagarBudaya->kategoriBudaya->icon_marker ?: 'category' }}</span>
                                    {{ $galeri->cagarBudaya->kategoriBudaya->nama_kategori }}
                                </span>
                            @endif
                            <h3 class="text-lg font-headline font-bold text-primary leading-snug">
                                {{ $galeri->cagarBudaya->nama_cagar_budaya }}
                            </h3>
                            @if($galeri->cagarBudaya->alamat)
                                <p class="mt-2 text-sm text-on-surface-variant flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm text-outline">location_on</span>
                                    {{ $galeri->cagarBudaya->alamat }}
                                </p>
                            @endif
                            <a href="{{ route('landing.cagar-budaya.detail', $galeri->cagarBudaya->id) }}"
                                class="mt-4 flex items-center justify-center gap-2 w-full px-4 py-3 bg-primary text-white rounded-xl font-semibold text-sm hover:bg-primary/90 transition-all hover:shadow-lg hover:shadow-primary/20">
                                <span class="material-symbols-outlined text-lg">open_in_new</span>
                                Lihat Detail Cagar Budaya
                            </a>
                        </div>
                    </div>
                @endif

                {{-- Actions --}}
                <div class="flex flex-col gap-3">
                    <a href="{{ asset('storage/' . $galeri->file_path) }}" download
                        class="flex items-center justify-center gap-2 px-5 py-3 bg-surface-container-highest text-primary rounded-xl font-semibold text-sm hover:bg-surface-variant transition-all">
                        <span class="material-symbols-outlined text-lg">download</span>
                        Unduh Media
                    </a>
                    <a href="{{ route('landing.galeri-warisan') }}"
                        class="flex items-center justify-center gap-2 px-5 py-3 bg-surface-container text-primary rounded-xl font-semibold text-sm hover:bg-surface-container-high transition-all">
                        <span class="material-symbols-outlined text-lg">arrow_back</span>
                        Kembali ke Galeri
                    </a>
                </div>
            </div>
        </div>

        {{-- Related Media from Same Cagar Budaya --}}
        @if($relatedMedia->count() > 0)
            <section class="mt-16 md:mt-24">
                <h2 class="text-2xl md:text-3xl font-headline font-bold text-primary mb-8 flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary">collections</span>
                    Media Lainnya dari {{ $galeri->cagarBudaya->nama_cagar_budaya }}
                </h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4">
                    @foreach($relatedMedia as $related)
                        <a href="{{ route('landing.galeri.detail', $related->id) }}"
                            class="group relative overflow-hidden rounded-xl bg-surface-container-highest aspect-square block">
                            @if($related->file_type === 'video')
                                <video class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                    src="{{ asset('storage/' . $related->file_path) }}" muted preload="metadata"></video>
                                <div class="absolute top-3 right-3 w-7 h-7 bg-black/50 backdrop-blur-sm rounded-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white text-xs">play_arrow</span>
                                </div>
                            @else
                                <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                    src="{{ asset('storage/' . $related->file_path) }}"
                                    alt="{{ $related->judul }}" loading="lazy" />
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <span class="text-white text-sm font-semibold line-clamp-2">{{ $related->judul }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Recent Media --}}
        @if($recentMedia->count() > 0)
            <section class="mt-16 md:mt-24">
                <h2 class="text-2xl md:text-3xl font-headline font-bold text-primary mb-8 flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary">schedule</span>
                    Media Terbaru Lainnya
                </h2>
                <div class="gallery-masonry">
                    @foreach($recentMedia as $recent)
                        <div class="gallery-item group relative overflow-hidden rounded-xl bg-surface-container-highest">
                            <a href="{{ route('landing.galeri.detail', $recent->id) }}" class="block">
                                @if($recent->file_type === 'video')
                                    <video class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110"
                                        src="{{ asset('storage/' . $recent->file_path) }}" muted preload="metadata"></video>
                                @else
                                    <img alt="{{ $recent->judul }}"
                                        class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110"
                                        src="{{ asset('storage/' . $recent->file_path) }}" loading="lazy" />
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-6 md:p-8">
                                    @if($recent->cagarBudaya)
                                        <span class="text-secondary font-label text-xs tracking-widest uppercase mb-2">{{ $recent->cagarBudaya->nama_cagar_budaya }}</span>
                                    @endif
                                    <h3 class="text-white font-headline text-lg md:text-xl font-bold">{{ $recent->judul }}</h3>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </main>

    {{-- Lightbox --}}
    <div id="detail-lightbox" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/85 backdrop-blur-sm" onclick="closeDetailLightbox()">
        <button class="absolute top-6 right-6 text-white/80 hover:text-white transition-colors" onclick="closeDetailLightbox()">
            <span class="material-symbols-outlined text-3xl">close</span>
        </button>
        <img id="detail-lightbox-img" class="max-w-[90vw] max-h-[85vh] rounded-xl shadow-2xl object-contain" src="" alt="" onclick="event.stopPropagation()" />
    </div>

    <script>
        function openDetailLightbox(src, alt) {
            var modal = document.getElementById('detail-lightbox');
            var img = document.getElementById('detail-lightbox-img');
            img.src = src;
            img.alt = alt || '';
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeDetailLightbox() {
            var modal = document.getElementById('detail-lightbox');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeDetailLightbox();
        });
    </script>
</div>
