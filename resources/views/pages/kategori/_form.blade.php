{{-- Forms Create dan Edit --}}
<div class="form-group">
    <label for="nama_kategori">Nama Kategori <span style="color:#DC2626;">*</span></label>
    <input type="text" id="nama_kategori" wire:model="nama_kategori"
        placeholder="Masukkan nama kategori (contoh: Budaya, Alam, Sejarah)" autofocus />
    @error('nama_kategori')
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="icon_marker">
        Icon Marker
        <a href="https://fonts.google.com/icons" target="_blank" class="form-label-link">
            <span class="material-symbols-outlined" style="font-size:14px">open_in_new</span>
            Lihat Daftar Icon
        </a>
    </label>
    <input type="text" id="icon_marker" wire:model.live.debounce.300ms="icon_marker"
        placeholder="Ketik nama icon (contoh: temple_buddhist, forest, museum)" />
    @error('icon_marker')
        <p class="form-error">{{ $message }}</p>
    @enderror
    @if ($icon_marker)
        <div class="icon-preview">
            <span style="font-size:0.75rem; color:var(--text-muted);">Preview:</span>
            <div class="icon-preview-box">
                <span class="material-symbols-outlined" style="font-size:28px; color:var(--jungle-mid);">{{ $icon_marker }}</span>
            </div>
            <span style="font-size:0.75rem; color:var(--text-muted); font-family:monospace;">{{ $icon_marker }}</span>
        </div>
    @endif
    <div class="icon-suggestions">
        <span style="font-size:0.72rem; color:var(--text-muted); font-weight:600;">Saran icon:</span>
        @foreach (['temple_buddhist', 'museum', 'forest', 'castle', 'church', 'mosque', 'landscape', 'water', 'music_note', 'palette'] as $suggestion)
            <button type="button" class="icon-suggestion-btn"
                wire:click="$set('icon_marker', '{{ $suggestion }}')"
                title="{{ $suggestion }}">
                <span class="material-symbols-outlined" style="font-size:18px">{{ $suggestion }}</span>
            </button>
        @endforeach
    </div>
</div>

<div class="form-group">
    <label for="warna_badge">Warna Badge</label>
    <div style="display:flex; gap:10px; align-items:flex-start;">
        <input type="text" id="warna_badge" wire:model.live="warna_badge"
            placeholder="Kode warna HEX (contoh: #D4AF37)" style="flex:1;" />
        <input type="color" wire:model.live="warna_badge"
            value="{{ $warna_badge ?: '#1A362D' }}"
            style="width:44px; height:40px; border:1px solid var(--border-light); border-radius:10px; cursor:pointer; padding:2px;" />
    </div>
    @error('warna_badge')
        <p class="form-error">{{ $message }}</p>
    @enderror
    @if ($warna_badge)
        <div style="margin-top:8px; display:flex; align-items:center; gap:8px;">
            <span style="font-size:0.75rem; color:var(--text-muted);">Preview:</span>
            <span class="badge" style="background:{{ $warna_badge }}20; color:{{ $warna_badge }};">
                {{ $nama_kategori ?: 'Contoh Badge' }}
            </span>
        </div>
    @endif
</div>

<div class="form-group" style="margin-bottom:0;">
    <label for="deskripsi">Deskripsi</label>
    <textarea id="deskripsi" wire:model="deskripsi" rows="3"
        placeholder="Masukkan deskripsi kategori budaya..."></textarea>
    @error('deskripsi')
        <p class="form-error">{{ $message }}</p>
    @enderror
</div>
