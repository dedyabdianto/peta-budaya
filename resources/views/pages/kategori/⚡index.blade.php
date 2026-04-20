<?php

use Livewire\Component;
use App\Models\KategoriBudaya;

new class extends Component {
    public $query;
    public function mount()
    {
        $this->query = KategoriBudaya::all();
    }
};
?>

<div>
    {{-- Do what you can, with what you have, where you are. - Theodore Roosevelt --}}
    @foreach ($query as $item)
        <p>ID: {{ $item->id }}</p>
        <p>Nama Kategori: {{ $item->nama_kategori }}</p>
        <p>Icon Marker: {{ $item->icon_marker }}</p>
        <p>Warna Badge: {{ $item->warna_badge }}</p>
        <p>Deskripsi: {{ $item->deskripsi }}</p>
    @endforeach
</div>
