<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

new
#[Layout('layouts.admin', ['title' => 'Tambah Kategori Budaya'])]
class extends Component {
    #[Validate('required|string|max:255')]
    public string $nama_kategori = '';

    #[Validate('nullable|string|max:255')]
    public string $icon_marker = '';

    #[Validate('nullable|string|max:50')]
    public string $warna_badge = '';

    #[Validate('nullable|string')]
    public string $deskripsi = '';

    public function save()
    {
        $this->validate();

        \App\Models\KategoriBudaya::create([
            'nama_kategori' => $this->nama_kategori,
            'icon_marker' => $this->icon_marker,
            'warna_badge' => $this->warna_badge,
            'deskripsi' => $this->deskripsi,
        ]);

        session()->flash('message', 'Kategori budaya berhasil dibuat.');

        return $this->redirect(route('kategori-budaya.index'), navigate: true);
    }
};
?>

<div>
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-actions">
            <div>
                <h1>Tambah Kategori Baru</h1>
                <p>Isi data untuk menambahkan kategori budaya baru.</p>
            </div>
            <a href="{{ route('kategori-budaya.index') }}" wire:navigate class="btn btn-outline">
                <span class="material-symbols-outlined" style="font-size:16px">arrow_back</span>
                Kembali
            </a>
        </div>
    </div>

    {{-- Flash Alerts --}}
    <x-admin.flash-alert />

    {{-- Form Card --}}
    <div class="card" style="max-width:700px;">
        <div class="card-header">
            <div style="display:flex; align-items:center; gap:12px;">
                <div class="modal-icon green">
                    <span class="material-symbols-outlined">add_circle</span>
                </div>
                <h3>Data Kategori</h3>
            </div>
        </div>
        <div class="card-body">
            <form wire:submit="save">
                @include('pages.kategori._form')

                <div style="display:flex; gap:10px; margin-top:20px; justify-content:flex-end;">
                    <a href="{{ route('kategori-budaya.index') }}" wire:navigate class="btn btn-outline">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <span class="material-symbols-outlined" style="font-size:18px">save</span>
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
