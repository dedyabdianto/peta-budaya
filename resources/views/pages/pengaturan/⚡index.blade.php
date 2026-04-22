<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new
#[Layout('layouts.admin', ['title' => 'Pengaturan'])]
class extends Component {
    //
};
?>

<div>
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
</div>
