<div class="form-group">
    <label>Nama Cagar Budaya <span style="color:#DC2626;">*</span></label>
    <input type="text" wire:model="nama_cagar_budaya" placeholder="Masukkan nama cagar budaya" />
    @error('nama_cagar_budaya') <p class="form-error">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label>Kategori <span style="color:#DC2626;">*</span></label>
    <select wire:model="kategori_budaya_id">
        <option value="">-- Pilih Kategori --</option>
        @foreach($this->kategoriList as $kategori)
            <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
        @endforeach
    </select>
    @error('kategori_budaya_id') <p class="form-error">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label>Deskripsi</label>
    <textarea wire:model="deskripsi" placeholder="Masukkan deskripsi"></textarea>
    @error('deskripsi') <p class="form-error">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label>Alamat</label>
    <input type="text" wire:model="alamat" placeholder="Masukkan alamat" />
    @error('alamat') <p class="form-error">{{ $message }}</p> @enderror
</div>

{{-- Latitude & Longitude with Map Picker --}}
<div class="form-group">
    <label>Lokasi (Latitude & Longitude)</label>
    <p style="font-size:0.78rem; color:var(--text-muted); margin:0 0 10px;">
        Klik pada peta untuk menentukan koordinat lokasi, atau masukkan manual di bawah peta.
    </p>

    {{-- Map Picker --}}
    @php
        $initLat = filled($latitude) ? (float) $latitude : null;
        $initLng = filled($longitude) ? (float) $longitude : null;
        $hasCoords = $initLat !== null && $initLng !== null && ($initLat != 0 || $initLng != 0);
    @endphp
    <div class="map-picker-wrapper"
         wire:ignore
         x-on:modal-opened.window="setTimeout(() => onModalOpened(), 120)"
         x-data="cagarMapPicker({
            hasCoords: {{ $hasCoords ? 'true' : 'false' }},
            initLat: {{ $hasCoords ? $initLat : -8.4932 }},
            initLng: {{ $hasCoords ? $initLng : 140.4018 }}
         })">
        <div x-ref="mapEl" class="map-picker"></div>
        <div class="map-picker-coords">
            <span class="material-symbols-outlined" style="font-size:16px;">location_on</span>
            <span x-ref="coordsDisplay">{{ $hasCoords ? number_format($initLat, 7) . ', ' . number_format($initLng, 7) : 'Klik pada peta untuk memilih lokasi' }}</span>
        </div>
    </div>

    <div class="form-row" style="margin-top:12px;">
        <div>
            <label style="font-size:0.72rem; text-transform:none; letter-spacing:0; font-weight:600; color:var(--text-muted);">Latitude</label>
            <input type="number" step="any" wire:model="latitude" class="input-latitude" placeholder="-8.4932" />
            @error('latitude') <p class="form-error">{{ $message }}</p> @enderror
        </div>
        <div>
            <label style="font-size:0.72rem; text-transform:none; letter-spacing:0; font-weight:600; color:var(--text-muted);">Longitude</label>
            <input type="number" step="any" wire:model="longitude" class="input-longitude" placeholder="140.4018" />
            @error('longitude') <p class="form-error">{{ $message }}</p> @enderror
        </div>
    </div>
</div>

<script>
if (typeof window.cagarMapPicker === 'undefined') {
    window.cagarMapPicker = function(config) {
        return {
            map: null,
            marker: null,
            hasCoords: config.hasCoords || false,
            initLat: config.initLat || -8.4932,
            initLng: config.initLng || 140.4018,
            init() {},
            waitForLeaflet(callback) {
                if (typeof L !== 'undefined') {
                    callback();
                } else {
                    setTimeout(() => this.waitForLeaflet(callback), 100);
                }
            },
            getMarkerIcon() {
                return L.divIcon({
                    html: '<div style="background:#1A362D;width:28px;height:28px;border-radius:50% 50% 50% 0;transform:rotate(-45deg);border:3px solid #D4AF37;display:flex;align-items:center;justify-content:center;"><div style="background:#D4AF37;width:10px;height:10px;border-radius:50%;transform:rotate(45deg);"></div></div>',
                    iconSize: [28, 28],
                    iconAnchor: [14, 28],
                    className: 'map-custom-marker',
                });
            },
            onModalOpened() {
                this.waitForLeaflet(() => {
                    const formGroup = this.$refs.mapEl ? this.$refs.mapEl.closest('.form-group') : null;
                    const latInput = formGroup ? formGroup.querySelector('.input-latitude') : null;
                    const lonInput = formGroup ? formGroup.querySelector('.input-longitude') : null;
                    const coordsDisplay = this.$refs.coordsDisplay;
                    const latVal = latInput && latInput.value ? parseFloat(latInput.value) : null;
                    const lonVal = lonInput && lonInput.value ? parseFloat(lonInput.value) : null;
                    const hasValidCoords = latVal !== null && lonVal !== null && !isNaN(latVal) && !isNaN(lonVal) && (latVal !== 0 || lonVal !== 0);

                    if (!this.map) {
                        if (hasValidCoords) {
                            this.hasCoords = true;
                            this.initLat = latVal;
                            this.initLng = lonVal;
                        }
                        this.initMap();
                    } else {
                        if (hasValidCoords) {
                            const newLatLng = [latVal, lonVal];
                            if (this.marker) {
                                this.marker.setLatLng(newLatLng);
                            } else {
                                this.marker = L.marker(newLatLng, { icon: this.getMarkerIcon(), draggable: true }).addTo(this.map);
                                this.marker.on('dragend', (e) => {
                                    const pos = e.target.getLatLng();
                                    this.updateCoords(pos.lat, pos.lng, latInput, lonInput, coordsDisplay);
                                });
                            }
                            this.map.setView(newLatLng, 15);
                            if (coordsDisplay) coordsDisplay.textContent = latVal.toFixed(7) + ', ' + lonVal.toFixed(7);
                        } else {
                            if (this.marker) {
                                this.map.removeLayer(this.marker);
                                this.marker = null;
                            }
                            this.map.setView([-8.4932, 140.4018], 10);
                            if (coordsDisplay) coordsDisplay.textContent = 'Klik pada peta untuk memilih lokasi';
                        }
                        this.map.invalidateSize();
                    }
                });
            },
            initMap() {
                if (this.map) {
                    try { this.map.remove(); } catch (e) {}
                    this.map = null;
                }
                if (this.$refs.mapEl && this.$refs.mapEl._leaflet_id) {
                    this.$refs.mapEl._leaflet_id = null;
                }

                const formGroup = this.$refs.mapEl ? this.$refs.mapEl.closest('.form-group') : null;
                const latInput = formGroup ? formGroup.querySelector('.input-latitude') : null;
                const lonInput = formGroup ? formGroup.querySelector('.input-longitude') : null;
                const coordsDisplay = this.$refs.coordsDisplay;

                let initZoom = this.hasCoords ? 15 : 10;

                this.map = L.map(this.$refs.mapEl, {
                    scrollWheelZoom: true,
                    zoomControl: true,
                }).setView([this.initLat, this.initLng], initZoom);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap',
                    maxZoom: 19,
                }).addTo(this.map);

                const markerIcon = this.getMarkerIcon();

                if (this.hasCoords) {
                    this.marker = L.marker([this.initLat, this.initLng], { icon: markerIcon, draggable: true }).addTo(this.map);
                    if (coordsDisplay) coordsDisplay.textContent = this.initLat.toFixed(7) + ', ' + this.initLng.toFixed(7);
                    this.marker.on('dragend', (e) => {
                        const pos = e.target.getLatLng();
                        this.updateCoords(pos.lat, pos.lng, latInput, lonInput, coordsDisplay);
                    });
                }

                this.map.on('click', (e) => {
                    const { lat, lng } = e.latlng;
                    if (this.marker) {
                        this.marker.setLatLng([lat, lng]);
                    } else {
                        this.marker = L.marker([lat, lng], { icon: markerIcon, draggable: true }).addTo(this.map);
                        this.marker.on('dragend', (ev) => {
                            const pos = ev.target.getLatLng();
                            this.updateCoords(pos.lat, pos.lng, latInput, lonInput, coordsDisplay);
                        });
                    }
                    this.updateCoords(lat, lng, latInput, lonInput, coordsDisplay);
                });

                requestAnimationFrame(() => {
                    if (this.map) this.map.invalidateSize();
                });
                setTimeout(() => {
                    if (this.map) this.map.invalidateSize();
                }, 200);
            },
            destroy() {
                if (this.map) {
                    try { this.map.remove(); } catch (e) {}
                    this.map = null;
                }
            },
            updateCoords(lat, lng, latInput, lonInput, coordsDisplay) {
                const latVal = lat.toFixed(7);
                const lngVal = lng.toFixed(7);
                if (latInput) {
                    latInput.value = latVal;
                    latInput.dispatchEvent(new Event('input', { bubbles: true }));
                }
                if (lonInput) {
                    lonInput.value = lngVal;
                    lonInput.dispatchEvent(new Event('input', { bubbles: true }));
                }
                if (coordsDisplay) coordsDisplay.textContent = latVal + ', ' + lngVal;
            }
        };
    };
}
</script>

{{-- Thumbnail with existing image preview --}}
<div class="form-group">
    <label>Thumbnail</label>
    <input type="file" wire:model="thumbnail" accept="image/png, image/jpeg" />

    {{-- Preview: new upload takes priority, fallback to existing --}}
    @if ($thumbnail)
        <div style="margin-top:10px;">
            <p style="font-size:0.72rem; color:var(--text-muted); margin:0 0 6px;">Preview (baru):</p>
            <img src="{{ $thumbnail->temporaryUrl() }}" 
                 style="width:150px; height:100px; object-fit:cover; border-radius:8px; border:1px solid var(--border-light);" />
        </div>
    @elseif (!empty($existingThumbnail))
        <div style="margin-top:10px;">
            <p style="font-size:0.72rem; color:var(--text-muted); margin:0 0 6px;">Thumbnail saat ini:</p>
            <img src="{{ asset('storage/' . $existingThumbnail) }}" 
                 style="width:150px; height:100px; object-fit:cover; border-radius:8px; border:1px solid var(--border-light);" />
        </div>
    @endif
    @error('thumbnail') <p class="form-error">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label>SK Penetapan</label>
    <input type="text" wire:model="sk_penetapan" placeholder="Nomor SK" />
    @error('sk_penetapan') <p class="form-error">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label>Tahun Penemuan</label>
    <input type="number" wire:model="tahun_penemuan" placeholder="2020" />
    @error('tahun_penemuan') <p class="form-error">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label>Status Pelestarian</label>
     <select wire:model="status_pelestarian">
        <option value="">-- Pilih Status Pelestarian --</option>
        <option value="baik">Baik</option>
        <option value="rusak ringan">Rusak Ringan</option>
        <option value="rusak berat">Rusak Berat</option>
        <option value="terancam">Terancam</option>
    </select>
    @error('status_pelestarian') <p class="form-error">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label>Status <span style="color:#DC2626;">*</span></label>
    <select wire:model="status">
        <option value="">-- Pilih Status --</option>
        <option value="draft">Draft</option>
        <option value="published">Published</option>
    </select>
    @error('status') <p class="form-error">{{ $message }}</p> @enderror
</div>
