<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new
#[Layout('layouts.admin', ['title' => 'Katalog Warisan'])]
class extends Component {
    //
};
?>

<div>
    <div class="page-header">
        <div class="page-header-actions">
            <div>
                <h1>Katalog Warisan</h1>
                <p>Kelola daftar situs, cagar budaya, dan destinasi wisata Tanah Malind.</p>
            </div>
            <button class="btn btn-primary" id="btn-add-wisata">
                <span class="material-symbols-outlined" style="font-size:18px">add</span>
                Tambah Wisata/Situs
            </button>
        </div>
    </div>

    <div id="wisata-list-view">
        <div class="card">
            <div class="card-header">
                <div class="filter-tabs">
                    <button class="filter-tab active">Semua <span class="count">142</span></button>
                    <button class="filter-tab">Budaya</button>
                    <button class="filter-tab">Alam</button>
                    <button class="filter-tab">Sejarah</button>
                </div>
                <div class="search-bar">
                    <span class="material-symbols-outlined">search</span>
                    <input type="text" placeholder="Cari situs..." />
                </div>
            </div>
            <div class="card-body" style="padding:0;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Nama Wisata</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img class="site-thumb" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBuT1iZ27SJFj3WIfCLGjLQ3YA-keDLC0cTQ-CjAKV4fX5VNwL6RMib6cLIf7d1_jdRmIqDDqjG3GV9-2ajI9NS_XxwJLAB2JQ08JzO3u6sJpNq-Ihke5-ndpy7-DKfx6BDEjNWTIDCPXlhQebs5pPkAMhmver3RSA6oxz6YSBdYYDLYgbsQUiWL_KyQTRhHZXMq_QIKWhTyyuteg_ahQA9AZF1LDQ6JlSwUOyeAERR_p8wdH1kryz5cWzHAi9Itgln6gTcb0Q2ka4" alt="Pantai Payum" /></td>
                            <td><div class="site-name">Pantai Payum</div><div class="site-location"><span class="material-symbols-outlined">location_on</span> Merauke</div></td>
                            <td><span class="badge badge-alam">Alam</span></td>
                            <td><span class="status-dot aktif">Aktif</span></td>
                            <td><div style="display:flex;gap:6px;"><button class="btn btn-outline btn-sm">Edit</button><button class="btn btn-danger btn-sm">Hapus</button></div></td>
                        </tr>
                        <tr>
                            <td><img class="site-thumb" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDly0jbkN2KbqyEXVIdZeBTbWDy5XK3Wlkxk65wwmkYpTAr-tpOHd0TmUBTm0jhkQmoXnkcRfXDhdFEAQPeLoBRjY9rLu9rEVARZ5WwE7sJgA0hbArB5jYJQ5nknl0AU-hhQvGwqDb5Y7Eosj2xeLSX_FCikdW9uCR8efioScbH_20IwCNLcH79rUFoU5aGvLvcuWGPl_MbBsDfcVgIkbbyPbF4C_VY8KYGRsSJjBUBo56rowWQ6ajxB-gCdbG3mSmYG8yBMXOs9Qs" alt="Tugu Pepera" /></td>
                            <td><div class="site-name">Tugu Pepera</div><div class="site-location"><span class="material-symbols-outlined">location_on</span> Merauke</div></td>
                            <td><span class="badge badge-sejarah">Sejarah</span></td>
                            <td><span class="status-dot aktif">Aktif</span></td>
                            <td><div style="display:flex;gap:6px;"><button class="btn btn-outline btn-sm">Edit</button><button class="btn btn-danger btn-sm">Hapus</button></div></td>
                        </tr>
                        <tr>
                            <td><div class="site-thumb-placeholder"><span class="material-symbols-outlined" style="font-size:20px">image</span></div></td>
                            <td><div class="site-name">Rumah Semut Musamus</div><div class="site-location"><span class="material-symbols-outlined">location_on</span> Wasur</div></td>
                            <td><span class="badge badge-budaya">Budaya</span></td>
                            <td><span class="status-dot draft">Draft</span></td>
                            <td><div style="display:flex;gap:6px;"><button class="btn btn-outline btn-sm">Edit</button><button class="btn btn-danger btn-sm">Hapus</button></div></td>
                        </tr>
                        <tr>
                            <td><img class="site-thumb" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBqwDvOKwfGSgbhMp_k0bXUNSQjqcQpUhnHjtOOsxiQqUfcQDx0H7uYruixdouxFt5wzT-6pNQlnBppXbNds1pwpbKIkPVi9bC1YKusC0vHfnhZhWaPjszx06HDajiAXCQcT867-zhm9kJgPPKOhlfuBxzZNxHC_6LtbIWThpzNQN0JEtLddHLsYe5l-TPYnX7d0H8wHAO3TXRvDifHTxYXo22JFc9jSsAOZ_Xc51r5sDfmxjC7Iw4VT5m3uwLr5fpaxS1-_SVyc4Q" alt="Balai Adat" /></td>
                            <td><div class="site-name">Balai Adat Mbe</div><div class="site-location"><span class="material-symbols-outlined">location_on</span> Okaba</div></td>
                            <td><span class="badge badge-budaya">Budaya</span></td>
                            <td><span class="status-dot aktif">Aktif</span></td>
                            <td><div style="display:flex;gap:6px;"><button class="btn btn-outline btn-sm">Edit</button><button class="btn btn-danger btn-sm">Hapus</button></div></td>
                        </tr>
                    </tbody>
                </table>
                <div class="pagination" style="padding:16px 22px;">
                    <span class="pagination-info">Menampilkan 1-4 dari 142 situs</span>
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

    <div id="wisata-form-view" style="display:none;">
        <div class="card" style="margin-bottom:20px;">
            <div class="card-header">
                <h3>Tambah Wisata / Situs Baru</h3>
                <button class="btn btn-outline btn-sm" id="cancel-wisata-form">
                    <span class="material-symbols-outlined" style="font-size:16px">close</span> Batal
                </button>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div>
                        <div class="form-group"><label>Nama Situs</label><input type="text" placeholder="Masukkan nama situs atau wisata" /></div>
                        <div class="form-group"><label>Kategori</label><select><option value="">Pilih Kategori</option><option>Alam</option><option>Budaya</option><option>Sejarah</option><option>Sakral</option><option>Kriya</option></select></div>
                        <div class="form-group"><label>Fasilitas</label><div class="checkbox-list"><label class="check-item"><input type="checkbox" /> Parkir</label><label class="check-item"><input type="checkbox" /> Toilet</label><label class="check-item"><input type="checkbox" /> Musala</label><label class="check-item"><input type="checkbox" /> Restoran</label><label class="check-item"><input type="checkbox" /> Pemandu</label><label class="check-item"><input type="checkbox" /> Aksesibilitas</label></div></div>
                        <div class="form-group"><label>Jam Operasional</label><input type="text" placeholder="Contoh: 08:00 - 17:00 WIT" /></div>
                        <div class="form-group"><label>Deskripsi Lengkap</label><textarea rows="5" placeholder="Tulis deskripsi detail tentang situs ini..."></textarea></div>
                    </div>
                    <div>
                        <div class="form-group"><label>Upload Foto Utama</label><div class="upload-zone"><span class="material-symbols-outlined">cloud_upload</span><h4>Seret &amp; Lepaskan Foto</h4><p>atau klik untuk memilih file (JPG, PNG, WebP)</p></div></div>
                        <div class="form-group"><label>Koordinat GIS</label><div class="mini-map" style="height:200px;margin-bottom:12px;"><img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBq9sJQASx9w4rwxwEZ59GBAT7Be_qnqGHL5dyik_JlgP9JS7lEpn8pfATuvJlQXpR1Yzjcq3gehFnnxlrJAdG02J2A3NS8tZN3UVaW7N4gLfM559m7-h4CJ54H7oFTZ7C44Hj615GMZQt5c4C8p4znwrXC-S_f-cjfVvG6TItIuh-szPwEKQ3PrvuauRigpKyVS_oiGunTvLkcKggbF6o0bq5erpbF9kjGwqk4MW8qL3nnJKHovOGnLeCS9M5iDuoF7gxP93LDVC0" alt="Mini Map Pin" /></div><div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;"><div class="form-group" style="margin-bottom:0;"><label>Latitude</label><input type="text" placeholder="-8.XXXX" /></div><div class="form-group" style="margin-bottom:0;"><label>Longitude</label><input type="text" placeholder="140.XXXX" /></div></div></div>
                        <div style="display:flex;gap:10px;margin-top:24px;"><button class="btn btn-primary" style="flex:1;"><span class="material-symbols-outlined" style="font-size:18px">save</span> Simpan Situs</button><button class="btn btn-outline">Draft</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
