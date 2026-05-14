<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use App\Models\CagarBudaya;
use App\Models\KategoriBudaya;

new #[Layout('layouts.landing')] #[Title('Daftar Cagar Budaya')] class extends Component
{
    use WithPagination;

    #[Url(as: 'cari')]
    public string $search = '';

    #[Url(as: 'kategori')]
    public string $kategoriFilter = '';

    #[Url(as: 'urut')]
    public string $sortBy = 'terbaru';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingKategoriFilter(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $kategoriList = KategoriBudaya::withCount('cagarBudaya')->orderBy('nama_kategori')->get();

        $query = CagarBudaya::with(['kategoriBudaya', 'distrik'])
            ->where('status', 'published');

        // Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama_cagar_budaya', 'like', "%{$this->search}%")
                  ->orWhere('deskripsi', 'like', "%{$this->search}%")
                  ->orWhere('alamat', 'like', "%{$this->search}%");
            });
        }

        // Filter by kategori
        if ($this->kategoriFilter) {
            $query->where('kategori_budaya_id', $this->kategoriFilter);
        }

        // Sort
        $query = match ($this->sortBy) {
            'terlama' => $query->oldest(),
            'alfabet' => $query->orderBy('nama_cagar_budaya'),
            default => $query->latest(),
        };

        $cagarBudayas = $query->paginate(12);

        return $this->view(compact('cagarBudayas', 'kategoriList'));
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
            <span class="text-primary font-semibold">Daftar Cagar Budaya</span>
        </nav>

        {{-- Header Section --}}
        <header class="mb-8 md:mb-16">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 md:gap-8">
                <div class="max-w-2xl">
                    <span class="text-secondary font-semibold tracking-[0.2em] uppercase text-xs mb-4 block">Eksplorasi Budaya</span>
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-headline font-bold text-primary tracking-tight leading-tight">
                        Katalog Cagar Budaya</h1>
                    <p class="mt-4 md:mt-6 text-base md:text-lg text-on-surface-variant leading-relaxed max-w-xl">
                        Menelusuri jejak peradaban Tanah Malind melalui dokumentasi digital situs cagar budaya, artefak
                        sakral, dan tradisi yang hidup.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                    {{-- Search Input --}}
                    <div class="relative group flex-1 sm:w-64">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-secondary transition-colors">search</span>
                        <input wire:model.live.debounce.400ms="search"
                            class="w-full pl-12 pr-4 py-3.5 bg-surface-container rounded-xl border-none focus:ring-2 focus:ring-secondary/20 focus:bg-surface-container-lowest transition-all placeholder:text-outline-variant"
                            placeholder="Cari cagar budaya..." type="text" />
                    </div>
                    {{-- Sort Dropdown --}}
                    <div class="relative flex-none">
                        <select wire:model.live="sortBy"
                            class="appearance-none w-full sm:w-48 px-6 py-3.5 bg-surface-container-highest rounded-xl border-none focus:ring-2 focus:ring-secondary/20 cursor-pointer font-medium text-primary pr-12">
                            <option value="terbaru">Terbaru</option>
                            <option value="terlama">Terlama</option>
                            <option value="alfabet">Alfabetis</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-primary">expand_more</span>
                    </div>
                </div>
            </div>
        </header>

        {{-- Category Filter Chips --}}
        <div class="mb-8 flex flex-wrap gap-3">
            <button wire:click="$set('kategoriFilter', '')"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300
                {{ $kategoriFilter === '' ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'bg-surface-container-high text-primary hover:bg-surface-container-highest' }}">
                <span class="material-symbols-outlined text-sm">layers</span>
                Semua
            </button>
            @foreach($kategoriList as $kat)
                <button wire:click="$set('kategoriFilter', '{{ $kat->id }}')"
                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300
                    {{ $kategoriFilter === $kat->id ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'bg-surface-container-high text-primary hover:bg-surface-container-highest' }}">
                    <span class="material-symbols-outlined text-sm"
                        style="color: {{ $kategoriFilter === $kat->id ? '#aecdc0' : ($kat->warna_badge ?: '#1A362D') }}">{{ $kat->icon_marker ?: 'category' }}</span>
                    {{ $kat->nama_kategori }}
                    <span class="text-xs opacity-60">({{ $kat->cagar_budaya_count }})</span>
                </button>
            @endforeach
        </div>

        {{-- Loading Indicator --}}
        <div wire:loading.delay class="flex justify-center py-12">
            <div class="flex items-center gap-3 text-on-surface-variant">
                <span class="material-symbols-outlined animate-spin">progress_activity</span>
                <span class="text-sm font-medium">Memuat data...</span>
            </div>
        </div>

        {{-- Heritage Grid --}}
        <div wire:loading.remove class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
            @forelse($cagarBudayas as $cagar)
                <article class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col">
                    <a href="{{ route('landing.cagar-budaya.detail', $cagar->id) }}" class="block">
                        <div class="aspect-[4/3] overflow-hidden relative">
                            @if($cagar->thumbnail)
                                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                    src="{{ asset('storage/' . $cagar->thumbnail) }}"
                                    alt="{{ $cagar->nama_cagar_budaya }}" loading="lazy" />
                            @else
                                <div class="w-full h-full bg-surface-container-high flex items-center justify-center">
                                    <span class="material-symbols-outlined text-5xl text-outline/30">landscape</span>
                                </div>
                            @endif
                            @if($cagar->kategoriBudaya)
                                <div class="absolute top-4 left-4">
                                    <span class="px-4 py-1.5 text-white text-xs font-bold rounded-full tracking-wider uppercase inline-flex items-center gap-1.5"
                                        style="background: {{ $cagar->kategoriBudaya->warna_badge ?: '#532300' }}">
                                        <span class="material-symbols-outlined text-xs" style="font-variation-settings: 'FILL' 1">{{ $cagar->kategoriBudaya->icon_marker ?: 'category' }}</span>
                                        {{ $cagar->kategoriBudaya->nama_kategori }}
                                    </span>
                                </div>
                            @endif
                            @if($cagar->status_pelestarian)
                                <div class="absolute top-4 right-4">
                                    @php
                                        $statusColors = [
                                            'baik' => 'bg-emerald-500',
                                            'rusak ringan' => 'bg-yellow-500',
                                            'rusak berat' => 'bg-red-500',
                                            'terancam' => 'bg-red-700',
                                        ];
                                        $bgClass = $statusColors[$cagar->status_pelestarian] ?? 'bg-gray-500';
                                    @endphp
                                    <span class="px-3 py-1 {{ $bgClass }} text-white text-[10px] font-bold rounded-full uppercase tracking-wider">
                                        {{ ucfirst($cagar->status_pelestarian) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </a>
                    <div class="p-6 md:p-8 flex-1 flex flex-col">
                        <a href="{{ route('landing.cagar-budaya.detail', $cagar->id) }}" class="block">
                            <h3 class="text-xl md:text-2xl font-headline font-bold text-primary group-hover:text-secondary transition-colors">
                                {{ $cagar->nama_cagar_budaya }}</h3>
                        </a>
                        @if($cagar->deskripsi)
                            <p class="mt-3 md:mt-4 text-on-surface-variant line-clamp-3 leading-relaxed text-sm md:text-base">
                                {{ Str::limit(strip_tags($cagar->deskripsi), 150) }}
                            </p>
                        @endif
                        <div class="mt-auto pt-6 md:pt-8 flex items-center justify-between">
                            <a class="text-primary font-bold text-sm inline-flex items-center gap-2 group/link hover:text-secondary transition-colors"
                                href="{{ route('landing.cagar-budaya.detail', $cagar->id) }}">
                                Pelajari Lebih Lanjut
                                <span class="material-symbols-outlined text-sm transition-transform group-hover/link:translate-x-2">arrow_forward</span>
                            </a>
                            <div class="flex items-center gap-2">
                                @if($cagar->distrik)
                                    <span class="text-[10px] text-outline font-medium tracking-widest uppercase">{{ $cagar->distrik->nama }}</span>
                                @endif
                                @if($cagar->tahun_penemuan)
                                    <span class="text-[10px] text-outline/60">·</span>
                                    <span class="text-[10px] text-outline font-medium">{{ $cagar->tahun_penemuan }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                {{-- Empty State --}}
                <div class="col-span-full flex flex-col items-center py-20 text-center">
                    <span class="material-symbols-outlined text-6xl text-outline/20 mb-4">search_off</span>
                    <h3 class="text-xl font-headline font-bold text-primary mb-2">Tidak ada cagar budaya ditemukan</h3>
                    <p class="text-on-surface-variant max-w-md">
                        @if($search)
                            Pencarian "{{ $search }}" tidak menemukan hasil. Coba ubah kata kunci pencarian.
                        @else
                            Belum ada data cagar budaya yang dipublikasikan.
                        @endif
                    </p>
                    @if($search || $kategoriFilter)
                        <button wire:click="$set('search', ''); $set('kategoriFilter', '')"
                            class="mt-6 px-6 py-3 bg-primary text-white rounded-full text-sm font-semibold hover:bg-primary/90 transition-all inline-flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">refresh</span>
                            Reset Filter
                        </button>
                    @endif
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($cagarBudayas->hasPages())
            <div class="mt-16 md:mt-20 flex justify-center">
                <div class="flex items-center gap-2">
                    {{-- Previous --}}
                    @if($cagarBudayas->onFirstPage())
                        <span class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-high text-outline/40 cursor-not-allowed">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </span>
                    @else
                        <button wire:click="previousPage"
                            class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-high text-primary hover:bg-secondary-container transition-colors">
                            <span class="material-symbols-outlined">chevron_left</span>
                        </button>
                    @endif

                    {{-- Page Numbers --}}
                    @foreach($cagarBudayas->getUrlRange(1, $cagarBudayas->lastPage()) as $page => $url)
                        @if($page == $cagarBudayas->currentPage())
                            <span class="w-12 h-12 flex items-center justify-center rounded-full bg-primary text-white font-bold">{{ $page }}</span>
                        @else
                            <button wire:click="gotoPage({{ $page }})"
                                class="w-12 h-12 flex items-center justify-center rounded-full bg-surface-container-high text-primary hover:bg-secondary-container transition-colors">{{ $page }}</button>
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @if($cagarBudayas->hasMorePages())
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
            Menampilkan {{ $cagarBudayas->firstItem() ?? 0 }}–{{ $cagarBudayas->lastItem() ?? 0 }} dari {{ $cagarBudayas->total() }} cagar budaya
        </div>
    </main>
</div>
