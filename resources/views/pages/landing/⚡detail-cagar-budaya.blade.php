<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\CagarBudaya;

new #[Layout('layouts.landing')] class extends Component
{
    public CagarBudaya $cagar;

    public function mount(string $id): void
    {
        $this->cagar = CagarBudaya::with(['kategoriBudaya', 'distrik', 'galeri', 'user'])
            ->where('status', 'published')
            ->findOrFail($id);
    }

    public function render()
    {
        // Related cagar budaya (same kategori, exclude current)
        $related = CagarBudaya::with('kategoriBudaya')
            ->where('status', 'published')
            ->where('id', '!=', $this->cagar->id)
            ->where('kategori_budaya_id', $this->cagar->kategori_budaya_id)
            ->limit(3)
            ->get();

        return $this->view(compact('related'))
            ->title($this->cagar->nama_cagar_budaya . ' — Cagar Budaya');
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
            <a href="{{ route('landing.daftar-warisan') }}" class="hover:text-primary transition-colors">Daftar Cagar Budaya</a>
            <span class="material-symbols-outlined text-sm opacity-40">chevron_right</span>
            <span class="text-primary font-semibold line-clamp-1">{{ $cagar->nama_cagar_budaya }}</span>
        </nav>

        {{-- Hero Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 md:gap-10 mb-12 md:mb-20">
            {{-- Image --}}
            <div class="lg:col-span-3">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-primary/10 aspect-[16/10]">
                    @if($cagar->thumbnail)
                        <img class="w-full h-full object-cover"
                            src="{{ asset('storage/' . $cagar->thumbnail) }}"
                            alt="{{ $cagar->nama_cagar_budaya }}" />
                    @else
                        <div class="w-full h-full bg-surface-container-high flex items-center justify-center">
                            <span class="material-symbols-outlined text-7xl text-outline/20">landscape</span>
                        </div>
                    @endif

                    {{-- Category Badge --}}
                    @if($cagar->kategoriBudaya)
                        <div class="absolute top-5 left-5">
                            <span class="px-5 py-2 text-white text-xs font-bold rounded-full tracking-wider uppercase inline-flex items-center gap-2 shadow-lg"
                                style="background: {{ $cagar->kategoriBudaya->warna_badge ?: '#532300' }}">
                                <span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1">{{ $cagar->kategoriBudaya->icon_marker ?: 'category' }}</span>
                                {{ $cagar->kategoriBudaya->nama_kategori }}
                            </span>
                        </div>
                    @endif

                    {{-- Status Pelestarian --}}
                    @if($cagar->status_pelestarian)
                        @php
                            $statusColors = [
                                'baik' => 'bg-emerald-500',
                                'rusak ringan' => 'bg-yellow-500',
                                'rusak berat' => 'bg-red-500',
                                'terancam' => 'bg-red-700',
                            ];
                            $bgClass = $statusColors[$cagar->status_pelestarian] ?? 'bg-gray-500';
                        @endphp
                        <div class="absolute top-5 right-5">
                            <span class="px-4 py-2 {{ $bgClass }} text-white text-xs font-bold rounded-full uppercase tracking-wider shadow-lg inline-flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-xs">verified</span>
                                {{ ucfirst($cagar->status_pelestarian) }}
                            </span>
                        </div>
                    @endif
                </div>

                {{-- Gallery Grid --}}
                @if($cagar->galeri && $cagar->galeri->count() > 0)
                    <div class="mt-4 grid grid-cols-4 gap-3">
                        @foreach($cagar->galeri->take(4) as $i => $foto)
                            <div class="rounded-xl overflow-hidden aspect-square relative group cursor-pointer"
                                 onclick="openLightbox('{{ asset('storage/' . $foto->file_path) }}', '{{ $foto->judul ?? $cagar->nama_cagar_budaya }}')">
                                <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                    src="{{ asset('storage/' . $foto->file_path) }}"
                                    alt="{{ $foto->judul ?? 'Galeri' }}" loading="lazy" />
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center">
                                    <span class="material-symbols-outlined text-white opacity-0 group-hover:opacity-100 transition-opacity text-2xl">zoom_in</span>
                                </div>
                                @if($i === 3 && $cagar->galeri->count() > 4)
                                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                        <span class="text-white font-bold text-lg">+{{ $cagar->galeri->count() - 4 }}</span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Info Sidebar --}}
            <div class="lg:col-span-2 flex flex-col gap-6">
                <div>
                    <h1 class="text-2xl sm:text-3xl md:text-4xl font-headline font-bold text-primary tracking-tight leading-tight">
                        {{ $cagar->nama_cagar_budaya }}
                    </h1>
                    @if($cagar->kategoriBudaya)
                        <div class="mt-3 flex items-center gap-2 text-sm text-on-surface-variant">
                            <span class="material-symbols-outlined text-base" style="color: {{ $cagar->kategoriBudaya->warna_badge ?: '#1A362D' }}; font-variation-settings: 'FILL' 1">{{ $cagar->kategoriBudaya->icon_marker ?: 'category' }}</span>
                            {{ $cagar->kategoriBudaya->nama_kategori }}
                        </div>
                    @endif
                </div>

                {{-- Info Cards --}}
                <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-sm border border-surface-variant/30 space-y-5">
                    @if($cagar->alamat)
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary mt-0.5">location_on</span>
                            <div>
                                <p class="text-[10px] uppercase tracking-[0.15em] font-bold text-outline mb-1">Alamat</p>
                                <p class="text-sm font-medium text-primary">{{ $cagar->alamat }}</p>
                            </div>
                        </div>
                    @endif

                    @if($cagar->distrik)
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary mt-0.5">map</span>
                            <div>
                                <p class="text-[10px] uppercase tracking-[0.15em] font-bold text-outline mb-1">Distrik</p>
                                <p class="text-sm font-medium text-primary">{{ $cagar->distrik->nama }}</p>
                            </div>
                        </div>
                    @endif

                    @if($cagar->tahun_penemuan)
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary mt-0.5">calendar_month</span>
                            <div>
                                <p class="text-[10px] uppercase tracking-[0.15em] font-bold text-outline mb-1">Tahun Penemuan</p>
                                <p class="text-sm font-medium text-primary">{{ $cagar->tahun_penemuan }}</p>
                            </div>
                        </div>
                    @endif

                    @if($cagar->sk_penetapan)
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary mt-0.5">description</span>
                            <div>
                                <p class="text-[10px] uppercase tracking-[0.15em] font-bold text-outline mb-1">SK Penetapan</p>
                                <p class="text-sm font-medium text-primary">{{ $cagar->sk_penetapan }}</p>
                            </div>
                        </div>
                    @endif

                    @if($cagar->status_pelestarian)
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary mt-0.5">verified</span>
                            <div>
                                <p class="text-[10px] uppercase tracking-[0.15em] font-bold text-outline mb-1">Status Pelestarian</p>
                                @php
                                    $statusTextColors = [
                                        'baik' => 'text-emerald-700 bg-emerald-50',
                                        'rusak ringan' => 'text-yellow-700 bg-yellow-50',
                                        'rusak berat' => 'text-red-700 bg-red-50',
                                        'terancam' => 'text-red-800 bg-red-100',
                                    ];
                                    $statusCls = $statusTextColors[$cagar->status_pelestarian] ?? 'text-gray-700 bg-gray-50';
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold {{ $statusCls }}">
                                    {{ ucfirst($cagar->status_pelestarian) }}
                                </span>
                            </div>
                        </div>
                    @endif

                    @if($cagar->latitude && $cagar->longitude)
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary mt-0.5">explore</span>
                            <div>
                                <p class="text-[10px] uppercase tracking-[0.15em] font-bold text-outline mb-1">Koordinat</p>
                                <p class="text-sm font-mono text-primary">{{ $cagar->latitude }}, {{ $cagar->longitude }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row gap-3">
                    @if($cagar->latitude && $cagar->longitude)
                        <a href="https://www.google.com/maps?q={{ $cagar->latitude }},{{ $cagar->longitude }}" target="_blank" rel="noopener"
                            class="flex-1 flex items-center justify-center gap-2 px-6 py-3.5 bg-primary text-white rounded-xl font-semibold text-sm hover:bg-primary/90 transition-all hover:shadow-lg hover:shadow-primary/20">
                            <span class="material-symbols-outlined text-lg">map</span>
                            Buka di Google Maps
                        </a>
                    @endif
                    <a href="{{ route('landing.peta-digital') }}"
                        class="flex-1 flex items-center justify-center gap-2 px-6 py-3.5 bg-surface-container-highest text-primary rounded-xl font-semibold text-sm hover:bg-surface-variant transition-all">
                        <span class="material-symbols-outlined text-lg">explore</span>
                        Lihat di Peta Digital
                    </a>
                </div>
            </div>
        </div>

        {{-- Description Section --}}
        @if($cagar->deskripsi)
            <section class="mb-16 md:mb-24">
                <div class="max-w-4xl">
                    <h2 class="text-2xl md:text-3xl font-headline font-bold text-primary mb-6 flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary">article</span>
                        Deskripsi
                    </h2>
                    <div class="prose prose-lg max-w-none text-on-surface-variant leading-relaxed">
                        {!! nl2br(e($cagar->deskripsi)) !!}
                    </div>
                </div>
            </section>
        @endif

        {{-- Map Section --}}
        @if($cagar->latitude && $cagar->longitude)
            <section class="mb-16 md:mb-24">
                <h2 class="text-2xl md:text-3xl font-headline font-bold text-primary mb-6 flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary">location_on</span>
                    Lokasi
                </h2>
                <div class="rounded-2xl overflow-hidden shadow-lg border border-surface-variant/30" style="height: 400px;" wire:ignore>
                    <div id="detail-map" style="width:100%; height:100%;"></div>
                </div>
            </section>

            {{-- Leaflet CDN --}}
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
                integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    function initDetailMap() {
                        if (typeof L === 'undefined') {
                            setTimeout(initDetailMap, 200);
                            return;
                        }

                        var lat = {{ $cagar->latitude }};
                        var lng = {{ $cagar->longitude }};

                        var map = L.map('detail-map', {
                            scrollWheelZoom: false,
                            zoomControl: true,
                        }).setView([lat, lng], 15);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                            maxZoom: 19,
                        }).addTo(map);

                        var icon = L.divIcon({
                            html: '<div class="peta-marker" style="--mk-color:{{ $cagar->kategoriBudaya?->warna_badge ?: "#1A362D" }};"><span class="material-symbols-outlined">{{ $cagar->kategoriBudaya?->icon_marker ?: "location_on" }}</span></div>',
                            className: 'peta-marker-icon',
                            iconSize: [34, 42],
                            iconAnchor: [17, 42],
                        });

                        L.marker([lat, lng], { icon: icon })
                            .addTo(map)
                            .bindPopup('<strong>{{ $cagar->nama_cagar_budaya }}</strong>')
                            .openPopup();

                        setTimeout(function() { map.invalidateSize(); }, 300);
                    }
                    initDetailMap();
                });
            </script>
        @endif

        {{-- Related Cagar Budaya --}}
        @if($related->count() > 0)
            <section>
                <h2 class="text-2xl md:text-3xl font-headline font-bold text-primary mb-8 flex items-center gap-3">
                    <span class="material-symbols-outlined text-secondary">explore</span>
                    Cagar Budaya Terkait
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-8">
                    @foreach($related as $item)
                        <article class="group bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col">
                            <a href="{{ route('landing.cagar-budaya.detail', $item->id) }}" class="block">
                                <div class="aspect-[4/3] overflow-hidden relative">
                                    @if($item->thumbnail)
                                        <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                            src="{{ asset('storage/' . $item->thumbnail) }}"
                                            alt="{{ $item->nama_cagar_budaya }}" loading="lazy" />
                                    @else
                                        <div class="w-full h-full bg-surface-container-high flex items-center justify-center">
                                            <span class="material-symbols-outlined text-5xl text-outline/30">landscape</span>
                                        </div>
                                    @endif
                                    @if($item->kategoriBudaya)
                                        <div class="absolute top-4 left-4">
                                            <span class="px-4 py-1.5 text-white text-xs font-bold rounded-full tracking-wider uppercase inline-flex items-center gap-1.5"
                                                style="background: {{ $item->kategoriBudaya->warna_badge ?: '#532300' }}">
                                                {{ $item->kategoriBudaya->nama_kategori }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </a>
                            <div class="p-6 md:p-8 flex-1 flex flex-col">
                                <a href="{{ route('landing.cagar-budaya.detail', $item->id) }}">
                                    <h3 class="text-xl font-headline font-bold text-primary group-hover:text-secondary transition-colors">
                                        {{ $item->nama_cagar_budaya }}</h3>
                                </a>
                                <div class="mt-auto pt-6 flex items-center justify-between">
                                    <a class="text-primary font-bold text-sm inline-flex items-center gap-2 group/link"
                                        href="{{ route('landing.cagar-budaya.detail', $item->id) }}">
                                        Pelajari Lebih Lanjut
                                        <span class="material-symbols-outlined text-sm transition-transform group-hover/link:translate-x-2">arrow_forward</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- Back Button --}}
        <div class="mt-12 md:mt-16 text-center">
            <a href="{{ route('landing.daftar-warisan') }}"
                class="inline-flex items-center gap-2 px-8 py-4 bg-surface-container-high text-primary rounded-full font-semibold hover:bg-surface-container-highest transition-all hover:shadow-md">
                <span class="material-symbols-outlined text-lg">arrow_back</span>
                Kembali ke Daftar Cagar Budaya
            </a>
        </div>
    </main>

    {{-- Lightbox Modal --}}
    <div id="lightbox-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/80 backdrop-blur-sm" onclick="closeLightbox()">
        <button class="absolute top-6 right-6 text-white/80 hover:text-white transition-colors" onclick="closeLightbox()">
            <span class="material-symbols-outlined text-3xl">close</span>
        </button>
        <img id="lightbox-img" class="max-w-[90vw] max-h-[85vh] rounded-xl shadow-2xl object-contain" src="" alt="" />
    </div>

    <script>
        function openLightbox(src, alt) {
            var modal = document.getElementById('lightbox-modal');
            var img = document.getElementById('lightbox-img');
            img.src = src;
            img.alt = alt || '';
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeLightbox() {
            var modal = document.getElementById('lightbox-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</div>
