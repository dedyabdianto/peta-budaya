<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new
#[Layout('layouts.admin', ['title' => 'Kelola Berita'])]
class extends Component {
    //
};
?>

<div>
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
                            <td><div style="display:flex;gap:6px;"><button class="btn btn-outline btn-sm">Edit</button><button class="btn btn-danger btn-sm">Hapus</button></div></td>
                        </tr>
                        <tr>
                            <td><span class="site-name">Penemuan Artefak Baru di Kawasan Hutan Ndalir</span></td>
                            <td>Admin User</td>
                            <td style="font-size:0.82rem;color:var(--text-muted);">10 Okt 2024</td>
                            <td><span class="badge badge-disetujui">Publish</span></td>
                            <td><div style="display:flex;gap:6px;"><button class="btn btn-outline btn-sm">Edit</button><button class="btn btn-danger btn-sm">Hapus</button></div></td>
                        </tr>
                        <tr>
                            <td><span class="site-name">Upaya Pelestarian Rumah Adat Gotad di Distrik Anim Ha</span></td>
                            <td>Editor Tim</td>
                            <td style="font-size:0.82rem;color:var(--text-muted);">08 Okt 2024</td>
                            <td><span class="badge badge-menunggu">Draft</span></td>
                            <td><div style="display:flex;gap:6px;"><button class="btn btn-outline btn-sm">Edit</button><button class="btn btn-danger btn-sm">Hapus</button></div></td>
                        </tr>
                        <tr>
                            <td><span class="site-name">Pameran Tenun Serat Kayu: Warisan Perempuan Malind</span></td>
                            <td>Admin User</td>
                            <td style="font-size:0.82rem;color:var(--text-muted);">05 Okt 2024</td>
                            <td><span class="badge badge-disetujui">Publish</span></td>
                            <td><div style="display:flex;gap:6px;"><button class="btn btn-outline btn-sm">Edit</button><button class="btn btn-danger btn-sm">Hapus</button></div></td>
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
                    <span class="material-symbols-outlined" style="font-size:16px">close</span> Batal
                </button>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div>
                        <div class="form-group"><label>Judul Artikel</label><input type="text" placeholder="Masukkan judul berita..." /></div>
                        <div class="form-group"><label>Kategori Berita</label><select><option value="">Pilih Kategori</option><option>Budaya</option><option>Sejarah</option><option>Event</option><option>Konservasi</option><option>Wisata</option></select></div>
                    </div>
                    <div>
                        <div class="form-group"><label>Tanggal Publikasi</label><input type="date" /></div>
                        <div class="form-group"><label>Upload Thumbnail</label><div class="upload-zone" style="padding:20px;"><span class="material-symbols-outlined" style="font-size:28px">image</span><p>Seret gambar thumbnail di sini</p></div></div>
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
</div>
