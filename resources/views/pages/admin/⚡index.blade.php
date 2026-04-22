<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new
#[Layout('layouts.admin', ['title' => 'Dashboard'])]
class extends Component {
    //
};
?>

<div>
    {{-- Page Header --}}
    <div class="page-header">
        <h1>Dashboard Overview</h1>
        <p>Pusat Data Warisan Kebudayaan Tanah Malind</p>
    </div>

    {{-- Stat Cards --}}
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon green">
                <span class="material-symbols-outlined">location_on</span>
            </div>
            <div class="stat-info">
                <h3>Total Situs</h3>
                <div class="stat-number">142</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon brown">
                <span class="material-symbols-outlined">newspaper</span>
            </div>
            <div class="stat-info">
                <h3>Total Berita</h3>
                <div class="stat-number">87</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon gold">
                <span class="material-symbols-outlined">photo_library</span>
            </div>
            <div class="stat-info">
                <h3>Total Galeri</h3>
                <div class="stat-number">1,204</div>
            </div>
        </div>
        <div class="stat-card warning">
            <div class="stat-icon red">
                <span class="material-symbols-outlined">report</span>
            </div>
            <div class="stat-info">
                <h3>Laporan Menunggu</h3>
                <div class="stat-number">12</div>
                <span class="stat-sub">Perlu Tinjauan</span>
            </div>
        </div>
    </div>

    {{-- Map + Timeline --}}
    <div class="two-col">
        <div class="card">
            <div class="card-header">
                <h3>Peta Persebaran Warisan</h3>
            </div>
            <div class="card-body" style="padding:0;">
                <div class="mini-map">
                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBq9sJQASx9w4rwxwEZ59GBAT7Be_qnqGHL5dyik_JlgP9JS7lEpn8pfATuvJlQXpR1Yzjcq3gehFnnxlrJAdG02J2A3NS8tZN3UVaW7N4gLfM559m7-h4CJ54H7oFTZ7C44Hj615GMZQt5c4C8p4znwrXC-S_f-cjfVvG6TItIuh-szPwEKQ3PrvuauRigpKyVS_oiGunTvLkcKggbF6o0bq5erpbF9kjGwqk4MW8qL3nnJKHovOGnLeCS9M5iDuoF7gxP93LDVC0" alt="Overview Map" />
                    <div class="map-overlay">LIVE UPDATES</div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Aktivitas Terbaru</h3>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-time">10 Menit Lalu</div>
                        <div class="timeline-title">Situs Baru Ditambahkan</div>
                        <div class="timeline-desc">Admin mengunggah data 'Situs Candi Rimbi' beserta koordinat GIS.</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-time">2 Jam Lalu</div>
                        <div class="timeline-title">Pembaruan Deskripsi</div>
                        <div class="timeline-desc">Deskripsi budaya 'Tari Malind' diperbarui dengan foto baru.</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-time">Kemarin, 14:30</div>
                        <div class="timeline-title">Galeri Diperbarui</div>
                        <div class="timeline-desc">12 foto baru dari ekspedisi ke Kampung Wayau ditambahkan ke galeri.</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-time">2 Hari Lalu</div>
                        <div class="timeline-title">Laporan Diterima</div>
                        <div class="timeline-desc">Laporan situs baru dari pengguna 'Ahmad K.' menunggu verifikasi.</div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-time">3 Hari Lalu</div>
                        <div class="timeline-title">Berita Dipublikasi</div>
                        <div class="timeline-desc">Artikel "Festival Budaya Malind 2024" berhasil dipublikasikan.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
