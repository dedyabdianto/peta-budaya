<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use App\Models\Laporan;
use Illuminate\Support\Facades\Storage;

new #[Layout('layouts.admin')] #[Title('Verifikasi Laporan')] class extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterStatus = '';

    // Review modal
    public bool $showReviewModal = false;
    public ?string $reviewId = null;
    public ?Laporan $reviewLaporan = null;
    public string $catatan_admin = '';

    // Delete
    public bool $showDeleteModal = false;
    public ?string $deleteId = null;
    public string $deleteName = '';

    #[Computed]
    public function laporanList()
    {
        return Laporan::query()
            ->with('fotos')
            ->when($this->search, fn ($q) => $q->where(function ($q) {
                $q->where('nama_situs', 'like', "%{$this->search}%")
                  ->orWhere('nama_pelapor', 'like', "%{$this->search}%")
                  ->orWhere('lokasi', 'like', "%{$this->search}%");
            }))
            ->when($this->filterStatus, fn ($q) => $q->where('status', $this->filterStatus))
            ->latest()
            ->paginate(10);
    }

    #[Computed]
    public function stats(): array
    {
        return [
            'menunggu' => Laporan::menunggu()->count(),
            'disetujui' => Laporan::disetujui()->count(),
            'ditolak' => Laporan::ditolak()->count(),
            'total' => Laporan::count(),
        ];
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
    }

    public function setFilter(string $status): void
    {
        $this->filterStatus = $this->filterStatus === $status ? '' : $status;
        $this->resetPage();
    }

    public function openReview(string $id): void
    {
        $this->reviewLaporan = Laporan::with('fotos', 'reviewedBy')->findOrFail($id);
        $this->reviewId = $id;
        $this->catatan_admin = $this->reviewLaporan->catatan_admin ?? '';
        $this->showReviewModal = true;
    }

    public function closeReview(): void
    {
        $this->showReviewModal = false;
        $this->reviewId = null;
        $this->reviewLaporan = null;
        $this->catatan_admin = '';
    }

    public function approve(): void
    {
        $laporan = Laporan::findOrFail($this->reviewId);
        $laporan->update([
            'status' => 'disetujui',
            'catatan_admin' => $this->catatan_admin ?: null,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        session()->flash('success', "Laporan \"{$laporan->nama_situs}\" berhasil disetujui.");
        $this->closeReview();
        unset($this->laporanList, $this->stats);
    }

    public function reject(): void
    {
        $this->validate([
            'catatan_admin' => 'required|string|max:2000',
        ], [
            'catatan_admin.required' => 'Catatan wajib diisi saat menolak laporan.',
        ]);

        $laporan = Laporan::findOrFail($this->reviewId);
        $laporan->update([
            'status' => 'ditolak',
            'catatan_admin' => $this->catatan_admin,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        session()->flash('success', "Laporan \"{$laporan->nama_situs}\" telah ditolak.");
        $this->closeReview();
        unset($this->laporanList, $this->stats);
    }

    public function confirmDelete(string $id, string $name): void
    {
        $this->deleteId = $id;
        $this->deleteName = $name;
        $this->showDeleteModal = true;
    }

    public function cancelDelete(): void
    {
        $this->deleteId = null;
        $this->deleteName = '';
        $this->showDeleteModal = false;
    }

    public function delete(): void
    {
        $laporan = Laporan::with('fotos')->findOrFail($this->deleteId);

        foreach ($laporan->fotos as $foto) {
            if ($foto->file_path && Storage::disk('public')->exists($foto->file_path)) {
                Storage::disk('public')->delete($foto->file_path);
            }
        }

        $laporan->delete();
        session()->flash('success', 'Laporan berhasil dihapus.');
        $this->cancelDelete();
        unset($this->laporanList, $this->stats);
    }


    public function render()
    {
        return $this->view(['title' => 'Verifikasi Laporan']);
    }
};
?>

<div>
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-actions">
            <div>
                <h1>Verifikasi Laporan</h1>
                <p>Tinjau dan validasi kiriman publik terkait situs warisan dan penemuan budaya baru.</p>
            </div>
            <div style="display:flex;gap:8px;">
                <a href="{{ route('verifikasi.export-csv', ['status' => $filterStatus, 'search' => $search]) }}" class="btn btn-outline">
                    <span class="material-symbols-outlined" style="font-size:16px">download</span>
                    Export CSV
                </a>
            </div>
        </div>
    </div>

    <x-admin.flash-alert />

    {{-- Stat Cards --}}
    <div class="stat-grid" style="grid-template-columns:repeat(3,1fr);margin-bottom:28px;">
        <div class="stat-card" style="background:linear-gradient(135deg,rgba(26,54,45,0.06),rgba(26,54,45,0.02));cursor:pointer;"
             wire:click="setFilter('menunggu')">
            <div class="stat-icon gold">
                <span class="material-symbols-outlined">pending_actions</span>
            </div>
            <div class="stat-info">
                <h3>Menunggu Tinjauan</h3>
                <div class="stat-number">{{ $this->stats['menunggu'] }}</div>
                <span class="stat-sub">Perlu ditinjau</span>
            </div>
        </div>
        <div class="stat-card" style="background:linear-gradient(135deg,rgba(16,185,129,0.06),rgba(16,185,129,0.02));cursor:pointer;"
             wire:click="setFilter('disetujui')">
            <div class="stat-icon green">
                <span class="material-symbols-outlined">check_circle</span>
            </div>
            <div class="stat-info">
                <h3>Disetujui</h3>
                <div class="stat-number">{{ $this->stats['disetujui'] }}</div>
                <span class="stat-sub">Laporan valid</span>
            </div>
        </div>
        <div class="stat-card" style="background:linear-gradient(135deg,rgba(239,68,68,0.06),rgba(239,68,68,0.02));cursor:pointer;"
             wire:click="setFilter('ditolak')">
            <div class="stat-icon red">
                <span class="material-symbols-outlined">cancel</span>
            </div>
            <div class="stat-info">
                <h3>Ditolak / Arsip</h3>
                <div class="stat-number">{{ $this->stats['ditolak'] }}</div>
                <span class="stat-sub">Tidak valid</span>
            </div>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="card">
        <div class="card-header">
            <div class="filter-tabs">
                <button class="filter-tab {{ $filterStatus === '' ? 'active' : '' }}" wire:click="setFilter('')">
                    Semua <span class="count">{{ $this->stats['total'] }}</span>
                </button>
                <button class="filter-tab {{ $filterStatus === 'menunggu' ? 'active' : '' }}" wire:click="setFilter('menunggu')">
                    Menunggu <span class="count">{{ $this->stats['menunggu'] }}</span>
                </button>
                <button class="filter-tab {{ $filterStatus === 'disetujui' ? 'active' : '' }}" wire:click="setFilter('disetujui')">
                    Disetujui <span class="count">{{ $this->stats['disetujui'] }}</span>
                </button>
                <button class="filter-tab {{ $filterStatus === 'ditolak' ? 'active' : '' }}" wire:click="setFilter('ditolak')">
                    Ditolak <span class="count">{{ $this->stats['ditolak'] }}</span>
                </button>
            </div>
            <div class="search-bar">
                <span class="material-symbols-outlined">search</span>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari laporan..." />
            </div>
        </div>
        <div class="card-body" style="padding:0;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Situs Ajuan</th>
                        <th>Pelapor</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($this->laporanList as $laporan)
                        <tr wire:key="laporan-{{ $laporan->id }}">
                            <td style="font-size:0.82rem;">{{ $laporan->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="site-name">{{ $laporan->nama_situs }}</div>
                                @if($laporan->lokasi)
                                    <div class="site-location">
                                        <span class="material-symbols-outlined">location_on</span>
                                        {{ $laporan->lokasi }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="pelapor-cell">
                                    <span class="user-avatar green">{{ strtoupper(substr($laporan->nama_pelapor, 0, 2)) }}</span>
                                    {{ Str::limit($laporan->nama_pelapor, 15) }}
                                </div>
                            </td>
                            <td>
                                <span style="font-size:0.82rem;color:var(--text-muted);">
                                    {{ $laporan->fotos_count ?? $laporan->fotos->count() }} foto
                                </span>
                            </td>
                            <td>
                                @if($laporan->status === 'menunggu')
                                    <span class="badge badge-menunggu">● Menunggu</span>
                                @elseif($laporan->status === 'disetujui')
                                    <span class="badge badge-disetujui">● Disetujui</span>
                                @else
                                    <span class="badge badge-ditolak">● Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <div style="display:flex;gap:6px;">
                                    <button type="button" class="btn btn-primary btn-sm" wire:click="openReview('{{ $laporan->id }}')">
                                        {{ $laporan->status === 'menunggu' ? 'Review' : 'Lihat' }}
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" wire:click="confirmDelete('{{ $laporan->id }}', '{{ addslashes($laporan->nama_situs) }}')">
                                        <span class="material-symbols-outlined" style="font-size:14px">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;padding:40px 20px;color:var(--text-muted);">
                                <span class="material-symbols-outlined" style="font-size:48px;opacity:0.3;display:block;margin-bottom:8px;">inbox</span>
                                @if($search || $filterStatus)
                                    Tidak ada laporan yang cocok dengan filter.
                                @else
                                    Belum ada laporan masuk.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            @if($this->laporanList->hasPages())
                <div style="padding:16px 22px;">
                    <x-admin.pagination :paginator="$this->laporanList" />
                </div>
            @endif
        </div>
    </div>

    {{-- Review Modal --}}
    @if($showReviewModal && $reviewLaporan)
        <div class="modal-overlay" wire:click.self="closeReview">
            <div class="modal-container" style="max-width:640px;">
                <div class="modal-header">
                    <div class="modal-header-info">
                        <div class="modal-icon gold">
                            <span class="material-symbols-outlined">fact_check</span>
                        </div>
                        <div>
                            <h3>Review Laporan</h3>
                            <p>Tinjau detail laporan situs dari masyarakat.</p>
                        </div>
                    </div>
                    <button type="button" class="modal-close-btn" wire:click="closeReview">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height:60vh;overflow-y:auto;">
                    {{-- Status Badge --}}
                    <div style="margin-bottom:16px;">
                        @if($reviewLaporan->status === 'menunggu')
                            <span class="badge badge-menunggu">● Menunggu Review</span>
                        @elseif($reviewLaporan->status === 'disetujui')
                            <span class="badge badge-disetujui">● Disetujui</span>
                        @else
                            <span class="badge badge-ditolak">● Ditolak</span>
                        @endif
                        <span style="font-size:0.75rem;color:var(--text-muted);margin-left:8px;">
                            Dikirim {{ $reviewLaporan->created_at->diffForHumans() }}
                        </span>
                    </div>

                    {{-- Reporter Info --}}
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:20px;">
                        <div>
                            <label style="font-size:0.7rem;text-transform:uppercase;letter-spacing:0.05em;color:var(--text-muted);font-weight:600;">Pelapor</label>
                            <p style="font-weight:600;margin:2px 0 0;">{{ $reviewLaporan->nama_pelapor }}</p>
                        </div>
                        <div>
                            <label style="font-size:0.7rem;text-transform:uppercase;letter-spacing:0.05em;color:var(--text-muted);font-weight:600;">Kontak</label>
                            <p style="margin:2px 0 0;">{{ $reviewLaporan->kontak ?: '-' }}</p>
                        </div>
                    </div>

                    {{-- Site Info --}}
                    <div style="background:var(--bg-main);border-radius:10px;padding:16px;margin-bottom:16px;">
                        <h4 style="font-size:1.05rem;font-weight:700;margin:0 0 8px;">{{ $reviewLaporan->nama_situs }}</h4>
                        @if($reviewLaporan->lokasi)
                            <div style="display:flex;align-items:center;gap:4px;font-size:0.82rem;color:var(--text-muted);margin-bottom:6px;">
                                <span class="material-symbols-outlined" style="font-size:14px;">location_on</span>
                                {{ $reviewLaporan->lokasi }}
                            </div>
                        @endif
                        @if($reviewLaporan->latitude && $reviewLaporan->longitude)
                            <div style="display:flex;align-items:center;gap:4px;font-size:0.78rem;color:var(--text-muted);font-family:monospace;">
                                <span class="material-symbols-outlined" style="font-size:14px;">explore</span>
                                {{ $reviewLaporan->latitude }}, {{ $reviewLaporan->longitude }}
                            </div>
                        @endif
                    </div>

                    {{-- Description --}}
                    @if($reviewLaporan->deskripsi)
                        <div style="margin-bottom:16px;">
                            <label style="font-size:0.7rem;text-transform:uppercase;letter-spacing:0.05em;color:var(--text-muted);font-weight:600;">Deskripsi</label>
                            <p style="margin:4px 0 0;font-size:0.88rem;line-height:1.6;color:var(--text-secondary);">{{ $reviewLaporan->deskripsi }}</p>
                        </div>
                    @endif

                    {{-- Photos --}}
                    @if($reviewLaporan->fotos->count() > 0)
                        <div style="margin-bottom:16px;">
                            <label style="font-size:0.7rem;text-transform:uppercase;letter-spacing:0.05em;color:var(--text-muted);font-weight:600;margin-bottom:8px;display:block;">
                                Dokumentasi ({{ $reviewLaporan->fotos->count() }} foto)
                            </label>
                            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:8px;">
                                @foreach($reviewLaporan->fotos as $foto)
                                    <a href="{{ asset('storage/' . $foto->file_path) }}" target="_blank"
                                       style="aspect-ratio:1;border-radius:8px;overflow:hidden;display:block;">
                                        <img src="{{ asset('storage/' . $foto->file_path) }}" alt="Foto Laporan"
                                             style="width:100%;height:100%;object-fit:cover;" loading="lazy" />
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Previous Review Info --}}
                    @if($reviewLaporan->reviewed_at && $reviewLaporan->reviewedBy)
                        <div style="background:rgba(0,0,0,0.03);border-radius:8px;padding:12px;margin-bottom:16px;font-size:0.82rem;">
                            <span style="color:var(--text-muted);">Direview oleh</span>
                            <strong>{{ $reviewLaporan->reviewedBy->name }}</strong>
                            <span style="color:var(--text-muted);">pada {{ $reviewLaporan->reviewed_at->format('d M Y, H:i') }}</span>
                        </div>
                    @endif

                    {{-- Admin Notes --}}
                    @if($reviewLaporan->status === 'menunggu')
                        <div class="form-group" style="margin-bottom:0;">
                            <label>Catatan Admin <span style="font-weight:400;color:var(--text-muted);">(wajib jika menolak)</span></label>
                            <textarea wire:model="catatan_admin" rows="3" placeholder="Tuliskan catatan atau alasan keputusan..."></textarea>
                            @error('catatan_admin') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                    @elseif($reviewLaporan->catatan_admin)
                        <div style="margin-bottom:0;">
                            <label style="font-size:0.7rem;text-transform:uppercase;letter-spacing:0.05em;color:var(--text-muted);font-weight:600;">Catatan Admin</label>
                            <p style="margin:4px 0 0;font-size:0.88rem;color:var(--text-secondary);background:var(--bg-main);padding:10px 14px;border-radius:8px;">
                                {{ $reviewLaporan->catatan_admin }}
                            </p>
                        </div>
                    @endif
                </div>

                <div class="modal-footer">
                    @if($reviewLaporan->status === 'menunggu')
                        <button type="button" class="btn btn-outline" wire:click="closeReview">Batal</button>
                        <button type="button" class="btn btn-danger-solid" wire:click="reject"
                            wire:loading.attr="disabled" wire:target="reject">
                            <span class="material-symbols-outlined" style="font-size:16px">close</span>
                            Tolak
                        </button>
                        <button type="button" class="btn btn-primary" wire:click="approve"
                            wire:loading.attr="disabled" wire:target="approve">
                            <span class="material-symbols-outlined" style="font-size:16px">check</span>
                            Setujui
                        </button>
                    @else
                        <button type="button" class="btn btn-outline" wire:click="closeReview">Tutup</button>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- Delete Modal --}}
    <x-admin.modal-delete :show="$showDeleteModal" :name="$deleteName" title="Hapus Laporan"
        message="Apakah Anda yakin ingin menghapus laporan ini? Semua foto terkait akan dihapus permanen."
        action="delete" cancel="cancelDelete" />
</div>
