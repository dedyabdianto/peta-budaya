<div class="form-group">
    <label>Nama Cagar Budaya <span style="color:#DC2626;">*</span></label>
    <input type="text" wire:model="nama_cagar_budaya" placeholder="Masukkan nama cagar budaya" />
    @error('nama_cagar_budaya') <p class="form-error">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label>Kategori <span style="color:#DC2626;">*</span></label>
    <select wire:model="kategori_budaya_id">
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategoriList as $kategori)
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

<div class="form-group">
    <label>Latitude</label>
    <input type="number" step="any" wire:model="latitude" placeholder="-8.5" />
    @error('latitude') <p class="form-error">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label>Longitude</label>
    <input type="number" step="any" wire:model="longitude" placeholder="140.4" />
    @error('longitude') <p class="form-error">{{ $message }}</p> @enderror
</div>

<div class="form-group">
    <label>Thumbnail</label>
    <input type="file" wire:model="thumbnail" accept="image/png, image/jpeg" />
    @if ($thumbnail)
        <img src="{{ $thumbnail->temporaryUrl() }}" width="150">
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

