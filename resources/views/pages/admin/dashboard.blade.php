<x-layouts::admin :title="__('Dashboard')">

    {{-- ============================================================ --}}
    {{-- PAGE 1: DASHBOARD OVERVIEW --}}
    {{-- ============================================================ --}}
    <section id="page-dashboard" class="page-section active">
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
    </section>

    {{-- ============================================================ --}}
    {{-- PAGE 2: KELOLA PETA & GIS --}}
    {{-- ============================================================ --}}
    <section id="page-peta" class="page-section">
        <div class="page-header">
            <h1>Kelola Peta & GIS</h1>
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
    </section>

    {{-- ============================================================ --}}
    {{-- PAGE 3: KELOLA DAFTAR WISATA & WARISAN --}}
    {{-- ============================================================ --}}
    <section id="page-warisan" class="page-section">
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

        {{-- List View --}}
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
                                <td>
                                    <img class="site-thumb" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBuT1iZ27SJFj3WIfCLGjLQ3YA-keDLC0cTQ-CjAKV4fX5VNwL6RMib6cLIf7d1_jdRmIqDDqjG3GV9-2ajI9NS_XxwJLAB2JQ08JzO3u6sJpNq-Ihke5-ndpy7-DKfx6BDEjNWTIDCPXlhQebs5pPkAMhmver3RSA6oxz6YSBdYYDLYgbsQUiWL_KyQTRhHZXMq_QIKWhTyyuteg_ahQA9AZF1LDQ6JlSwUOyeAERR_p8wdH1kryz5cWzHAi9Itgln6gTcb0Q2ka4" alt="Pantai Payum" />
                                </td>
                                <td>
                                    <div class="site-name">Pantai Payum</div>
                                    <div class="site-location">
                                        <span class="material-symbols-outlined">location_on</span>
                                        Merauke
                                    </div>
                                </td>
                                <td><span class="badge badge-alam">Alam</span></td>
                                <td><span class="status-dot aktif">Aktif</span></td>
                                <td>
                                    <div style="display:flex;gap:6px;">
                                        <button class="btn btn-outline btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img class="site-thumb" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDly0jbkN2KbqyEXVIdZeBTbWDy5XK3Wlkxk65wwmkYpTAr-tpOHd0TmUBTm0jhkQmoXnkcRfXDhdFEAQPeLoBRjY9rLu9rEVARZ5WwE7sJgA0hbArB5jYJQ5nknl0AU-hhQvGwqDb5Y7Eosj2xeLSX_FCikdW9uCR8efioScbH_20IwCNLcH79rUFoU5aGvLvcuWGPl_MbBsDfcVgIkbbyPbF4C_VY8KYGRsSJjBUBo56rowWQ6ajxB-gCdbG3mSmYG8yBMXOs9Qs" alt="Tugu Pepera" />
                                </td>
                                <td>
                                    <div class="site-name">Tugu Pepera</div>
                                    <div class="site-location">
                                        <span class="material-symbols-outlined">location_on</span>
                                        Merauke
                                    </div>
                                </td>
                                <td><span class="badge badge-sejarah">Sejarah</span></td>
                                <td><span class="status-dot aktif">Aktif</span></td>
                                <td>
                                    <div style="display:flex;gap:6px;">
                                        <button class="btn btn-outline btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="site-thumb-placeholder">
                                        <span class="material-symbols-outlined" style="font-size:20px">image</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="site-name">Rumah Semut Musamus</div>
                                    <div class="site-location">
                                        <span class="material-symbols-outlined">location_on</span>
                                        Wasur
                                    </div>
                                </td>
                                <td><span class="badge badge-budaya">Budaya</span></td>
                                <td><span class="status-dot draft">Draft</span></td>
                                <td>
                                    <div style="display:flex;gap:6px;">
                                        <button class="btn btn-outline btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img class="site-thumb" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBqwDvOKwfGSgbhMp_k0bXUNSQjqcQpUhnHjtOOsxiQqUfcQDx0H7uYruixdouxFt5wzT-6pNQlnBppXbNds1pwpbKIkPVi9bC1YKusC0vHfnhZhWaPjszx06HDajiAXCQcT867-zhm9kJgPPKOhlfuBxzZNxHC_6LtbIWThpzNQN0JEtLddHLsYe5l-TPYnX7d0H8wHAO3TXRvDifHTxYXo22JFc9jSsAOZ_Xc51r5sDfmxjC7Iw4VT5m3uwLr5fpaxS1-_SVyc4Q" alt="Balai Adat" />
                                </td>
                                <td>
                                    <div class="site-name">Balai Adat Mbe</div>
                                    <div class="site-location">
                                        <span class="material-symbols-outlined">location_on</span>
                                        Okaba
                                    </div>
                                </td>
                                <td><span class="badge badge-budaya">Budaya</span></td>
                                <td><span class="status-dot aktif">Aktif</span></td>
                                <td>
                                    <div style="display:flex;gap:6px;">
                                        <button class="btn btn-outline btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
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

        {{-- Add/Edit Form View --}}
        <div id="wisata-form-view" style="display:none;">
            <div class="card" style="margin-bottom:20px;">
                <div class="card-header">
                    <h3>Tambah Wisata / Situs Baru</h3>
                    <button class="btn btn-outline btn-sm" id="cancel-wisata-form">
                        <span class="material-symbols-outlined" style="font-size:16px">close</span>
                        Batal
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        {{-- Left Column --}}
                        <div>
                            <div class="form-group">
                                <label>Nama Situs</label>
                                <input type="text" placeholder="Masukkan nama situs atau wisata" />
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <select>
                                    <option value="">Pilih Kategori</option>
                                    <option>Alam</option>
                                    <option>Budaya</option>
                                    <option>Sejarah</option>
                                    <option>Sakral</option>
                                    <option>Kriya</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Fasilitas</label>
                                <div class="checkbox-list">
                                    <label class="check-item"><input type="checkbox" /> Parkir</label>
                                    <label class="check-item"><input type="checkbox" /> Toilet</label>
                                    <label class="check-item"><input type="checkbox" /> Musala</label>
                                    <label class="check-item"><input type="checkbox" /> Restoran</label>
                                    <label class="check-item"><input type="checkbox" /> Pemandu</label>
                                    <label class="check-item"><input type="checkbox" /> Aksesibilitas</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jam Operasional</label>
                                <input type="text" placeholder="Contoh: 08:00 - 17:00 WIT" />
                            </div>
                            <div class="form-group">
                                <label>Deskripsi Lengkap</label>
                                <textarea rows="5" placeholder="Tulis deskripsi detail tentang situs ini..."></textarea>
                            </div>
                        </div>

                        {{-- Right Column --}}
                        <div>
                            <div class="form-group">
                                <label>Upload Foto Utama</label>
                                <div class="upload-zone">
                                    <span class="material-symbols-outlined">cloud_upload</span>
                                    <h4>Seret & Lepaskan Foto</h4>
                                    <p>atau klik untuk memilih file (JPG, PNG, WebP)</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Koordinat GIS</label>
                                <div class="mini-map" style="height:200px;margin-bottom:12px;">
                                    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBq9sJQASx9w4rwxwEZ59GBAT7Be_qnqGHL5dyik_JlgP9JS7lEpn8pfATuvJlQXpR1Yzjcq3gehFnnxlrJAdG02J2A3NS8tZN3UVaW7N4gLfM559m7-h4CJ54H7oFTZ7C44Hj615GMZQt5c4C8p4znwrXC-S_f-cjfVvG6TItIuh-szPwEKQ3PrvuauRigpKyVS_oiGunTvLkcKggbF6o0bq5erpbF9kjGwqk4MW8qL3nnJKHovOGnLeCS9M5iDuoF7gxP93LDVC0" alt="Mini Map Pin" />
                                </div>
                                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                                    <div class="form-group" style="margin-bottom:0;">
                                        <label>Latitude</label>
                                        <input type="text" placeholder="-8.XXXX" />
                                    </div>
                                    <div class="form-group" style="margin-bottom:0;">
                                        <label>Longitude</label>
                                        <input type="text" placeholder="140.XXXX" />
                                    </div>
                                </div>
                            </div>
                            <div style="display:flex;gap:10px;margin-top:24px;">
                                <button class="btn btn-primary" style="flex:1;">
                                    <span class="material-symbols-outlined" style="font-size:18px">save</span>
                                    Simpan Situs
                                </button>
                                <button class="btn btn-outline">Draft</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- PAGE 4: KELOLA GALERI --}}
    {{-- ============================================================ --}}
    <section id="page-galeri" class="page-section">
        <div class="page-header">
            <div class="page-header-actions">
                <div>
                    <h1>Kelola Galeri</h1>
                    <p>Manajemen media foto dan dokumentasi warisan budaya.</p>
                </div>
                <button class="btn btn-primary">
                    <span class="material-symbols-outlined" style="font-size:18px">cloud_upload</span>
                    Upload Media Baru
                </button>
            </div>
        </div>

        {{-- Upload Area --}}
        <div class="card" style="margin-bottom:24px;">
            <div class="card-body">
                <div class="upload-zone" style="padding:50px 20px;">
                    <span class="material-symbols-outlined" style="font-size:48px">add_photo_alternate</span>
                    <h4>Seret & Lepaskan Media di Sini</h4>
                    <p>Atau klik untuk memilih file — mendukung beberapa file sekaligus (JPG, PNG, WebP, MP4)</p>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:16px;">
                    <div class="form-group" style="margin-bottom:0;">
                        <label>Judul Foto</label>
                        <input type="text" placeholder="Masukkan judul media" />
                    </div>
                    <div class="form-group" style="margin-bottom:0;">
                        <label>Tautkan ke Situs/Wisata</label>
                        <select>
                            <option value="">Pilih situs terkait...</option>
                            <option>Pantai Payum</option>
                            <option>Tugu Pepera</option>
                            <option>Rumah Adat Gotad</option>
                            <option>Hutan Sakral Ndalir</option>
                            <option>Balai Adat Mbe</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Media Grid --}}
        <div class="media-grid">
            <div class="media-card">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBuT1iZ27SJFj3WIfCLGjLQ3YA-keDLC0cTQ-CjAKV4fX5VNwL6RMib6cLIf7d1_jdRmIqDDqjG3GV9-2ajI9NS_XxwJLAB2JQ08JzO3u6sJpNq-Ihke5-ndpy7-DKfx6BDEjNWTIDCPXlhQebs5pPkAMhmver3RSA6oxz6YSBdYYDLYgbsQUiWL_KyQTRhHZXMq_QIKWhTyyuteg_ahQA9AZF1LDQ6JlSwUOyeAERR_p8wdH1kryz5cWzHAi9Itgln6gTcb0Q2ka4" alt="Ukiran Malind" />
                <button class="media-card-delete"><span class="material-symbols-outlined" style="font-size:16px">delete</span></button>
                <div class="media-card-info">
                    <h5>Ukiran Kayu Tradisional</h5>
                    <p>Pantai Payum</p>
                </div>
            </div>
            <div class="media-card">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDly0jbkN2KbqyEXVIdZeBTbWDy5XK3Wlkxk65wwmkYpTAr-tpOHd0TmUBTm0jhkQmoXnkcRfXDhdFEAQPeLoBRjY9rLu9rEVARZ5WwE7sJgA0hbArB5jYJQ5nknl0AU-hhQvGwqDb5Y7Eosj2xeLSX_FCikdW9uCR8efioScbH_20IwCNLcH79rUFoU5aGvLvcuWGPl_MbBsDfcVgIkbbyPbF4C_VY8KYGRsSJjBUBo56rowWQ6ajxB-gCdbG3mSmYG8yBMXOs9Qs" alt="Gua Batu" />
                <button class="media-card-delete"><span class="material-symbols-outlined" style="font-size:16px">delete</span></button>
                <div class="media-card-info">
                    <h5>Situs Batu Ukir Sangas</h5>
                    <p>Kimaam</p>
                </div>
            </div>
            <div class="media-card">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBqwDvOKwfGSgbhMp_k0bXUNSQjqcQpUhnHjtOOsxiQqUfcQDx0H7uYruixdouxFt5wzT-6pNQlnBppXbNds1pwpbKIkPVi9bC1YKusC0vHfnhZhWaPjszx06HDajiAXCQcT867-zhm9kJgPPKOhlfuBxzZNxHC_6LtbIWThpzNQN0JEtLddHLsYe5l-TPYnX7d0H8wHAO3TXRvDifHTxYXo22JFc9jSsAOZ_Xc51r5sDfmxjC7Iw4VT5m3uwLr5fpaxS1-_SVyc4Q" alt="Kampung Tradisional" />
                <button class="media-card-delete"><span class="material-symbols-outlined" style="font-size:16px">delete</span></button>
                <div class="media-card-info">
                    <h5>Kampung Tradisional Malind</h5>
                    <p>Okaba</p>
                </div>
            </div>
            <div class="media-card">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAIe3If60CbOCRGXX3qG6i1UNTs1NcC6Oi572Eb2cJsD3aHhXWtUEWL62WYtv1VKDxjchLmfWsJrbI4tTwE7hUZLHoM22esZ0-1mT_JpyrruTBcpz1Q0x-MbbhM3VbP7I13U29dFR5v3mnRdOlbi7bGqiX9ORjtLja3qnPesku463OR-iZQKqeXN9oucym9fuCuA_uurPrSaUpszoGUxV0_FM6DZ40u_Pq0CRvPuFdckOHHtBCZu_Ra-z8NNQRtJOOVUzgNPVXCzX4" alt="Hiasan Kepala" />
                <button class="media-card-delete"><span class="material-symbols-outlined" style="font-size:16px">delete</span></button>
                <div class="media-card-info">
                    <h5>Hiasan Kepala Upacara</h5>
                    <p>Muting</p>
                </div>
            </div>
            <div class="media-card">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCkRZhgxBDNyV-Wcjk6JaZpCrBRlpieLBaoMmKrAKCy4LT4IgFMZSZ8qLpr0GLWwHHRWA6aMreaNsThZj4Gkgh6Zih2B_3oAlxsmNvuMKkekv6carjjTPzz9Nvtx0YetxfUmRpVJAvbn9EoH8Ra7vMHi4R9RPx8vZU2IWncvxR2ItWIV7Gw9WpaM63C6Lj5oQDOGqMV6B3Z_4Z-4cZpE_MmTNhar8qD5hSqmWT-vYPyl7pyVmKLkwMdsIpdqAmHg-ZzgJjAnU3YQJs" alt="Hutan Sakral" />
                <button class="media-card-delete"><span class="material-symbols-outlined" style="font-size:16px">delete</span></button>
                <div class="media-card-info">
                    <h5>Panorama Hutan Sakral</h5>
                    <p>Ilwayab</p>
                </div>
            </div>
            <div class="media-card">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBfVnmt2KinwZWLvIVasSlV1VdZdYFBd2FSHmuvrvZpWdjql8c3vGVHlpYyM0-eE3MTxgTqFh0qSaDv71DLDh9uEDZ9ZoUlN4ktzjv7BZyZqH2CCTvDf_9wCZ_dTCFlHvnFolSFQRQf4RKJjCR9pD8FSiFFw-gidYyQWna72CLcSARmOr3tzYkTbcZxTEKt8OCrYt6li6KZV0SzOia_v6_iEM3uh4eNZfjtseCnESYGz7ykN63CKCQgfun-ulUByWi9-7T7n9EAenc" alt="Cerita Api" />
                <button class="media-card-delete"><span class="material-symbols-outlined" style="font-size:16px">delete</span></button>
                <div class="media-card-info">
                    <h5>Tradisi Lisan Malam Hari</h5>
                    <p>Merauke</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- PAGE 5: KELOLA BERITA --}}
    {{-- ============================================================ --}}
    <section id="page-berita" class="page-section">
        <div class="page-header">
            <div class="page-header-actions">
                <div>
                    <h1>Kelola Berita</h1>
                    <p>Buat, edit, dan publikasikan artikel berita seputar warisan budaya.</p>
                </div>
                <button class="btn btn-primary" id="btn-add-berita">
                    <span class="material-symbols-outlined" style="font-size:18px">edit_note</span>
                    Tulis Berita Baru
                </button>
            </div>
        </div>

        {{-- List View --}}
        <div id="berita-list-view">
            <div class="card">
                <div class="card-body" style="padding:0;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Judul Berita</th>
                                <th>Penulis</th>
                                <th>Tanggal Publish</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="site-name">Festival Budaya Malind 2024: Merajut Identitas Adat</span></td>
                                <td>Admin User</td>
                                <td style="font-size:0.82rem;color:var(--text-muted);">12 Okt 2024</td>
                                <td><span class="badge badge-disetujui">Publish</span></td>
                                <td>
                                    <div style="display:flex;gap:6px;">
                                        <button class="btn btn-outline btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="site-name">Penemuan Artefak Baru di Kawasan Hutan Ndalir</span></td>
                                <td>Admin User</td>
                                <td style="font-size:0.82rem;color:var(--text-muted);">10 Okt 2024</td>
                                <td><span class="badge badge-disetujui">Publish</span></td>
                                <td>
                                    <div style="display:flex;gap:6px;">
                                        <button class="btn btn-outline btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="site-name">Upaya Pelestarian Rumah Adat Gotad di Distrik Anim Ha</span></td>
                                <td>Editor Tim</td>
                                <td style="font-size:0.82rem;color:var(--text-muted);">08 Okt 2024</td>
                                <td><span class="badge badge-menunggu">Draft</span></td>
                                <td>
                                    <div style="display:flex;gap:6px;">
                                        <button class="btn btn-outline btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="site-name">Pameran Tenun Serat Kayu: Warisan Perempuan Malind</span></td>
                                <td>Admin User</td>
                                <td style="font-size:0.82rem;color:var(--text-muted);">05 Okt 2024</td>
                                <td><span class="badge badge-disetujui">Publish</span></td>
                                <td>
                                    <div style="display:flex;gap:6px;">
                                        <button class="btn btn-outline btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="pagination" style="padding:16px 22px;">
                        <span class="pagination-info">Menampilkan 1-4 dari 87 berita</span>
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

        {{-- Add/Edit Form View --}}
        <div id="berita-form-view" style="display:none;">
            <div class="card">
                <div class="card-header">
                    <h3>Tulis Berita Baru</h3>
                    <button class="btn btn-outline btn-sm" id="cancel-berita-form">
                        <span class="material-symbols-outlined" style="font-size:16px">close</span>
                        Batal
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div>
                            <div class="form-group">
                                <label>Judul Artikel</label>
                                <input type="text" placeholder="Masukkan judul berita..." />
                            </div>
                            <div class="form-group">
                                <label>Kategori Berita</label>
                                <select>
                                    <option value="">Pilih Kategori</option>
                                    <option>Budaya</option>
                                    <option>Sejarah</option>
                                    <option>Event</option>
                                    <option>Konservasi</option>
                                    <option>Wisata</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                                <label>Tanggal Publikasi</label>
                                <input type="date" />
                            </div>
                            <div class="form-group">
                                <label>Upload Thumbnail</label>
                                <div class="upload-zone" style="padding:20px;">
                                    <span class="material-symbols-outlined" style="font-size:28px">image</span>
                                    <p>Seret gambar thumbnail di sini</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top:8px;">
                        <label>Konten Artikel</label>
                        <div style="border:1px solid var(--border-light);border-radius:12px;overflow:hidden;">
                            <div class="editor-toolbar">
                                <button data-cmd="bold" title="Bold"><b>B</b></button>
                                <button data-cmd="italic" title="Italic"><i>I</i></button>
                                <button data-cmd="underline" title="Underline"><u>U</u></button>
                                <div class="editor-sep"></div>
                                <button data-cmd="insertUnorderedList" title="Bullet List"><span class="material-symbols-outlined" style="font-size:18px">format_list_bulleted</span></button>
                                <button data-cmd="insertOrderedList" title="Numbered List"><span class="material-symbols-outlined" style="font-size:18px">format_list_numbered</span></button>
                                <div class="editor-sep"></div>
                                <button title="Insert Link"><span class="material-symbols-outlined" style="font-size:18px">link</span></button>
                                <button title="Insert Image"><span class="material-symbols-outlined" style="font-size:18px">image</span></button>
                                <div class="editor-sep"></div>
                                <button data-cmd="formatBlock" title="Heading"><span class="material-symbols-outlined" style="font-size:18px">title</span></button>
                                <button title="Quote"><span class="material-symbols-outlined" style="font-size:18px">format_quote</span></button>
                            </div>
                            <div class="editor-content" contenteditable="true">
                                <p>Mulai menulis konten artikel di sini...</p>
                            </div>
                        </div>
                    </div>

                    <div style="display:flex;gap:10px;margin-top:20px;justify-content:flex-end;">
                        <button class="btn btn-outline">Simpan sebagai Draft</button>
                        <button class="btn btn-primary">
                            <span class="material-symbols-outlined" style="font-size:18px">publish</span>
                            Publikasikan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- PAGE 6: VERIFIKASI LAPORAN --}}
    {{-- ============================================================ --}}
    <section id="page-verifikasi" class="page-section">
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
                            <td>
                                <div class="site-name">Situs Batu Ukir Wapeko</div>
                                <div class="site-location">
                                    <span class="material-symbols-outlined">location_on</span>
                                    Kurik, Merauke
                                </div>
                            </td>
                            <td>
                                <div class="pelapor-cell">
                                    <span class="user-avatar green">AK</span>
                                    Ahmad K.
                                </div>
                            </td>
                            <td><span class="badge badge-menunggu">● Menunggu</span></td>
                            <td><button class="btn btn-primary btn-sm">Review</button></td>
                        </tr>
                        <tr>
                            <td style="font-family:monospace;font-size:0.78rem;color:var(--text-muted);">#MLD-2024-088</td>
                            <td style="font-size:0.82rem;">11 Okt 2024</td>
                            <td>
                                <div class="site-name">Pohon Sakral Kampung Salor</div>
                                <div class="site-location">
                                    <span class="material-symbols-outlined">location_on</span>
                                    Salor, Merauke
                                </div>
                            </td>
                            <td>
                                <div class="pelapor-cell">
                                    <span class="user-avatar gold">YM</span>
                                    Yoseph M.
                                </div>
                            </td>
                            <td><span class="badge badge-menunggu">● Menunggu</span></td>
                            <td><button class="btn btn-primary btn-sm">Review</button></td>
                        </tr>
                        <tr>
                            <td style="font-family:monospace;font-size:0.78rem;color:var(--text-muted);">#MLD-2024-085</td>
                            <td style="font-size:0.82rem;">09 Okt 2024</td>
                            <td>
                                <div class="site-name">Artefak Gerabah Wasur</div>
                                <div class="site-location">
                                    <span class="material-symbols-outlined">location_on</span>
                                    Wasur, Merauke
                                </div>
                            </td>
                            <td>
                                <div class="pelapor-cell">
                                    <span class="user-avatar brown">SN</span>
                                    Siti N.
                                </div>
                            </td>
                            <td><span class="badge badge-disetujui">● Disetujui</span></td>
                            <td><button class="btn btn-outline btn-sm">Lihat</button></td>
                        </tr>
                        <tr>
                            <td style="font-family:monospace;font-size:0.78rem;color:var(--text-muted);">#MLD-2024-082</td>
                            <td style="font-size:0.82rem;">05 Okt 2024</td>
                            <td>
                                <div class="site-name">Bekas Pemukiman Belanda</div>
                                <div class="site-location">
                                    <span class="material-symbols-outlined">location_on</span>
                                    Semangga
                                </div>
                            </td>
                            <td>
                                <div class="pelapor-cell">
                                    <span class="user-avatar red">BD</span>
                                    Budi D.
                                </div>
                            </td>
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
    </section>

    {{-- ============================================================ --}}
    {{-- PAGE 7: PENGATURAN --}}
    {{-- ============================================================ --}}
    <section id="page-pengaturan" class="page-section">
        <div class="page-header">
            <h1>Pengaturan</h1>
            <p>Konfigurasi akun administrator dan preferensi sistem.</p>
        </div>

        <div class="form-row">
            <div class="card">
                <div class="card-header"><h3>Pengaturan Profil</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" value="Admin User" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" value="admin@warisan-malind.id" />
                    </div>
                    <div class="form-group">
                        <label>Peran</label>
                        <select>
                            <option selected>Administrator</option>
                            <option>Editor</option>
                            <option>Viewer</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" style="margin-top:8px;">
                        <span class="material-symbols-outlined" style="font-size:18px">save</span>
                        Simpan Perubahan
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h3>Keamanan</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Password Lama</label>
                        <input type="password" placeholder="••••••••" />
                    </div>
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" placeholder="Minimal 8 karakter" />
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" placeholder="Ulangi password baru" />
                    </div>
                    <button class="btn btn-primary" style="margin-top:8px;">
                        <span class="material-symbols-outlined" style="font-size:18px">lock</span>
                        Ubah Password
                    </button>
                </div>
            </div>
        </div>

        {{-- Logout Button --}}
        <div style="margin-top:32px;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger" style="padding:12px 24px;">
                    <span class="material-symbols-outlined" style="font-size:18px">logout</span>
                    Keluar dari Akun
                </button>
            </form>
        </div>
    </section>

</x-layouts::admin>
