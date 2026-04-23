<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\CagarBudaya;
use App\Models\KategoriBudaya;
use Illuminate\Support\Facades\Storage;



new #[Layout('layouts.admin')] #[Title('Kelola Cagar Budaya')] class extends Component
{
    use WithPagination;
    use WithFileUploads;

    public string $user_id;
    public string $kategori_budaya_id = '';
    public string $nama_cagar_budaya = '';
    public string $deskripsi = '';
    public string $alamat = '';
    public string $latitude = '';
    public string $longitude = '';
    public $thumbnail;
    public string $sk_penetapan = '';
    public string $tahun_penemuan = '';
    public string $status_pelestarian = '';
    public string $status = 'draft';
    public string $search = '';
    public bool $showCreateModal = false;
    public bool $showEditModal = false;
    public bool $showDeleteModal = false;
    public ?string $editId;
    public ?string $deleteId;
    public ?string $deleteName;
    // public $kategoriList = []; 

    
    #[Computed]
    public function kategoriList()
    {
        return KategoriBudaya::select('id', 'nama_kategori')->orderBy('nama_kategori')->get();
    }

   
    #[Computed]
    public function cagarBudaya()
    {
        return CagarBudaya::query()
            ->with(['kategoriBudaya:id,nama_kategori', 'user:id,name']) 
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('nama_cagar_budaya', 'like', "%{$this->search}%")
                      ->orWhere('alamat', 'like', "%{$this->search}%")
                      ->orWhere('tahun_penemuan', 'like', "%{$this->search}%");
                      
                });
            })
            ->latest()
            ->paginate(10);
    }

    // 3. Reset pagination kalau search berubah
    public function updatedSearch()
    {
        $this->resetPage();
    }

    // 4. render() jadi kosong
    public function render()
    {
        return $this->view([
            'title' => 'Kelola Cagar Budaya',
        ]); 
    }

    public function store()
    {
        $validated = $this->validate([
            'nama_cagar_budaya' => 'required|string|max:255',
            'kategori_budaya_id' => 'required|exists:kategori_budayas,id',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'thumbnail' => 'nullable|image|max:5120',
            'sk_penetapan' => 'nullable|string|max:255',
            'tahun_penemuan' => 'nullable|digits:4',
            'status_pelestarian' => 'nullable|string',
            'status' => 'required|in:draft,published',
        ]);

        $imagePath = $this->thumbnail?->store('thumbnails', 'public');

        CagarBudaya::create([
            ...$validated,
            'user_id' => auth()->id(),
            'thumbnail' => $imagePath,
            'latitude' => filled($this->latitude) ? $this->latitude : 0,
            'longitude' => filled($this->longitude) ? $this->longitude : 0,
            'tahun_penemuan' => $this->tahun_penemuan ?: 0,
        ]);

        session()->flash('success', 'Cagar Budaya berhasil ditambahkan.');
        $this->closeCreateModal();
        unset($this->cagarBudaya); // clear cache computed 
    }

    public function update()
        {
            $this->validate([
                'nama_cagar_budaya' => 'required|string|max:255',
                'kategori_budaya_id' => 'required|exists:kategori_budayas,id',
                'deskripsi' => 'nullable|string',
                'alamat' => 'nullable|string',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'thumbnail' => 'nullable|image|max:5120',
                'sk_penetapan' => 'nullable|string|max:255',
                'tahun_penemuan' => 'nullable|digits:4',
                'status_pelestarian' => 'nullable|string',
                'status' => 'required|in:draft,published',
            ]);

            
            $cagar = \App\Models\CagarBudaya::findOrFail($this->editId);

            $thumbnailPath = $cagar->thumbnail;
       
            if ($this->thumbnail) {
          
                $newPath = $this->thumbnail->store('thumbnails', 'public');

                if ($thumbnailPath && Storage::disk('public')->exists($thumbnailPath)) {
                    Storage::disk('public')->delete($thumbnailPath);
                }

                $thumbnailPath = $newPath;
            }

            $cagar->update([
                'kategori_budaya_id' => $this->kategori_budaya_id,
                'nama_cagar_budaya' => $this->nama_cagar_budaya,
                'deskripsi' => $this->deskripsi,
                'alamat' => $this->alamat,
                'latitude' => filled($this->latitude) ? $this->latitude : 0.0000000,
                'longitude' => filled($this->longitude) ? $this->longitude : 0.0000000,
                'thumbnail' => $thumbnailPath,
                'sk_penetapan' => $this->sk_penetapan,
                'tahun_penemuan' => $this->tahun_penemuan ? $this->tahun_penemuan : 0000,
                'status_pelestarian' => $this->status_pelestarian,
                'status' => $this->status,
            ]);

            session()->flash('success', 'Cagar Budaya berhasil diperbarui.');
            $this->resetInput();
            $this->closeEditModal();
            unset($this->cagarBudaya); // clear cache computed
        }

    public function resetInput()
    {
        $this->resetExcept(['search', 'page']); // jangan reset search & page
        $this->status = 'draft';
    }
         
    public function openCreateModal()
    {
        $this->resetInput();
        $this->showCreateModal = true;
    }

    public function closeCreateModal()
    {
        $this->resetInput();
        $this->showCreateModal = false;
        // $this->resetValidation();
    }

    public function openEditModal(string $id)
    {
        $cagar = CagarBudaya::findOrFail($id);
        $this->editId = $cagar->id;
        $this->fill($cagar->only([
            'kategori_budaya_id', 'nama_cagar_budaya', 'deskripsi', 
            'alamat', 'latitude', 'longitude', 'sk_penetapan', 
            'tahun_penemuan', 'status_pelestarian', 'status'
        ]));
        $this->thumbnail = null; // reset upload
        $this->showEditModal = true;
    }

    public function closeEditModal()
    {
        $this->resetInput();
        $this->showEditModal = false;
        // $this->resetValidation();
    }

    public function confirmDelete($id, $name)
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
        $cagar = CagarBudaya::findOrFail($this->deleteId);
        if ($cagar->thumbnail) {
            Storage::disk('public')->delete($cagar->thumbnail);
        }
        $cagar->delete();
        session()->flash('success', 'Cagar Budaya berhasil dihapus.');
        $this->cancelDelete();
        unset($this->cagarBudaya);
    }
};
?>

<div>
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-actions">
            <div>
                <h1>{{ $title }}</h1>
                <p>{{ $title }} untuk klasifikasi situs warisan budaya Tanah Malind.</p>
            </div>
            <button class="btn btn-primary" wire:click="openCreateModal">
                <span class="material-symbols-outlined" style="font-size:18px">add</span>
                Tambah Cagar Budaya
            </button>
        </div>
    </div>

    {{-- Flash Alerts (reusable component) --}}
    <x-admin.flash-alert />

    {{-- List View --}}
    <div class="card">
        <div class="card-header">
            <h3>Daftar Cagar Budaya</h3>
            <div class="search-bar">
                <span class="material-symbols-outlined">search</span>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari cagar budaya..." />
            </div>
        </div>
        <div class="card-body" style="padding:0;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Thumbnail</th>
                        <th>Nama Cagar Budaya</th>
                        <th>Kategori</th>
                        <th>Alamat</th>
                        <th>Latitude-Longitude</th>
                        <th>Deskripsi</th>
                        <th>Dibuat Oleh</th>
                        <th style="width:140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($this->cagarBudaya as $index => $item)
                        <tr>
                            <td style="font-family:monospace; font-size:0.82rem; color:var(--text-muted);">
                                {{ $index + 1 }}
                            </td>
                            <td>
                                @if ($item->thumbnail)
                                    <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->nama_cagar_budaya }}" style="width:50px; height:50px; object-fit:cover;">
                                @else
                                    <span style="font-size:0.82rem; color:var(--text-muted);">—</span>
                                @endif
                            </td>
                            <td>
                                <span
                                    style="font-size:0.82rem; color:var(--text-secondary); display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                    {{ $item->nama_cagar_budaya ?: '—' }}
                                </span>
                            </td>
                            <td>
                                <span
                                    style="font-size:0.82rem; color:var(--text-secondary); display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                    {{ $item->kategoriBudaya->nama_kategori ?: '—' }}
                                </span>
                            </td>
                            <td>
                                <span
                                    style="font-size:0.82rem; color:var(--text-secondary); display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                    {{ $item->alamat ?: '—' }}
                                </span>
                            </td>
                            <td>
                                <span
                                    style="font-size:0.82rem; color:var(--text-secondary); display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                    {{ $item->latitude && $item->longitude ? $item->latitude . ',' . $item->longitude : '—' }}
                                </span>
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
                            <td colspan="12" style="text-align:center; padding:48px 20px;">
                                <div style="display:flex; flex-direction:column; align-items:center; gap:12px;">
                                    <span class="material-symbols-outlined"
                                        style="font-size:48px; color:var(--text-muted); opacity:0.5;">category</span>
                                    <div>
                                        <p
                                            style="margin:0; font-size:0.95rem; font-weight:600; color:var(--text-secondary);">
                                            @if ($search)
                                                Tidak ada cagar budaya yang cocok
                                            @else
                                                Belum ada cagar budaya
                                            @endif
                                        </p>
                                        <p style="margin:4px 0 0; font-size:0.82rem; color:var(--text-muted);">
                                            @if ($search)
                                                Coba ubah kata kunci pencarian Anda.
                                            @else
                                                Klik tombol "Tambah Cagar Budaya" untuk menambahkan cagar budaya baru.
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
            <x-admin.pagination :paginator="$this->cagarBudaya" />
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
                            <h3>Tambah Cagar Budaya Baru</h3>
                            <p>Isi data untuk menambahkan cagar budaya baru.</p>
                        </div>
                    </div>
                    <button class="modal-close-btn" wire:click="closeCreateModal">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <form wire:submit.prevent="store" enctype="multipart/form-data">
                    <div class="modal-body">
                        @include('pages.cagar._form')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" wire:click="closeCreateModal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="material-symbols-outlined" style="font-size:18px">save</span>
                            Simpan Cagar Budaya
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
                            <h3>Edit Cagar Budaya</h3>
                            <p>Perbarui data cagar budaya yang sudah ada.</p>
                        </div>
                    </div>
                    <button class="modal-close-btn" wire:click="closeEditModal">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <form wire:submit="update">
                    <div class="modal-body">
                        @include('pages.cagar._form')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" wire:click="closeEditModal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="material-symbols-outlined" style="font-size:18px">save</span>
                            Perbarui Cagar Budaya
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- modal hapus kategori --}}
    <x-admin.modal-delete :show="$showDeleteModal" :name="$deleteName" title="Hapus Cagar Budaya"
        message="Apakah Anda yakin ingin menghapus cagar budaya ini? Data yang terkait dengan cagar budaya ini mungkin terpengaruh."
        action="delete" cancel="cancelDelete" />
</div>