<x-layouts::landing :title="__('Peta Digital')">
    {{-- Leaflet CSS & JS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    {{-- MarkerCluster plugin --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

    {{-- Breadcrumb Header --}}
    <section class="pt-24 md:pt-28 pb-4 md:pb-6 px-4 md:px-8 max-w-7xl mx-auto">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs md:text-sm text-on-surface-variant mb-4 md:mb-6">
            <a href="{{ route('home') }}"
                class="hover:text-primary transition-colors flex items-center gap-1">
                <span class="material-symbols-outlined text-sm">home</span>
                Beranda
            </a>
            <span class="material-symbols-outlined text-sm opacity-40">chevron_right</span>
            <span class="text-primary font-semibold">Peta Digital</span>
        </nav>

        {{-- Title --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 md:gap-6 mb-6 md:mb-8">
            <div class="max-w-2xl">
                <span class="text-secondary font-semibold tracking-[0.2em] uppercase text-xs mb-2 block">Geospasial
                    Interaktif</span>
                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-headline font-bold text-primary tracking-tight leading-tight">
                    Peta Digital Warisan Budaya
                </h1>
                <p class="mt-3 md:mt-4 text-sm md:text-base text-on-surface-variant leading-relaxed max-w-xl">
                    Jelajahi lokasi situs sakral, rumah adat, dan titik sejarah di seluruh Tanah Malind secara
                    interaktif.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <div
                    class="flex items-center gap-2 px-4 py-2 bg-primary/10 text-primary rounded-full text-xs md:text-sm font-semibold">
                    <span class="peta-pulse-dot"></span>
                    <span id="peta-point-count">{{ $mapPoints->count() }}</span> titik terpetakan
                </div>
            </div>
        </div>
    </section>

    {{-- Map Container --}}
    <section class="px-4 md:px-8 max-w-7xl mx-auto pb-12 md:pb-20">
        <div class="peta-digital-wrapper" id="peta-digital-app">
            {{-- Sidebar --}}
            <aside class="peta-sidebar" id="peta-sidebar">
                {{-- Mobile Toggle --}}
                <button class="peta-sidebar-toggle md:hidden" id="peta-sidebar-toggle" onclick="togglePetaSidebar()"
                    title="Toggle sidebar">
                    <span class="material-symbols-outlined">expand_less</span>
                </button>

                {{-- Search --}}
                <div class="peta-sidebar-search">
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-lg">search</span>
                        <input type="text" id="peta-search-input" placeholder="Cari situs warisan..."
                            class="w-full pl-10 pr-4 py-2.5 bg-surface-container/60 border-none rounded-xl text-sm focus:ring-2 focus:ring-secondary/30 focus:bg-white transition-all placeholder:text-outline" />
                    </div>
                </div>

                {{-- Category Filter --}}
                <div class="peta-sidebar-categories">
                    <h3 class="text-[10px] uppercase tracking-[0.15em] font-bold text-on-surface-variant mb-3 px-1">
                        Filter Kategori</h3>
                    <div class="flex flex-wrap gap-2">
                        <button class="peta-category-chip active" data-kategori="all" onclick="filterKategori('all', this)">
                            <span class="material-symbols-outlined text-sm">layers</span>
                            Semua
                            <span class="peta-chip-count">{{ $mapPoints->count() }}</span>
                        </button>
                        @foreach ($kategoriList as $kat)
                            <button class="peta-category-chip" data-kategori="{{ $kat->id }}"
                                onclick="filterKategori('{{ $kat->id }}', this)">
                                <span class="material-symbols-outlined text-sm"
                                    style="color: {{ $kat->warna_badge ?: '#1A362D' }}">{{ $kat->icon_marker ?: 'location_on' }}</span>
                                {{ $kat->nama_kategori }}
                                <span class="peta-chip-count">{{ $kat->cagar_budaya_count }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- Location List --}}
                <div class="peta-sidebar-list" id="peta-location-list">
                    <h3 class="text-[10px] uppercase tracking-[0.15em] font-bold text-on-surface-variant mb-3 px-1">
                        Daftar Lokasi</h3>
                    <div class="peta-location-items" id="peta-location-items">
                        {{-- Populated by JS --}}
                    </div>

                    {{-- Empty State --}}
                    <div class="peta-empty-state hidden" id="peta-empty-state">
                        <span class="material-symbols-outlined text-3xl text-outline/40">search_off</span>
                        <p class="text-sm font-medium text-on-surface-variant mt-2">Tidak ada situs ditemukan</p>
                        <p class="text-xs text-outline mt-1">Coba ubah filter atau kata kunci pencarian</p>
                    </div>
                </div>
            </aside>

            {{-- Map --}}
            <div class="peta-map-container">
                <div id="peta-digital-map" class="peta-map"></div>

                {{-- Zoom Controls --}}
                <div class="peta-zoom-controls">
                    <button onclick="petaMap.zoomIn()" title="Perbesar">
                        <span class="material-symbols-outlined">add</span>
                    </button>
                    <button onclick="petaMap.zoomOut()" title="Perkecil">
                        <span class="material-symbols-outlined">remove</span>
                    </button>
                    <button onclick="petaResetView()" title="Reset tampilan" class="mt-2">
                        <span class="material-symbols-outlined">my_location</span>
                    </button>
                    <button onclick="toggleFullscreen()" title="Layar penuh" class="mt-1">
                        <span class="material-symbols-outlined" id="peta-fullscreen-icon">fullscreen</span>
                    </button>
                </div>

                {{-- Detail Panel (appears on marker click) --}}
                <div class="peta-detail-panel hidden" id="peta-detail-panel">
                    <button class="peta-detail-close" onclick="closePetaDetail()">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                    <div id="peta-detail-content">
                        {{-- Populated by JS --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Map Script --}}
    <script>
        var petaMap, petaCluster, petaMarkers = [], petaAllPoints = [];
        var activeKategori = 'all';

        function waitForLeaflet(cb) {
            if (typeof L !== 'undefined' && typeof L.markerClusterGroup !== 'undefined') cb();
            else setTimeout(function() { waitForLeaflet(cb); }, 100);
        }

        waitForLeaflet(function() {
            initPetaDigital();
        });

        function initPetaDigital() {
            petaAllPoints = @json($mapPoints);

            petaMap = L.map('peta-digital-map', {
                scrollWheelZoom: true,
                zoomControl: false,
                zoomAnimation: true,
                fadeAnimation: true,
                markerZoomAnimation: true,
                zoomSnap: 1,
                zoomDelta: 1,
                wheelPxPerZoomLevel: 60,
            }).setView([-8.49, 140.40], 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                maxZoom: 19,
                subdomains: ['a', 'b', 'c'],
            }).addTo(petaMap);

            petaCluster = L.markerClusterGroup({
                showCoverageOnHover: false,
                zoomToBoundsOnClick: true,
                spiderfyOnMaxZoom: true,
                disableClusteringAtZoom: 16,
                maxClusterRadius: 60,
                animate: true,
                animateAddingMarkers: true,
                iconCreateFunction: function(cluster) {
                    var count = cluster.getChildCount();
                    var size, cls;
                    if (count >= 100) { size = 56; cls = 'peta-cluster-xl'; }
                    else if (count >= 10) { size = 48; cls = 'peta-cluster-lg'; }
                    else { size = 40; cls = 'peta-cluster-sm'; }
                    return L.divIcon({
                        html: '<div class="peta-cluster ' + cls + '"><span>' + count + '</span></div>',
                        className: 'peta-cluster-icon',
                        iconSize: L.point(size, size),
                    });
                }
            });

            renderMarkers(petaAllPoints);
            petaMap.addLayer(petaCluster);
            fitToBounds(petaAllPoints);
            renderLocationList(petaAllPoints);

            setTimeout(function() { petaMap.invalidateSize(); }, 300);

            // Search listener
            document.getElementById('peta-search-input').addEventListener('input', function() {
                applyFilters();
            });
        }

        function renderMarkers(points) {
            petaCluster.clearLayers();
            petaMarkers = [];

            points.forEach(function(p) {
                var icon = L.divIcon({
                    html: '<div class="peta-marker" style="--mk-color:' + p.color + ';"><span class="material-symbols-outlined">' + p.icon + '</span></div>',
                    className: 'peta-marker-icon',
                    iconSize: [34, 42],
                    iconAnchor: [17, 42],
                    popupAnchor: [0, -42],
                });
                var marker = L.marker([p.lat, p.lng], { icon: icon });
                marker._pointData = p;

                marker.on('click', function() {
                    showPetaDetail(p);
                    petaMap.flyTo([p.lat, p.lng], 16, { duration: 0.8 });
                });

                petaMarkers.push(marker);
                petaCluster.addLayer(marker);
            });
        }

        function renderLocationList(points) {
            var container = document.getElementById('peta-location-items');
            var emptyState = document.getElementById('peta-empty-state');
            container.innerHTML = '';

            if (points.length === 0) {
                emptyState.classList.remove('hidden');
                return;
            }
            emptyState.classList.add('hidden');

            points.forEach(function(p) {
                var item = document.createElement('button');
                item.className = 'peta-location-item';
                item.setAttribute('data-id', p.id);
                item.onclick = function() {
                    showPetaDetail(p);
                    petaMap.flyTo([p.lat, p.lng], 16, { duration: 0.8 });
                    // Highlight active
                    document.querySelectorAll('.peta-location-item').forEach(function(el) { el.classList.remove('active'); });
                    item.classList.add('active');
                    // Close sidebar on mobile
                    if (window.innerWidth < 768) {
                        var sidebar = document.getElementById('peta-sidebar');
                        sidebar.classList.remove('mobile-open');
                    }
                };

                var thumbHtml = p.thumbnail
                    ? '<img src="' + p.thumbnail + '" alt="' + p.name + '" class="peta-location-thumb" />'
                    : '<div class="peta-location-thumb-placeholder"><span class="material-symbols-outlined">landscape</span></div>';

                item.innerHTML = thumbHtml +
                    '<div class="peta-location-info">' +
                    '<h4 class="peta-location-name">' + p.name + '</h4>' +
                    '<span class="peta-location-badge" style="--badge-color:' + p.color + ';">' +
                    '<span class="material-symbols-outlined" style="font-size:11px;">' + p.icon + '</span> ' + p.kategori +
                    '</span>' +
                    (p.distrik ? '<span class="peta-location-distrik"><span class="material-symbols-outlined" style="font-size:11px;">location_on</span> ' + p.distrik + '</span>' : '') +
                    '</div>';

                container.appendChild(item);
            });
        }

        function filterKategori(kategoriId, btn) {
            activeKategori = kategoriId;
            document.querySelectorAll('.peta-category-chip').forEach(function(el) { el.classList.remove('active'); });
            btn.classList.add('active');
            applyFilters();
        }

        function applyFilters() {
            var search = document.getElementById('peta-search-input').value.toLowerCase().trim();
            var filtered = petaAllPoints.filter(function(p) {
                var matchKategori = (activeKategori === 'all') || (p.kategoriId === activeKategori);
                var matchSearch = !search || p.name.toLowerCase().includes(search) || (p.alamat && p.alamat.toLowerCase().includes(search)) || (p.distrik && p.distrik.toLowerCase().includes(search));
                return matchKategori && matchSearch;
            });

            renderMarkers(filtered);
            renderLocationList(filtered);
            document.getElementById('peta-point-count').textContent = filtered.length;

            if (filtered.length > 0) {
                fitToBounds(filtered);
            }
        }

        function fitToBounds(points) {
            if (points.length > 0) {
                var bounds = L.latLngBounds(points.map(function(p) { return [p.lat, p.lng]; }));
                petaMap.fitBounds(bounds.pad(0.15), { maxZoom: 15, animate: true, duration: 0.8 });
            }
        }

        function showPetaDetail(p) {
            var panel = document.getElementById('peta-detail-panel');
            var content = document.getElementById('peta-detail-content');

            var statusColors = {'baik':'#10B981','rusak ringan':'#F59E0B','rusak berat':'#EF4444','terancam':'#DC2626'};
            var sColor = statusColors[p.pelestarian] || '#6B7280';

            var html = '';
            if (p.thumbnail) {
                html += '<div class="peta-detail-thumb"><img src="' + p.thumbnail + '" alt="' + p.name + '" /></div>';
            }
            html += '<div class="peta-detail-body">';
            html += '<span class="peta-detail-badge" style="--badge-color:' + p.color + ';">' +
                '<span class="material-symbols-outlined" style="font-size:13px;">' + p.icon + '</span> ' + p.kategori + '</span>';
            html += '<h3 class="peta-detail-title">' + p.name + '</h3>';

            if (p.deskripsi) {
                html += '<p class="peta-detail-desc">' + p.deskripsi + '</p>';
            }

            html += '<div class="peta-detail-meta">';
            if (p.alamat) {
                html += '<div class="peta-detail-meta-item"><span class="material-symbols-outlined">location_on</span>' + p.alamat + '</div>';
            }
            if (p.distrik) {
                html += '<div class="peta-detail-meta-item"><span class="material-symbols-outlined">map</span>Distrik ' + p.distrik + '</div>';
            }
            if (p.tahun) {
                html += '<div class="peta-detail-meta-item"><span class="material-symbols-outlined">calendar_month</span>Tahun ' + p.tahun + '</div>';
            }
            if (p.pelestarian) {
                html += '<div class="peta-detail-meta-item" style="color:' + sColor + ';font-weight:600;"><span class="material-symbols-outlined">verified</span>' + p.pelestarian.charAt(0).toUpperCase() + p.pelestarian.slice(1) + '</div>';
            }
            html += '</div>';

            html += '<div class="peta-detail-coords"><span class="material-symbols-outlined" style="font-size:13px;">explore</span>' + p.lat.toFixed(7) + ', ' + p.lng.toFixed(7) + '</div>';
            html += '</div>';

            content.innerHTML = html;
            panel.classList.remove('hidden');
            panel.classList.add('show');
        }

        function closePetaDetail() {
            var panel = document.getElementById('peta-detail-panel');
            panel.classList.remove('show');
            setTimeout(function() { panel.classList.add('hidden'); }, 300);
        }

        function petaResetView() {
            if (petaAllPoints.length > 0) {
                fitToBounds(petaAllPoints);
            } else {
                petaMap.setView([-8.49, 140.40], 12);
            }
        }

        function togglePetaSidebar() {
            var sidebar = document.getElementById('peta-sidebar');
            sidebar.classList.toggle('mobile-open');
        }

        function toggleFullscreen() {
            var wrapper = document.getElementById('peta-digital-app');
            var icon = document.getElementById('peta-fullscreen-icon');
            wrapper.classList.toggle('fullscreen');
            icon.textContent = wrapper.classList.contains('fullscreen') ? 'fullscreen_exit' : 'fullscreen';
            setTimeout(function() { petaMap.invalidateSize(); }, 300);
        }

        // Close sidebar when clicking map on mobile
        document.addEventListener('DOMContentLoaded', function() {
            var mapEl = document.getElementById('peta-digital-map');
            if (mapEl) {
                mapEl.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        var sidebar = document.getElementById('peta-sidebar');
                        sidebar.classList.remove('mobile-open');
                    }
                });
            }
        });
    </script>
</x-layouts::landing>
