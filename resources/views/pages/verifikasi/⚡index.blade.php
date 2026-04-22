<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new
#[Layout('layouts.admin', ['title' => 'Verifikasi Laporan'])]
class extends Component {
    //
};
?>

<div>
    <div class="page-header">
        <div class="page-header-actions">
            <div>
                <h1>Verifikasi Laporan</h1>
                <p>Tinjau dan validasi kiriman publik terkait situs warisan dan penemuan budaya baru.</p>
            </div>
            <div style="display:flex;gap:8px;">
                <button class="btn btn-outline">
                    <span class="material-symbols-outlined" style="font-size:16px">download</span>
                    Export CSV
                </button>
                <button class="btn btn-primary">
                    <span class="material-symbols-outlined" style="font-size:16px">filter_list</span>
                    Filter
                </button>
            </div>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="stat-grid" style="grid-template-columns:repeat(3,1fr);margin-bottom:28px;">
        <div class="stat-card" style="background:linear-gradient(135deg,rgba(26,54,45,0.06),rgba(26,54,45,0.02));">
            <div class="stat-icon gold">
                <span class="material-symbols-outlined">pending_actions</span>
            </div>
            <div class="stat-info">
                <h3>Menunggu Tinjauan</h3>
                <div class="stat-number">24</div>
                <span class="stat-sub">+3 hari ini</span>
            </div>
        </div>
        <div class="stat-card" style="background:linear-gradient(135deg,rgba(16,185,129,0.06),rgba(16,185,129,0.02));">
            <div class="stat-icon green">
                <span class="material-symbols-outlined">check_circle</span>
            </div>
            <div class="stat-info">
                <h3>Disetujui (Bulan Ini)</h3>
                <div class="stat-number">142</div>
                <span class="stat-sub">85% approval rate</span>
            </div>
        </div>
        <div class="stat-card" style="background:linear-gradient(135deg,rgba(239,68,68,0.06),rgba(239,68,68,0.02));">
            <div class="stat-icon red">
                <span class="material-symbols-outlined">cancel</span>
            </div>
            <div class="stat-info">
                <h3>Ditolak / Arsip</h3>
                <div class="stat-number">18</div>
                <span class="stat-sub">Butuh info lanjut</span>
            </div>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="card">
        <div class="card-header">
            <h3>Daftar Ajuan Publik</h3>
            <div class="filter-tabs">
                <button class="filter-tab active">Semua</button>
                <button class="filter-tab">Menunggu</button>
                <button class="filter-tab">Selesai</button>
            </div>
        </div>
        <div class="card-body" style="padding:0;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID Ajuan</th>
                        <th>Tanggal</th>
                        <th>Nama Situs Ajuan</th>
                        <th>Pelapor</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-family:monospace;font-size:0.78rem;color:var(--text-muted);">#MLD-2024-089</td>
                        <td style="font-size:0.82rem;">12 Okt 2024</td>
                        <td><div class="site-name">Situs Batu Ukir Wapeko</div><div class="site-location"><span class="material-symbols-outlined">location_on</span> Kurik, Merauke</div></td>
                        <td><div class="pelapor-cell"><span class="user-avatar green">AK</span> Ahmad K.</div></td>
                        <td><span class="badge badge-menunggu">● Menunggu</span></td>
                        <td><button class="btn btn-primary btn-sm">Review</button></td>
                    </tr>
                    <tr>
                        <td style="font-family:monospace;font-size:0.78rem;color:var(--text-muted);">#MLD-2024-088</td>
                        <td style="font-size:0.82rem;">11 Okt 2024</td>
                        <td><div class="site-name">Pohon Sakral Kampung Salor</div><div class="site-location"><span class="material-symbols-outlined">location_on</span> Salor, Merauke</div></td>
                        <td><div class="pelapor-cell"><span class="user-avatar gold">YM</span> Yoseph M.</div></td>
                        <td><span class="badge badge-menunggu">● Menunggu</span></td>
                        <td><button class="btn btn-primary btn-sm">Review</button></td>
                    </tr>
                    <tr>
                        <td style="font-family:monospace;font-size:0.78rem;color:var(--text-muted);">#MLD-2024-085</td>
                        <td style="font-size:0.82rem;">09 Okt 2024</td>
                        <td><div class="site-name">Artefak Gerabah Wasur</div><div class="site-location"><span class="material-symbols-outlined">location_on</span> Wasur, Merauke</div></td>
                        <td><div class="pelapor-cell"><span class="user-avatar brown">SN</span> Siti N.</div></td>
                        <td><span class="badge badge-disetujui">● Disetujui</span></td>
                        <td><button class="btn btn-outline btn-sm">Lihat</button></td>
                    </tr>
                    <tr>
                        <td style="font-family:monospace;font-size:0.78rem;color:var(--text-muted);">#MLD-2024-082</td>
                        <td style="font-size:0.82rem;">05 Okt 2024</td>
                        <td><div class="site-name">Bekas Pemukiman Belanda</div><div class="site-location"><span class="material-symbols-outlined">location_on</span> Semangga</div></td>
                        <td><div class="pelapor-cell"><span class="user-avatar red">BD</span> Budi D.</div></td>
                        <td><span class="badge badge-ditolak">● Ditolak</span></td>
                        <td><button class="btn btn-outline btn-sm">Catatan</button></td>
                    </tr>
                </tbody>
            </table>
            <div class="pagination" style="padding:16px 22px;">
                <span class="pagination-info">Menampilkan 1-4 dari 24 ajuan</span>
                <div class="pagination-btns">
                    <button class="page-btn"><span class="material-symbols-outlined" style="font-size:16px">chevron_left</span></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn"><span class="material-symbols-outlined" style="font-size:16px">chevron_right</span></button>
                </div>
            </div>
        </div>
    </div>
</div>
