<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Berita;
use App\Models\KategoriBerita;

new #[Layout('layouts.admin')] #[Title('Kelola Berita')] class extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterStatus = '';
    public string $filterKategori = '';

    // Delete
    public bool $showDeleteModal = false;
    public ?string $deleteId = null;
    public ?string $deleteName = null;

    #[Computed]
    public function beritaList()
    {
        return Berita::query()
            ->with(['user:id,name', 'kategoriBerita:id,nama_kategori,warna'])
            ->when($this->search, fn ($q) => $q->where(function ($q) {
                $q->where('judul', 'like', "%{$this->search}%")
                  ->orWhere('excerpt', 'like', "%{$this->search}%");
            }))
            ->when($this->filterStatus, fn ($q) => $q->where('status', $this->filterStatus))
            ->when($this->filterKategori, fn ($q) => $q->where('kategori_berita_id', $this->filterKategori))
            ->latest()
            ->paginate(10);
    }

    #[Computed]
    public function kategoriList()
    {
        return KategoriBerita::orderBy('nama_kategori')->get();
    }

    #[Computed]
    public function stats()
    {
        return [
            'total' => Berita::count(),
            'published' => Berita::where('status', 'published')->count(),
            'draft' => Berita::where('status', 'draft')->count(),
            'scheduled' => Berita::where('status', 'scheduled')->count(),
        ];
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterStatus()
    {
        $this->resetPage();
    }

    public function updatedFilterKategori()
    {
        $this->resetPage();
    }

    public function confirmDelete(string $id, string $name)
    {
        $this->deleteId = $id;
        $this->deleteName = $name;
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->deleteId = null;
        $this->deleteName = null;
        $this->showDeleteModal = false;
    }

    public function delete()
    {
        $berita = Berita::findOrFail($this->deleteId);

        if ($berita->thumbnail && \Illuminate\Support\Facades\Storage::disk('public')->exists($berita->thumbnail)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($berita->thumbnail);
        }

        $berita->delete();
        session()->flash('success', 'Berita berhasil dihapus.');
        $this->cancelDelete();
        unset($this->beritaList, $this->stats);
    }

    public function toggleFeatured(string $id)
    {
        $berita = Berita::findOrFail($id);
        $berita->update(['is_featured' => ! $berita->is_featured]);
        unset($this->beritaList);
    }

    public function render()
    {
        return $this->view(['title' => 'Kelola Berita']);
    }
};
?>

<div>
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-actions">
            <div>
                <h1>{{ $title }}</h1>
                <p>Buat, edit, dan publikasikan artikel berita seputar warisan budaya.</p>
            </div>
            <a href="{{ route('berita.create') }}" wire:navigate class="btn btn-primary">
                <span class="material-symbols-outlined" style="font-size:18px">edit_note</span>
                Tulis Berita Baru
            </a>
        </div>
    </div>

    <x-admin.flash-alert />

    {{-- Data Table --}}
    <div class="card">
        <div class="card-header">
            <h3>Daftar Berita</h3>
            <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                <select wire:model.live="filterStatus" class="berita-filter-select">
                    <option value="">Semua Status</option>
                    <option value="published">Published ({{ $this->stats['published'] }})</option>
                    <option value="draft">Draft ({{ $this->stats['draft'] }})</option>
                    <option value="scheduled">Scheduled ({{ $this->stats['scheduled'] }})</option>
                </select>
                <select wire:model.live="filterKategori" class="berita-filter-select">
                    <option value="">Semua Kategori</option>
                    @foreach($this->kategoriList as $kat)
                        <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                    @endforeach
                </select>
                <div class="search-bar">
                    <span class="material-symbols-outlined">search</span>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari berita..." />
                </div>
            </div>
        </div>
        <div class="card-body" style="padding:0;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width:44px;">No</th>
                        <th style="width:70px;">Thumbnail</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th style="width:70px;">Views</th>
                        <th style="width:140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($this->beritaList as $index => $berita)
                        <tr wire:key="berita-{{ $berita->id }}">
                            {{-- No --}}
                            <td style="font-family:monospace; font-size:0.82rem; color:var(--text-muted);">
                                {{ $this->beritaList->firstItem() + $index }}
                            </td>

                            {{-- Thumbnail --}}
                            <td>
                                @if($berita->thumbnail)
                                    <img src="{{ asset('storage/' . $berita->thumbnail) }}" alt="{{ $berita->judul }}"
                                         style="width:50px; height:38px; object-fit:cover; border-radius:6px;" />
                                @else
                                    <span style="font-size:0.82rem; color:var(--text-muted);">—</span>
                                @endif
                            </td>

                            {{-- Judul --}}
                            <td>
                                <div style="display:flex;align-items:center;gap:4px;">
                                    @if($berita->is_featured)
                                        <span class="material-symbols-outlined" style="font-size:14px;font-variation-settings:'FILL' 1;color:#D4AF37;" title="Unggulan">star</span>
                                    @endif
                                    <span style="font-size:0.82rem; font-weight:600; color:var(--text-primary); display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                        {{ $berita->judul }}
                                    </span>
                                </div>
                            </td>

                            {{-- Kategori --}}
                            <td>
                                @if($berita->kategoriBerita)
                                    <span class="berita-list-kategori" style="--kat-color: {{ $berita->kategoriBerita->warna }}">
                                        {{ $berita->kategoriBerita->nama_kategori }}
                                    </span>
                                @else
                                    <span style="font-size:0.82rem; color:var(--text-muted);">—</span>
                                @endif
                            </td>

                            {{-- Penulis --}}
                            <td>
                                <span style="font-size:0.82rem; color:var(--text-secondary);">
                                    {{ $berita->user?->name ?? '—' }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td>
                                @if($berita->status === 'published')
                                    <span class="badge badge-disetujui">Published</span>
                                @elseif($berita->status === 'draft')
                                    <span class="badge badge-menunggu">Draft</span>
                                @else
                                    <span class="badge" style="background:#FEF3C7;color:#92400E;font-size:0.7rem;">
                                        Scheduled
                                    </span>
                                @endif
                            </td>

                            {{-- Tanggal --}}
                            <td>
                                <span style="font-size:0.78rem; color:var(--text-muted);">
                                    {{ $berita->published_at?->format('d M Y') ?? $berita->created_at->format('d M Y') }}
                                </span>
                            </td>

                            {{-- Views --}}
                            <td>
                                <span style="font-size:0.82rem; color:var(--text-muted);">
                                    {{ number_format($berita->views_count) }}
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td>
                                <div style="display:flex; gap:6px;">
                                    <a href="{{ route('berita.edit', $berita) }}" wire:navigate class="btn btn-outline btn-sm">
                                        <span class="material-symbols-outlined" style="font-size:14px">edit</span>
                                        Edit
                                    </a>
                                    <button class="btn btn-danger btn-sm"
                                        wire:click="confirmDelete('{{ $berita->id }}', '{{ addslashes($berita->judul) }}')">
                                        <span class="material-symbols-outlined" style="font-size:14px">delete</span>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align:center; padding:48px 20px;">
                                <div style="display:flex; flex-direction:column; align-items:center; gap:12px;">
                                    <span class="material-symbols-outlined"
                                        style="font-size:48px; color:var(--text-muted); opacity:0.5;">newspaper</span>
                                    <div>
                                        <p style="margin:0; font-size:0.95rem; font-weight:600; color:var(--text-secondary);">
                                            @if($search || $filterStatus || $filterKategori)
                                                Tidak ada berita yang cocok
                                            @else
                                                Belum ada berita
                                            @endif
                                        </p>
                                        <p style="margin:4px 0 0; font-size:0.82rem; color:var(--text-muted);">
                                            @if($search || $filterStatus || $filterKategori)
                                                Coba ubah filter pencarian Anda.
                                            @else
                                                Klik tombol "Tulis Berita Baru" untuk membuat artikel pertama.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <x-admin.pagination :paginator="$this->beritaList" />
        </div>
    </div>

    {{-- Delete Modal --}}
    <x-admin.modal-delete :show="$showDeleteModal" :name="$deleteName" title="Hapus Berita"
        message="Apakah Anda yakin ingin menghapus berita ini? Artikel akan dihapus permanen."
        action="delete" cancel="cancelDelete" />
</div>
