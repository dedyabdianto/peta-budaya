<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use App\Models\Galeri;
use App\Models\CagarBudaya;

new #[Layout('layouts.landing')] #[Title('Galeri Warisan')] class extends Component
{
    use WithPagination;

    #[Url(as: 'cari')]
    public string $search = '';

    #[Url(as: 'situs')]
    public string $filterSitus = '';

    #[Url(as: 'tipe')]
    public string $filterType = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilterSitus(): void
    {
        $this->resetPage();
    }

    public function updatingFilterType(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $siteOptions = CagarBudaya::select('id', 'nama_cagar_budaya')
            ->where('status', 'published')
            ->withCount('galeri')
            ->having('galeri_count', '>', 0)
            ->orderBy('nama_cagar_budaya')
            ->get();

        $query = Galeri::with(['cagarBudaya:id,nama_cagar_budaya,kategori_budaya_id', 'cagarBudaya.kategoriBudaya:id,nama_kategori,warna_badge,icon_marker'])
            ->latest();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('judul', 'like', "%{$this->search}%")
                  ->orWhereHas('cagarBudaya', fn ($cb) => $cb->where('nama_cagar_budaya', 'like', "%{$this->search}%"));
            });
        }

        if ($this->filterSitus) {
            $query->where('cagar_budaya_id', $this->filterSitus);
        }

        if ($this->filterType) {
            $query->where('file_type', $this->filterType);
        }

        $galeriItems = $query->paginate(24);
        $totalItems = Galeri::count();

        return $this->view(compact('galeriItems', 'siteOptions', 'totalItems'));
    }
};
?>

<div>
    <main class="pt-24 md:pt-32 pb-16 md:pb-24 px-4 md:px-6 lg:px-12 max-w-7xl mx-auto">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs md:text-sm text-on-surface-variant mb-6 md:mb-8">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-sm">home</span>
                Beranda
            </a>
            <span class="material-symbols-outlined text-sm opacity-40">chevron_right</span>
            <span class="text-primary font-semibold">Galeri</span>
        </nav>

        {{-- Header Section --}}
        <header class="mb-8 md:mb-16 max-w-3xl">
            <span class="font-label text-xs uppercase tracking-[0.2em] text-secondary font-semibold mb-4 block">Arsip Visual</span>
            <h1 class="font-headline text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-primary tracking-tighter leading-tight mb-4 md:mb-6">
                Galeri Warisan Tanah Malind</h1>
            <p class="text-base md:text-lg text-on-surface-variant leading-relaxed opacity-80">Menelusuri jejak peradaban melalui
                fragmen visual. Setiap gambar menceritakan filosofi mendalam, ritme alam, dan identitas luhur masyarakat
                Malind.</p>
        </header>

        {{-- Filter & Search --}}
        <div class="flex flex-col sm:flex-row gap-4 mb-6 md:mb-8">
            {{-- Search --}}
            <div class="relative group flex-1 sm:max-w-sm">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-secondary transition-colors">search</span>
                <input wire:model.live.debounce.400ms="search"
                    class="w-full pl-12 pr-4 py-3 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-secondary/20 focus:bg-surface-container-lowest transition-all placeholder:text-outline-variant text-sm"
                    placeholder="Cari foto atau situs..." type="text" />
            </div>
            {{-- Site Filter --}}
            <div class="relative flex-none">
                <select wire:model.live="filterSitus"
                    class="appearance-none w-full sm:w-56 px-5 py-3 bg-surface-container-highest rounded-xl border-none focus:ring-2 focus:ring-secondary/20 cursor-pointer font-medium text-primary text-sm pr-10">
                    <option value="">Semua Situs</option>
                    @foreach($siteOptions as $site)
                        <option value="{{ $site->id }}">{{ $site->nama_cagar_budaya }} ({{ $site->galeri_count }})</option>
                    @endforeach
                </select>
                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-primary text-lg">expand_more</span>
            </div>
        </div>

        {{-- Filter Chips --}}
        <div class="flex flex-wrap gap-2 md:gap-3 mb-8 md:mb-12">
            <button wire:click="$set('filterType', '')"
                class="px-6 py-2.5 rounded-full text-sm font-medium transition-all {{ $filterType === '' ? 'bg-primary text-on-primary shadow-lg shadow-primary/20' : 'bg-surface-container-high text-on-surface hover:bg-surface-variant' }}">
                Semua Foto
            </button>
            <button wire:click="$set('filterType', 'image')"
                class="px-6 py-2.5 rounded-full text-sm font-medium transition-all {{ $filterType === 'image' ? 'bg-primary text-on-primary shadow-lg shadow-primary/20' : 'bg-surface-container-high text-on-surface hover:bg-surface-variant' }}">
                <span class="material-symbols-outlined text-sm mr-1 align-middle">image</span>
                Foto
            </button>
            <button wire:click="$set('filterType', 'video')"
                class="px-6 py-2.5 rounded-full text-sm font-medium transition-all {{ $filterType === 'video' ? 'bg-primary text-on-primary shadow-lg shadow-primary/20' : 'bg-surface-container-high text-on-surface hover:bg-surface-variant' }}">
                <span class="material-symbols-outlined text-sm mr-1 align-middle">videocam</span>
                Video
            </button>
        </div>

        {{-- Stats --}}
        <div class="flex items-center gap-3 mb-6 text-sm text-on-surface-variant">
            <span class="material-symbols-outlined text-base text-secondary">photo_library</span>
            <span>{{ $galeriItems->total() }} media ditemukan dari {{ $totalItems }} total</span>
        </div>

        {{-- Loading Indicator --}}
        <div wire:loading.delay class="flex justify-center py-12">
            <div class="flex items-center gap-3 text-on-surface-variant">
                <span class="material-symbols-outlined animate-spin">progress_activity</span>
                <span class="text-sm font-medium">Memuat galeri...</span>
            </div>
        </div>

        {{-- Masonry Gallery --}}
        <div wire:loading.remove class="gallery-masonry">
            @forelse($galeriItems as $item)
                <div class="gallery-item group relative overflow-hidden rounded-xl bg-surface-container-highest" wire:key="galeri-{{ $item->id }}">
                    <a href="{{ route('landing.galeri.detail', $item->id) }}" class="block">
                        @if($item->file_type === 'video')
                            <video class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110"
                                src="{{ asset('storage/' . $item->file_path) }}" muted preload="metadata"></video>
                            <div class="absolute top-4 right-4 w-8 h-8 bg-black/50 backdrop-blur-sm rounded-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-sm">play_arrow</span>
                            </div>
                        @else
                            <img alt="{{ $item->judul }}"
                                class="w-full h-auto object-cover transition-transform duration-700 group-hover:scale-110"
                                src="{{ asset('storage/' . $item->file_path) }}" loading="lazy" />
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/90 via-primary/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-6 md:p-8">
                            @if($item->cagarBudaya && $item->cagarBudaya->kategoriBudaya)
                                <span class="text-secondary font-label text-xs tracking-widest uppercase mb-2">{{ $item->cagarBudaya->kategoriBudaya->nama_kategori }}</span>
                            @elseif($item->cagarBudaya)
                                <span class="text-secondary font-label text-xs tracking-widest uppercase mb-2">{{ $item->cagarBudaya->nama_cagar_budaya }}</span>
                            @endif
                            <h3 class="text-white font-headline text-lg md:text-2xl font-bold">{{ $item->judul }}</h3>
                            @if($item->cagarBudaya)
                                <p class="text-white/70 text-sm mt-2 font-light flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-xs">location_on</span>
                                    {{ $item->cagarBudaya->nama_cagar_budaya }}
                                </p>
                            @endif
                            <div class="mt-3 flex items-center gap-2 text-white/60 text-xs">
                                <span class="material-symbols-outlined text-xs">calendar_today</span>
                                {{ $item->created_at->translatedFormat('d F Y') }}
                                <span class="ml-auto text-white/40">{{ $item->file_size_formatted }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-full flex flex-col items-center py-20 text-center" style="break-inside:auto;">
                    <span class="material-symbols-outlined text-6xl text-outline/20 mb-4">photo_library</span>
                    <h3 class="text-xl font-headline font-bold text-primary mb-2">Belum ada media galeri</h3>
                    <p class="text-on-surface-variant max-w-md">
                        @if($search || $filterSitus || $filterType)
                            Pencarian tidak menemukan hasil. Coba ubah filter pencarian.
                        @else
                            Galeri warisan budaya belum memiliki media.
                        @endif
                    </p>
                    @if($search || $filterSitus || $filterType)
                        <button wire:click="$set('search', ''); $set('filterSitus', ''); $set('filterType', '')"
                            class="mt-6 px-6 py-3 bg-primary text-white rounded-full text-sm font-semibold hover:bg-primary/90 transition-all inline-flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">refresh</span>
                            Reset Filter
                        </button>
                    @endif
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($galeriItems->hasPages())
            <div class="mt-16 md:mt-20 flex justify-center">
                <div class="flex items-center gap-2">
                    @if($galeriItems->onFirstPage())
                        <span class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-high text-outline/40 cursor-not-allowed">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </span>
                    @else
                        <button wire:click="previousPage"
                            class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-high text-primary hover:bg-secondary-container transition-colors">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </button>
                    @endif

                    @foreach($galeriItems->getUrlRange(1, $galeriItems->lastPage()) as $page => $url)
                        @if($page == $galeriItems->currentPage())
                            <span class="w-12 h-12 flex items-center justify-center rounded-full bg-primary text-white font-bold">{{ $page }}</span>
                        @else
                            <button wire:click="gotoPage({{ $page }})"
                                class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-high text-primary hover:bg-secondary-container transition-colors">{{ $page }}</button>
                        @endif
                    @endforeach

                    @if($galeriItems->hasMorePages())
                        <button wire:click="nextPage"
                            class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-high text-primary hover:bg-secondary-container transition-colors">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </button>
                    @else
                        <span class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-high text-outline/40 cursor-not-allowed">
                            <span class="material-symbols-outlined">chevron_right</span>
                        </span>
                    @endif
                </div>
            </div>
        @endif

        {{-- Result Count --}}
        <div class="mt-6 text-center text-sm text-outline">
            Menampilkan {{ $galeriItems->firstItem() ?? 0 }}–{{ $galeriItems->lastItem() ?? 0 }} dari {{ $galeriItems->total() }} media
        </div>
    </main>
</div>
