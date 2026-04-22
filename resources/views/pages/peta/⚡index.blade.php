<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new
#[Layout('layouts.admin', ['title' => 'Kelola Peta & GIS'])]
class extends Component {
    //
};
?>

<div>
    {{-- Page Header --}}
    <div class="page-header">
        <h1>Kelola Peta &amp; GIS</h1>
        <p>Manajemen data spasial dan koordinat situs warisan budaya</p>
    </div>

    {{-- Map --}}
    <div class="card" style="margin-bottom:24px;">
        <div class="card-body" style="padding:0;">
            <div class="map-container" style="height:500px;">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBq9sJQASx9w4rwxwEZ59GBAT7Be_qnqGHL5dyik_JlgP9JS7lEpn8pfATuvJlQXpR1Yzjcq3gehFnnxlrJAdG02J2A3NS8tZN3UVaW7N4gLfM559m7-h4CJ54H7oFTZ7C44Hj615GMZQt5c4C8p4znwrXC-S_f-cjfVvG6TItIuh-szPwEKQ3PrvuauRigpKyVS_oiGunTvLkcKggbF6o0bq5erpbF9kjGwqk4MW8qL3nnJKHovOGnLeCS9M5iDuoF7gxP93LDVC0" alt="GIS Map" />
                <div class="map-overlay">Spatial Data Editor</div>
            </div>
        </div>
    </div>

    {{-- Coordinate Table --}}
    <div class="card">
        <div class="card-header">
            <h3>Data Titik Koordinat</h3>
            <button class="btn btn-primary btn-sm">
                <span class="material-symbols-outlined" style="font-size:16px">add_location</span>
                Tambah Titik
            </button>
        </div>
        <div class="card-body" style="padding:0;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama Situs</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="site-name">Situs Monumen Kapsul Waktu</span></td>
                        <td style="font-family:monospace;font-size:0.82rem;">-8.4932</td>
                        <td style="font-family:monospace;font-size:0.82rem;">140.4018</td>
                        <td><span class="badge badge-sejarah">Sejarah</span></td>
                        <td><button class="btn btn-outline btn-sm">Edit Koordinat</button></td>
                    </tr>
                    <tr>
                        <td><span class="site-name">Rumah Adat Gotad</span></td>
                        <td style="font-family:monospace;font-size:0.82rem;">-8.5124</td>
                        <td style="font-family:monospace;font-size:0.82rem;">140.3876</td>
                        <td><span class="badge badge-budaya">Budaya</span></td>
                        <td><button class="btn btn-outline btn-sm">Edit Koordinat</button></td>
                    </tr>
                    <tr>
                        <td><span class="site-name">Hutan Sakral Ndalir</span></td>
                        <td style="font-family:monospace;font-size:0.82rem;">-8.4715</td>
                        <td style="font-family:monospace;font-size:0.82rem;">140.4234</td>
                        <td><span class="badge badge-alam">Alam</span></td>
                        <td><button class="btn btn-outline btn-sm">Edit Koordinat</button></td>
                    </tr>
                    <tr>
                        <td><span class="site-name">Pantai Payum</span></td>
                        <td style="font-family:monospace;font-size:0.82rem;">-8.5301</td>
                        <td style="font-family:monospace;font-size:0.82rem;">140.3955</td>
                        <td><span class="badge badge-alam">Alam</span></td>
                        <td><button class="btn btn-outline btn-sm">Edit Koordinat</button></td>
                    </tr>
                    <tr>
                        <td><span class="site-name">Tugu Pepera</span></td>
                        <td style="font-family:monospace;font-size:0.82rem;">-8.4989</td>
                        <td style="font-family:monospace;font-size:0.82rem;">140.4102</td>
                        <td><span class="badge badge-sejarah">Sejarah</span></td>
                        <td><button class="btn btn-outline btn-sm">Edit Koordinat</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
