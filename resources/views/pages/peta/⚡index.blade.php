<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use App\Models\CagarBudaya;
use App\Models\KategoriBudaya;

new #[Layout('layouts.admin')] #[Title('Kelola Peta & GIS')] class extends Component
{
    use WithPagination;

    public string $search = '';
    public bool $showEditCoordModal = false;
    public ?string $editId = null;
    public string $editName = '';
    public string $editLatitude = '';
    public string $editLongitude = '';

    #[Computed]
    public function cagarBudaya()
    {
        return CagarBudaya::query()
            ->with('kategoriBudaya:id,nama_kategori,icon_marker,warna_badge')
            ->when($this->search, fn ($q) => $q->where('nama_cagar_budaya', 'like', "%{$this->search}%"))
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->latest()
            ->paginate(10);
    }

    #[Computed]
    public function mapPoints()
    {
        return CagarBudaya::query()
            ->with('kategoriBudaya:id,nama_kategori,icon_marker,warna_badge')
            ->where('latitude', '!=', 0)
            ->where('longitude', '!=', 0)
            ->get(['id', 'nama_cagar_budaya', 'kategori_budaya_id', 'latitude', 'longitude', 'thumbnail', 'deskripsi', 'alamat', 'tahun_penemuan', 'status_pelestarian'])
            ->map(fn ($c) => [
                'id' => $c->id,
                'name' => $c->nama_cagar_budaya,
                'lat' => (float) $c->latitude,
                'lng' => (float) $c->longitude,
                'kategori' => $c->kategoriBudaya?->nama_kategori ?? 'Lainnya',
                'icon' => $c->kategoriBudaya?->icon_marker ?? 'location_on',
                'color' => $c->kategoriBudaya?->warna_badge ?? '#1A362D',
                'thumbnail' => $c->thumbnail ? asset('storage/' . $c->thumbnail) : '',
                'deskripsi' => $c->deskripsi ? \Illuminate\Support\Str::limit(strip_tags($c->deskripsi), 120) : '',
                'alamat' => $c->alamat ?? '',
                'tahun' => $c->tahun_penemuan ?? '',
                'pelestarian' => $c->status_pelestarian ?? '',
            ]);
    }

    #[Computed]
    public function kategoriList()
    {
        return KategoriBudaya::withCount('cagarBudaya')->get();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function openEditCoordModal(string $id)
    {
        $cagar = CagarBudaya::findOrFail($id);
        $this->editId = $cagar->id;
        $this->editName = $cagar->nama_cagar_budaya;
        $this->editLatitude = (string) $cagar->latitude;
        $this->editLongitude = (string) $cagar->longitude;
        $this->showEditCoordModal = true;
    }

    public function closeEditCoordModal()
    {
        $this->editId = null;
        $this->editName = '';
        $this->editLatitude = '';
        $this->editLongitude = '';
        $this->showEditCoordModal = false;
    }

    public function updateCoordinates()
    {
        $this->validate([
            'editLatitude' => 'required|numeric',
            'editLongitude' => 'required|numeric',
        ]);

        $cagar = CagarBudaya::findOrFail($this->editId);
        $cagar->update([
            'latitude' => $this->editLatitude,
            'longitude' => $this->editLongitude,
        ]);

        session()->flash('success', 'Koordinat berhasil diperbarui.');
        $this->closeEditCoordModal();
        unset($this->cagarBudaya, $this->mapPoints);
    }

    public function render()
    {
        return $this->view(['title' => 'Kelola Peta & GIS']);
    }
};
?>

<div>
    {{-- Leaflet CSS & JS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    {{-- MarkerCluster plugin --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-actions">
            <div>
                <h1>{{ $title }}</h1>
                <p>Manajemen data spasial dan koordinat situs warisan budaya Tanah Malind</p>
            </div>
            <a href="{{ route('cagar-budaya.index') }}" class="btn btn-primary">
                <span class="material-symbols-outlined" style="font-size:18px">add_location</span>
                Tambah Titik
            </a>
        </div>
    </div>

    <x-admin.flash-alert />

    {{-- Legend --}}
    @if($this->kategoriList->count())
    <div style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:16px;">
        @foreach($this->kategoriList as $kat)
        <div style="display:flex; align-items:center; gap:6px; padding:5px 12px; background:var(--card-bg); border:1px solid var(--border-light); border-radius:20px; font-size:0.78rem; font-weight:600; color:var(--text-secondary);">
            <span class="material-symbols-outlined" style="font-size:16px; color:{{ $kat->warna_badge ?: 'var(--jungle-mid)' }}">{{ $kat->icon_marker ?: 'location_on' }}</span>
            {{ $kat->nama_kategori }}
            <span style="background:{{ $kat->warna_badge ?: '#1A362D' }}20; color:{{ $kat->warna_badge ?: '#1A362D' }}; padding:1px 8px; border-radius:10px; font-size:0.7rem;">{{ $kat->cagar_budaya_count }}</span>
        </div>
        @endforeach
    </div>
    @endif

    {{-- Map --}}
    <div class="card" style="margin-bottom:24px;">
        <div class="card-body" style="padding:0;">
            <div wire:ignore
                 x-data="gisMap()"
                 x-init="init()"
                 style="position:relative;">
                <div x-ref="gisMap" style="width:100%; height:520px; border-radius:14px; z-index:1;"></div>
                <div style="position:absolute; top:12px; right:12px; z-index:10; display:flex; align-items:center; gap:6px; padding:6px 14px; border-radius:20px; background:rgba(26,54,45,0.88); backdrop-filter:blur(8px); font-size:0.75rem; font-weight:600; color:var(--gold-light);">
                    <span style="width:8px;height:8px;border-radius:50%;background:#10B981;animation:pulse-green 2s infinite;"></span>
                    <span x-text="pointCount + ' titik koordinat'"></span>
                </div>
            </div>
        </div>
    </div>

    {{-- Coordinate Table --}}
    <div class="card">
        <div class="card-header">
            <h3>Data Titik Koordinat</h3>
            <div class="search-bar">
                <span class="material-symbols-outlined">search</span>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari situs..." />
            </div>
        </div>
        <div class="card-body" style="padding:0;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Nama Situs</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Kategori</th>
                        <th style="width:160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($this->cagarBudaya as $index => $item)
                        <tr>
                            <td style="font-family:monospace; font-size:0.82rem; color:var(--text-muted);">
                                {{ $this->cagarBudaya->firstItem() + $index }}
                            </td>
                            <td>
                                <span style="font-size:0.85rem; font-weight:600; color:var(--text-primary);">
                                    {{ $item->nama_cagar_budaya }}
                                </span>
                            </td>
                            <td style="font-family:monospace; font-size:0.82rem;">{{ $item->latitude }}</td>
                            <td style="font-family:monospace; font-size:0.82rem;">{{ $item->longitude }}</td>
                            <td>
                                @if($item->kategoriBudaya)
                                <span style="display:inline-flex; align-items:center; gap:4px; padding:3px 10px; border-radius:20px; font-size:0.75rem; font-weight:600; background:{{ $item->kategoriBudaya->warna_badge ?? '#1A362D' }}18; color:{{ $item->kategoriBudaya->warna_badge ?? '#1A362D' }};">
                                    <span class="material-symbols-outlined" style="font-size:14px;">{{ $item->kategoriBudaya->icon_marker ?? 'location_on' }}</span>
                                    {{ $item->kategoriBudaya->nama_kategori }}
                                </span>
                                @else
                                    <span style="color:var(--text-muted);">—</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-outline btn-sm" wire:click="openEditCoordModal('{{ $item->id }}')">
                                    <span class="material-symbols-outlined" style="font-size:14px">edit_location_alt</span>
                                    Edit Koordinat
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; padding:48px 20px;">
                                <div style="display:flex; flex-direction:column; align-items:center; gap:12px;">
                                    <span class="material-symbols-outlined" style="font-size:48px; color:var(--text-muted); opacity:0.5;">map</span>
                                    <p style="margin:0; font-size:0.95rem; font-weight:600; color:var(--text-secondary);">
                                        @if($search) Tidak ada situs yang cocok @else Belum ada data koordinat @endif
                                    </p>
                                    <p style="margin:4px 0 0; font-size:0.82rem; color:var(--text-muted);">
                                        @if($search) Coba ubah kata kunci pencarian. @else Tambahkan cagar budaya dengan koordinat terlebih dahulu. @endif
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <x-admin.pagination :paginator="$this->cagarBudaya" />
        </div>
    </div>

    {{-- Edit Koordinat Modal --}}
    @if ($showEditCoordModal)
    <div class="modal-overlay" wire:click.self="closeEditCoordModal">
        <div class="modal-container" style="max-width:680px;">
            <div class="modal-header">
                <div class="modal-header-info">
                    <div class="modal-icon gold">
                        <span class="material-symbols-outlined">edit_location_alt</span>
                    </div>
                    <div>
                        <h3>Edit Koordinat</h3>
                        <p>{{ $editName }}</p>
                    </div>
                </div>
                <button class="modal-close-btn" wire:click="closeEditCoordModal">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form wire:submit="updateCoordinates">
                <div class="modal-body">
                    @php
                        $initLat = filled($editLatitude) ? (float) $editLatitude : null;
                        $initLng = filled($editLongitude) ? (float) $editLongitude : null;
                        $hasCoords = $initLat !== null && $initLng !== null && ($initLat != 0 || $initLng != 0);
                    @endphp
                    <div class="form-group">
                        <label>Lokasi pada Peta</label>
                        <p style="font-size:0.78rem; color:var(--text-muted); margin:0 0 10px;">
                            Klik pada peta atau geser marker untuk memperbarui koordinat.
                        </p>
                        <div class="map-picker-wrapper" wire:ignore
                             x-data="{
                                map: null, marker: null,
                                hasCoords: {{ $hasCoords ? 'true' : 'false' }},
                                initLat: {{ $hasCoords ? $initLat : -8.4932 }},
                                initLng: {{ $hasCoords ? $initLng : 140.4018 }},
                                init() { this.waitForLeaflet(() => this.initMap()); },
                                waitForLeaflet(cb) { typeof L !== 'undefined' ? cb() : setTimeout(() => this.waitForLeaflet(cb), 100); },
                                initMap() {
                                    const latIn = document.getElementById('edit-lat');
                                    const lngIn = document.getElementById('edit-lng');
                                    const cd = this.$refs.cd;
                                    this.map = L.map(this.$refs.editMapEl).setView([this.initLat, this.initLng], this.hasCoords ? 15 : 10);
                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '&copy; OpenStreetMap' }).addTo(this.map);
                                    const icon = L.divIcon({ html: '<div style=&quot;background:#1A362D;width:28px;height:28px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid #D4AF37;display:flex;align-items:center;justify-content:center;&quot;><div style=&quot;background:#D4AF37;width:10px;height:10px;border-radius:50%;transform:rotate(45deg);&quot;></div></div>', iconSize:[28,28], iconAnchor:[14,28], className:'map-custom-marker' });
                                    if (this.hasCoords) { this.marker = L.marker([this.initLat,this.initLng],{icon,draggable:true}).addTo(this.map); cd.textContent=this.initLat.toFixed(7)+', '+this.initLng.toFixed(7); this.marker.on('dragend',e=>{const p=e.target.getLatLng();this.upd(p.lat,p.lng,latIn,lngIn,cd);}); }
                                    this.map.on('click',e=>{const{lat,lng}=e.latlng;if(this.marker){this.marker.setLatLng([lat,lng]);}else{this.marker=L.marker([lat,lng],{icon,draggable:true}).addTo(this.map);this.marker.on('dragend',ev=>{const p=ev.target.getLatLng();this.upd(p.lat,p.lng,latIn,lngIn,cd);});}this.upd(lat,lng,latIn,lngIn,cd);});
                                    setTimeout(()=>this.map.invalidateSize(),300);
                                },
                                upd(lat,lng,li,lo,cd){li.value=lat.toFixed(7);lo.value=lng.toFixed(7);cd.textContent=lat.toFixed(7)+', '+lng.toFixed(7);li.dispatchEvent(new Event('input',{bubbles:true}));lo.dispatchEvent(new Event('input',{bubbles:true}));}
                             }">
                            <div x-ref="editMapEl" class="map-picker"></div>
                            <div class="map-picker-coords">
                                <span class="material-symbols-outlined" style="font-size:16px;">location_on</span>
                                <span x-ref="cd">{{ $hasCoords ? number_format($initLat,7).', '.number_format($initLng,7) : 'Klik peta' }}</span>
                            </div>
                        </div>
                        <div class="form-row" style="margin-top:12px;">
                            <div>
                                <label style="font-size:0.72rem;text-transform:none;letter-spacing:0;font-weight:600;color:var(--text-muted);">Latitude</label>
                                <input type="number" step="any" wire:model="editLatitude" id="edit-lat" placeholder="-8.4932" />
                                @error('editLatitude') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label style="font-size:0.72rem;text-transform:none;letter-spacing:0;font-weight:600;color:var(--text-muted);">Longitude</label>
                                <input type="number" step="any" wire:model="editLongitude" id="edit-lng" placeholder="140.4018" />
                                @error('editLongitude') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" wire:click="closeEditCoordModal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="material-symbols-outlined" style="font-size:18px">save</span>
                        Simpan Koordinat
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- GIS Map Script (MarkerCluster like reference site) --}}
    <script>
    function gisMap() {
        return {
            map: null,
            clusterGroup: null,
            pointCount: 0,

            init() {
                this.waitForLeaflet(() => this.initMap());
            },
            waitForLeaflet(cb) {
                if (typeof L !== 'undefined' && typeof L.markerClusterGroup !== 'undefined') cb();
                else setTimeout(() => this.waitForLeaflet(cb), 100);
            },

            initMap() {
                const points = @json($this->mapPoints);
                this.pointCount = points.length;

                this.map = L.map(this.$refs.gisMap, {
                    scrollWheelZoom: true,
                    zoomControl: true,
                    zoomAnimation: true,
                    fadeAnimation: true,
                    markerZoomAnimation: true,
                    zoomSnap: 1,
                    zoomDelta: 1,
                    wheelPxPerZoomLevel: 60,
                }).setView([-8.49, 140.40], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                    maxZoom: 19,
                    subdomains: ['a', 'b', 'c'],
                }).addTo(this.map);

                this.clusterGroup = L.markerClusterGroup({
                    showCoverageOnHover: true,
                    zoomToBoundsOnClick: true,
                    spiderfyOnMaxZoom: true,
                    disableClusteringAtZoom: 16,
                    maxClusterRadius: 60,
                    animate: true,
                    animateAddingMarkers: true,
                    iconCreateFunction: function(cluster) {
                        var count = cluster.getChildCount();
                        var size, cls;
                        if (count >= 100) { size = 56; cls = 'cluster-xl'; }
                        else if (count >= 10) { size = 48; cls = 'cluster-lg'; }
                        else { size = 40; cls = 'cluster-sm'; }
                        return L.divIcon({
                            html: '<div class="gis-cluster ' + cls + '"><span>' + count + '</span></div>',
                            className: 'gis-cluster-icon',
                            iconSize: L.point(size, size),
                        });
                    }
                });

                points.forEach(function(p) {
                    var icon = L.divIcon({
                        html: '<div class="gis-marker" style="--mk-color:' + p.color + ';"><span class="material-symbols-outlined">' + p.icon + '</span></div>',
                        className: 'gis-marker-icon',
                        iconSize: [34, 42],
                        iconAnchor: [17, 42],
                        popupAnchor: [0, -42],
                    });
                    var marker = L.marker([p.lat, p.lng], { icon: icon });

                    var thumbHtml = p.thumbnail
                        ? '<img src="' + p.thumbnail + '" style="width:100%;height:130px;object-fit:cover;border-radius:8px 8px 0 0;display:block;" />'
                        : '';
                    var statusColor = {'baik':'#10B981','rusak ringan':'#F59E0B','rusak berat':'#EF4444','terancam':'#DC2626'};
                    var sColor = statusColor[p.pelestarian] || '#6B7280';

                    var popupHtml = '<div style="min-width:240px;max-width:280px;font-family:inherit;">' +
                        thumbHtml +
                        '<div style="padding:10px 14px 12px;">' +
                        '<strong style="font-size:0.92rem;display:block;margin-bottom:6px;color:#1A362D;">' + p.name + '</strong>' +
                        '<span style="display:inline-flex;align-items:center;gap:4px;padding:2px 8px;border-radius:12px;font-size:0.72rem;font-weight:600;background:' + p.color + '18;color:' + p.color + ';margin-bottom:8px;">' +
                        '<span class="material-symbols-outlined" style="font-size:13px;">' + p.icon + '</span>' + p.kategori + '</span>' +
                        (p.deskripsi ? '<p style="font-size:0.78rem;color:#555;margin:0 0 8px;line-height:1.4;">' + p.deskripsi + '</p>' : '') +
                        (p.alamat ? '<div style="display:flex;align-items:flex-start;gap:4px;font-size:0.75rem;color:#777;margin-bottom:4px;"><span class="material-symbols-outlined" style="font-size:14px;color:#999;flex-shrink:0;margin-top:1px;">location_on</span>' + p.alamat + '</div>' : '') +
                        '<div style="display:flex;gap:12px;margin-top:6px;">' +
                        (p.tahun ? '<div style="font-size:0.72rem;color:#888;"><span class="material-symbols-outlined" style="font-size:13px;vertical-align:-2px;color:#999;">calendar_month</span> ' + p.tahun + '</div>' : '') +
                        (p.pelestarian ? '<div style="font-size:0.72rem;font-weight:600;color:' + sColor + ';"><span class="material-symbols-outlined" style="font-size:13px;vertical-align:-2px;">verified</span> ' + p.pelestarian.charAt(0).toUpperCase() + p.pelestarian.slice(1) + '</div>' : '') +
                        '</div>' +
                        '<div style="font-family:monospace;font-size:0.7rem;color:#aaa;margin-top:6px;">' + p.lat.toFixed(7) + ', ' + p.lng.toFixed(7) + '</div>' +
                        '</div></div>';

                    marker.bindPopup(popupHtml, { maxWidth: 280, className: 'gis-popup' });
                    this.clusterGroup.addLayer(marker);
                }.bind(this));

                this.map.addLayer(this.clusterGroup);

                if (points.length > 0) {
                    var bounds = L.latLngBounds(points.map(function(p) { return [p.lat, p.lng]; }));
                    this.map.fitBounds(bounds.pad(0.15), {
                        maxZoom: 15,
                        animate: true,
                        duration: 0.8
                    });
                }

                setTimeout(function() { this.map.invalidateSize(); }.bind(this), 300);
            }
        };
    }
    </script>
</div>
