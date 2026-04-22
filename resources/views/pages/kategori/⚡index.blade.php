<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\KategoriBudaya;

new #[Layout('layouts.admin', ['title' => 'Kelola Kategori Budaya'])] class extends Component {
    use WithPagination;

    public string $user_id;
    public string $nama_kategori = '';
    public string $icon_marker = '';
    public string $warna_badge = '';
    public string $deskripsi = '';
    public ?string $editId = null;
    public bool $showCreateModal = false;
    public bool $showEditModal = false;
    public bool $showDeleteModal = false;
    public ?string $deleteId = null;
    public string $deleteName = '';
    public string $search = '';

    public function mount(): void
    {
        $this->resetForm();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    // public function rendering($view): void
    // {
    //     $query = KategoriBudaya::query();

    //     if ($this->search) {
    //         $query->where('nama_kategori', 'like', '%' . $this->search . '%');
    //     }

    //     $view->with('kategori', $query->orderBy('nama_kategori')->paginate(1));
    // }

    public function render()
    {
        $query = \App\Models\KategoriBudaya::query();

        if ($this->search) {
            $query->where('nama_kategori', 'like', '%' . $this->search . '%');
        }

        return $this->view([
            'kategori' => $query->with('user')->orderBy('nama_kategori')->paginate(1),
        ]);
    }

    // Create
    public function openCreateModal(): void
    {
        $this->resetForm();
        $this->showCreateModal = true;
    }

    public function closeCreateModal(): void
    {
        $this->resetForm();
        $this->showCreateModal = false;
    }

    public function store(): void
    {
        $this->validate([
            'nama_kategori' => 'required|string|max:255',
            'icon_marker' => 'nullable|string|max:255',
            'warna_badge' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
        ]);

        // KategoriBudaya::create([
        //     'nama_kategori' => $this->nama_kategori,
        //     'icon_marker' => $this->icon_marker,
        //     'warna_badge' => $this->warna_badge,
        //     'deskripsi' => $this->deskripsi,
        // ]);

         auth()->user()->kategori_budaya()->create([
            'nama_kategori' => $this->nama_kategori,
            'icon_marker' => $this->icon_marker,
            'warna_badge' => $this->warna_badge,
            'deskripsi' => $this->deskripsi,
        ]);

        session()->flash('message', 'Kategori budaya berhasil ditambahkan.');
        $this->closeCreateModal();
    }

    // Edit
    public function openEditModal(string $id): void
    {
        $kategori = KategoriBudaya::findOrFail($id);
        $this->editId = $kategori->id;
        $this->nama_kategori = $kategori->nama_kategori;
        $this->icon_marker = $kategori->icon_marker ?? '';
        $this->warna_badge = $kategori->warna_badge ?? '';
        $this->deskripsi = $kategori->deskripsi ?? '';
        $this->showEditModal = true;
    }

    public function closeEditModal(): void
    {
        $this->resetForm();
        $this->showEditModal = false;
    }

    public function update(): void
    {
        $this->validate([
            'nama_kategori' => 'required|string|max:255',
            'icon_marker' => 'nullable|string|max:255',
            'warna_badge' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori = KategoriBudaya::findOrFail($this->editId);
        $kategori->update([
            'nama_kategori' => $this->nama_kategori,
            'icon_marker' => $this->icon_marker,
            'warna_badge' => $this->warna_badge,
            'deskripsi' => $this->deskripsi,
        ]);

        session()->flash('message', 'Kategori budaya berhasil diperbarui.');
        $this->closeEditModal();
    }

    // Delete
    public function confirmDelete(string $id, string $name): void
    {
        $this->deleteId = $id;
        $this->deleteName = $name;
        $this->showDeleteModal = true;
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->deleteId = null;
        $this->deleteName = '';
    }

    public function delete(): void
    {
        KategoriBudaya::findOrFail($this->deleteId)->delete();
        session()->flash('message', 'Kategori budaya berhasil dihapus.');
        $this->cancelDelete();
    }

    // Helpers
    private function resetForm(): void
    {
        $this->editId = null;
        $this->nama_kategori = '';
        $this->icon_marker = '';
        $this->warna_badge = '';
        $this->deskripsi = '';
        $this->resetValidation();
    }
};
?>

<div>
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-actions">
            <div>
                <h1>Kelola Kategori Budaya</h1>
                <p>Manajemen kategori untuk klasifikasi situs warisan budaya Tanah Malind.</p>
            </div>
            <button class="btn btn-primary" wire:click="openCreateModal">
                <span class="material-symbols-outlined" style="font-size:18px">add</span>
                Tambah Kategori
            </button>
        </div>
    </div>

    {{-- Flash Alerts (reusable component) --}}
    <x-admin.flash-alert />

    {{-- List View --}}
    <div class="card">
        <div class="card-header">
            <h3>Daftar Kategori Budaya</h3>
            <div class="search-bar">
                <span class="material-symbols-outlined">search</span>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari kategori..." />
            </div>
        </div>
        <div class="card-body" style="padding:0;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Nama Kategori</th>
                        <th>Icon Marker</th>
                        <th>Warna Badge</th>
                        <th>Deskripsi</th>
                        <th>Dibuat Oleh</th>
                        <th style="width:140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategori as $index => $item)
                        <tr>
                            <td style="font-family:monospace; font-size:0.82rem; color:var(--text-muted);">
                                {{ $index + 1 }}
                            </td>
                            <td>
                                <span class="site-name">{{ $item->nama_kategori }}</span>
                            </td>
                            <td>
                                @if ($item->icon_marker)
                                    <div style="display:flex; align-items:center; gap:8px;">
                                        <span class="material-symbols-outlined"
                                            style="font-size:20px; color:var(--jungle-mid);">{{ $item->icon_marker }}</span>
                                        <span
                                            style="font-size:0.78rem; color:var(--text-muted);">{{ $item->icon_marker }}</span>
                                    </div>
                                @else
                                    <span style="font-size:0.82rem; color:var(--text-muted);">—</span>
                                @endif
                            </td>
                            <td>
                                @if ($item->warna_badge)
                                    <div style="display:flex; align-items:center; gap:8px;">
                                        <span
                                            style="
                                            width:24px;
                                            height:24px;
                                            border-radius:6px;
                                            background:{{ $item->warna_badge }};
                                            display:inline-block;
                                            border:1px solid rgba(0,0,0,0.1);
                                            flex-shrink:0;"></span>
                                        <span class="badge"
                                            style="background:{{ $item->warna_badge }}20; color:{{ $item->warna_badge }}">
                                            {{ $item->warna_badge }}
                                        </span>
                                    </div>
                                @else
                                    <span style="font-size:0.82rem; color:var(--text-muted);">—</span>
                                @endif
                            </td>
                            <td>
                                <span
                                    style="font-size:0.82rem; color:var(--text-secondary); display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                    {{ $item->deskripsi ?: '—' }}
                                </span>
                            </td>
                             <td>
                                <span
                                    style="font-size:0.82rem; color:var(--text-secondary); display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                    {{ $item->user->name ?? '—' }}
                                </span>
                            </td>
                            <td>
                                <div style="display:flex; gap:6px;">
                                    <button class="btn btn-outline btn-sm"
                                        wire:click="openEditModal('{{ $item->id }}')">
                                        <span class="material-symbols-outlined" style="font-size:14px">edit</span>
                                        Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm"
                                        wire:click="confirmDelete('{{ $item->id }}', '{{ $item->nama_kategori }}')">
                                        <span class="material-symbols-outlined" style="font-size:14px">delete</span>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; padding:48px 20px;">
                                <div style="display:flex; flex-direction:column; align-items:center; gap:12px;">
                                    <span class="material-symbols-outlined"
                                        style="font-size:48px; color:var(--text-muted); opacity:0.5;">category</span>
                                    <div>
                                        <p
                                            style="margin:0; font-size:0.95rem; font-weight:600; color:var(--text-secondary);">
                                            @if ($search)
                                                Tidak ada kategori yang cocok
                                            @else
                                                Belum ada kategori budaya
                                            @endif
                                        </p>
                                        <p style="margin:4px 0 0; font-size:0.82rem; color:var(--text-muted);">
                                            @if ($search)
                                                Coba ubah kata kunci pencarian Anda.
                                            @else
                                                Klik tombol "Tambah Kategori" untuk menambahkan kategori baru.
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
            <x-admin.pagination :paginator="$kategori" />
        </div>
    </div>

    {{-- modal tambah kategori --}}
    @if ($showCreateModal)
        <div class="modal-overlay" wire:click.self="closeCreateModal">
            <div class="modal-container">
                <div class="modal-header">
                    <div class="modal-header-info">
                        <div class="modal-icon green">
                            <span class="material-symbols-outlined">add_circle</span>
                        </div>
                        <div>
                            <h3>Tambah Kategori Baru</h3>
                            <p>Isi data untuk menambahkan kategori budaya baru.</p>
                        </div>
                    </div>
                    <button class="modal-close-btn" wire:click="closeCreateModal">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <form wire:submit="store">
                    <div class="modal-body">
                        @include('pages.kategori._form')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" wire:click="closeCreateModal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="material-symbols-outlined" style="font-size:18px">save</span>
                            Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- modal edit kategori --}}
    @if ($showEditModal)
        <div class="modal-overlay" wire:click.self="closeEditModal">
            <div class="modal-container">
                <div class="modal-header">
                    <div class="modal-header-info">
                        <div class="modal-icon gold">
                            <span class="material-symbols-outlined">edit_note</span>
                        </div>
                        <div>
                            <h3>Edit Kategori</h3>
                            <p>Perbarui data kategori budaya yang sudah ada.</p>
                        </div>
                    </div>
                    <button class="modal-close-btn" wire:click="closeEditModal">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <form wire:submit="update">
                    <div class="modal-body">
                        @include('pages.kategori._form')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" wire:click="closeEditModal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="material-symbols-outlined" style="font-size:18px">save</span>
                            Perbarui Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- modal hapus kategori --}}
    <x-admin.modal-delete :show="$showDeleteModal" :name="$deleteName" title="Hapus Kategori Budaya"
        message="Apakah Anda yakin ingin menghapus kategori ini? Data yang terkait dengan kategori ini mungkin terpengaruh."
        action="delete" cancel="cancelDelete" />
</div>
