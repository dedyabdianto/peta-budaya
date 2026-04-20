<?php

use Livewire\Component;
use Livewire\Attributes\Validate;

new class extends Component {
    #[Validate('nullable|string')]
    public string $nama_kategori = '';

    #[Validate('required|string')]
    public string $icon_marker = '';

    #[Validate('required|string')]
    public string $warna_badge = '';

    #[Validate('required|string')]
    public string $deskripsi = '';

    public function save()
    {
        $this->validate();

        $kategori = new \App\Models\KategoriBudaya();
        $kategori->nama_kategori = $this->nama_kategori;
        $kategori->icon_marker = $this->icon_marker;
        $kategori->warna_badge = $this->warna_badge;
        $kategori->deskripsi = $this->deskripsi;
        $kategori->save();

        // Reset form setelah penyimpanan
        $this->reset();

        // Flash message
        session()->flash('message', 'Kategori budaya berhasil dibuat.');
    }
};
?>

<div>
    <form wire:submit="save" class="space-y-6">
        <!-- Nama Kategori -->
        <div>
            <label for="nama_kategori" class="block text-sm font-medium text-gray-700">
                Nama Kategori
            </label>
            <input type="text" id="nama_kategori" wire:model.live.debounce="nama_kategori" placeholder="Masukkan nama kategori" autofocus
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
            @error('nama_kategori')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Icon Marker -->
        <div>
            <label for="icon_marker" class="block text-sm font-medium text-gray-700">
                Icon Marker
            </label>
            <input type="text" id="icon_marker" wire:model="icon_marker" placeholder="Masukkan icon marker"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
            @error('icon_marker')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Warna Badge -->
        <div>
            <label for="warna_badge" class="block text-sm font-medium text-gray-700">
                Warna Badge
            </label>
            <input type="text" id="warna_badge" wire:model="warna_badge" placeholder="Masukkan warna badge"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
            @error('warna_badge')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">
                Deskripsi
            </label>
            <textarea id="deskripsi" wire:model="deskripsi" placeholder="Masukkan deskripsi" rows="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            @error('deskripsi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Actions -->
        <div class="flex gap-3">
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Simpan
            </button>
            <a href="{{ route('kategori-budaya.index') }}"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Batal
            </a>
        </div>
    </form>
</div>
