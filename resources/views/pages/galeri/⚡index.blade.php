<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Galeri;
use App\Models\CagarBudaya;
use Illuminate\Support\Facades\Storage;

new #[Layout('layouts.admin')] #[Title('Kelola Galeri')] class extends Component
{
    use WithPagination;
    use WithFileUploads;

    public string $search = '';
    public string $filterSitus = '';

    // Upload
    public array $uploadFiles = [];
    public string $uploadJudul = '';
    public ?string $uploadSitusId = null;
    public bool $isUploading = false;
    public array $uploadResults = [];

    // Edit
    public bool $showEditModal = false;
    public ?string $editId = null;
    public string $editJudul = '';
    public ?string $editSitusId = null;

    // Delete
    public bool $showDeleteModal = false;
    public ?string $deleteId = null;
    public ?string $deleteName = null;

    // Lightbox
    public bool $showLightbox = false;
    public ?string $lightboxUrl = null;
    public ?string $lightboxTitle = null;

    #[Computed]
    public function galeriList()
    {
        return Galeri::query()
            ->with(['cagarBudaya:id,nama_cagar_budaya', 'user:id,name'])
            ->when($this->search, fn ($q) => $q->where('judul', 'like', "%{$this->search}%"))
            ->when($this->filterSitus, fn ($q) => $q->where('cagar_budaya_id', $this->filterSitus))
            ->latest()
            ->paginate(24);
    }

    #[Computed]
    public function siteOptions()
    {
        return CagarBudaya::select('id', 'nama_cagar_budaya')
            ->orderBy('nama_cagar_budaya')
            ->get();
    }

    #[Computed]
    public function stats()
    {
        $total = Galeri::count();
        $images = Galeri::where('file_type', 'image')->count();
        $totalSize = Galeri::sum('file_size');

        return [
            'total' => $total,
            'images' => $images,
            'size' => $this->formatBytes($totalSize),
        ];
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterSitus()
    {
        $this->resetPage();
    }

    public function uploadMedia()
    {
        $this->validate([
            'uploadFiles' => 'required|array|min:1',
            'uploadFiles.*' => 'file|mimes:jpg,jpeg,png,webp,gif,mp4,mov|max:20480',
            'uploadJudul' => 'nullable|string|max:255',
        ]);

        $this->isUploading = true;
        $this->uploadResults = [];
        $count = 0;

        foreach ($this->uploadFiles as $file) {
            $isVideo = in_array($file->getMimeType(), ['video/mp4', 'video/quicktime']);
            $fileType = $isVideo ? 'video' : 'image';

            $path = $file->store('galeri', 'public');

            $judul = $this->uploadJudul ?: pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            if (count($this->uploadFiles) > 1 && ! $this->uploadJudul) {
                $judul = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            }

            Galeri::create([
                'user_id' => auth()->id(),
                'cagar_budaya_id' => $this->uploadSitusId ?: null,
                'judul' => $judul,
                'file_path' => $path,
                'file_type' => $fileType,
                'file_size' => $file->getSize(),
            ]);

            $this->uploadResults[] = [
                'name' => $file->getClientOriginalName(),
                'status' => 'success',
            ];
            $count++;
        }

        $this->isUploading = false;
        $this->uploadFiles = [];
        $this->uploadJudul = '';
        $this->uploadSitusId = null;

        session()->flash('success', "{$count} media berhasil diupload.");
        unset($this->galeriList, $this->stats);

        $this->dispatch('galeri-uploaded');
    }

    public function openEdit(string $id)
    {
        $galeri = Galeri::findOrFail($id);
        $this->editId = $galeri->id;
        $this->editJudul = $galeri->judul;
        $this->editSitusId = $galeri->cagar_budaya_id;
        $this->showEditModal = true;
    }

    public function updateMedia()
    {
        $this->validate([
            'editJudul' => 'required|string|max:255',
        ]);

        $galeri = Galeri::findOrFail($this->editId);
        $galeri->update([
            'judul' => $this->editJudul,
            'cagar_budaya_id' => $this->editSitusId ?: null,
        ]);

        session()->flash('success', 'Media berhasil diperbarui.');
        $this->closeEdit();
        unset($this->galeriList);
    }

    public function closeEdit()
    {
        $this->editId = null;
        $this->editJudul = '';
        $this->editSitusId = null;
        $this->showEditModal = false;
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
        $galeri = Galeri::findOrFail($this->deleteId);
        if ($galeri->file_path && Storage::disk('public')->exists($galeri->file_path)) {
            Storage::disk('public')->delete($galeri->file_path);
        }
        $galeri->delete();
        session()->flash('success', 'Media berhasil dihapus.');
        $this->cancelDelete();
        unset($this->galeriList, $this->stats);
    }

    public function openLightbox(string $id)
    {
        $galeri = Galeri::findOrFail($id);
        $this->lightboxUrl = asset('storage/'.$galeri->file_path);
        $this->lightboxTitle = $galeri->judul;
        $this->showLightbox = true;
    }

    public function closeLightbox()
    {
        $this->showLightbox = false;
        $this->lightboxUrl = null;
        $this->lightboxTitle = null;
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1073741824) {
            return round($bytes / 1073741824, 1).' GB';
        }
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 1).' MB';
        }
        if ($bytes >= 1024) {
            return round($bytes / 1024, 1).' KB';
        }

        return $bytes.' B';
    }

    public function render()
    {
        return $this->view(['title' => 'Kelola Galeri']);
    }
};
?>

<div x-data="{
    showUploadWidget: false,
    uploadMinimized: false,
    uploadProgress: 0,
    dragOver: false,
    selectedFiles: [],
    fileNames: [],

    handleDrop(e) {
        this.dragOver = false;
        const dt = e.dataTransfer;
        if (dt.files.length) {
            this.selectedFiles = [...dt.files];
            this.fileNames = this.selectedFiles.map(f => f.name);
            @this.uploadFiles = this.selectedFiles;
        }
    },

    handleFileSelect(e) {
        this.selectedFiles = [...e.target.files];
        this.fileNames = this.selectedFiles.map(f => f.name);
    },

    clearFiles() {
        this.selectedFiles = [];
        this.fileNames = [];
        if (this.$refs.fileInput) this.$refs.fileInput.value = '';
    }
}" x-on:livewire-upload-start="showUploadWidget = true; uploadProgress = 0"
   x-on:livewire-upload-finish="uploadProgress = 100"
   x-on:livewire-upload-progress="uploadProgress = $event.detail.progress"
   x-on:livewire-upload-error="uploadProgress = 0"
   x-on:galeri-uploaded.window="showUploadWidget = true; uploadProgress = 100; setTimeout(() => { showUploadWidget = false; uploadProgress = 0; clearFiles(); }, 3000)">

    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-actions">
            <div>
                <h1>{{ $title }}</h1>
                <p>Manajemen media foto dan dokumentasi warisan budaya.</p>
            </div>
            <button class="btn btn-primary galeri-upload-btn-desktop" onclick="document.getElementById('galeri-upload-trigger').click()">
                <span class="material-symbols-outlined" style="font-size:18px">cloud_upload</span>
                Upload Media
            </button>
        </div>
    </div>

    <x-admin.flash-alert />

    {{-- Stats Bar --}}
    <div class="galeri-stats">
        <div class="galeri-stat-item">
            <span class="material-symbols-outlined">photo_library</span>
            <div>
                <strong>{{ $this->stats['total'] }}</strong>
                <span>Total Media</span>
            </div>
        </div>
        <div class="galeri-stat-item">
            <span class="material-symbols-outlined">image</span>
            <div>
                <strong>{{ $this->stats['images'] }}</strong>
                <span>Foto</span>
            </div>
        </div>
        <div class="galeri-stat-item">
            <span class="material-symbols-outlined">hard_drive</span>
            <div>
                <strong>{{ $this->stats['size'] }}</strong>
                <span>Penyimpanan</span>
            </div>
        </div>
    </div>

    {{-- Upload Area --}}
    <div class="card galeri-upload-card" id="galeri-upload-area">
        <div class="card-body" style="padding:16px;">
            <form wire:submit="uploadMedia" enctype="multipart/form-data">
                <div class="upload-zone galeri-dropzone"
                     x-bind:class="dragOver ? 'drag-active' : ''"
                     x-on:dragover.prevent="dragOver = true"
                     x-on:dragleave.prevent="dragOver = false"
                     x-on:drop.prevent="handleDrop($event)"
                     x-on:click="$refs.fileInput.click()">
                    <input type="file" x-ref="fileInput" wire:model="uploadFiles" multiple accept="image/*,video/mp4,video/quicktime"
                           style="display:none;" id="galeri-upload-trigger" x-on:change="handleFileSelect($event)" />
                    <template x-if="fileNames.length === 0">
                        <div style="display:flex;flex-direction:column;align-items:center;gap:8px;">
                            <span class="material-symbols-outlined" style="font-size:40px;">add_photo_alternate</span>
                            <h4>Seret & Lepaskan Media di Sini</h4>
                            <p>Atau klik untuk memilih — JPG, PNG, WebP, MP4 (maks. 20MB)</p>
                        </div>
                    </template>
                    <template x-if="fileNames.length > 0">
                        <div style="display:flex;flex-direction:column;align-items:center;gap:8px;">
                            <span class="material-symbols-outlined" style="font-size:36px;color:var(--jungle-mid);">check_circle</span>
                            <h4 x-text="fileNames.length + ' file dipilih'"></h4>
                            <div style="display:flex;flex-wrap:wrap;gap:4px;justify-content:center;max-width:500px;">
                                <template x-for="(name, i) in fileNames.slice(0, 5)" :key="i">
                                    <span style="font-size:0.7rem;padding:2px 8px;background:var(--gold-bg);border-radius:12px;color:var(--text-secondary);" x-text="name"></span>
                                </template>
                                <template x-if="fileNames.length > 5">
                                    <span style="font-size:0.7rem;padding:2px 8px;background:rgba(0,0,0,0.05);border-radius:12px;color:var(--text-muted);"
                                          x-text="'+ ' + (fileNames.length - 5) + ' lainnya'"></span>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- Upload form fields --}}
                <div class="galeri-upload-fields" x-show="fileNames.length > 0" x-transition>
                    <div class="form-row" style="margin-top:12px;">
                        <div class="form-group" style="margin-bottom:0;">
                            <label>Judul (opsional)</label>
                            <input type="text" wire:model="uploadJudul" placeholder="Judul akan diambil dari nama file jika kosong" />
                        </div>
                        <div class="form-group" style="margin-bottom:0;">
                            <label>Tautkan ke Situs</label>
                            <select wire:model="uploadSitusId">
                                <option value="">Tidak ditautkan</option>
                                @foreach($this->siteOptions as $site)
                                    <option value="{{ $site->id }}">{{ $site->nama_cagar_budaya }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div style="display:flex;gap:8px;margin-top:12px;justify-content:flex-end;">
                        <button type="button" class="btn btn-outline btn-sm" x-on:click="clearFiles(); @this.set('uploadFiles', [])">
                            <span class="material-symbols-outlined" style="font-size:14px">close</span> Batal
                        </button>
                        <button type="submit" class="btn btn-primary btn-sm" wire:loading.attr="disabled">
                            <span class="material-symbols-outlined" style="font-size:14px" wire:loading.remove wire:target="uploadMedia">cloud_upload</span>
                            <span class="material-symbols-outlined spin" style="font-size:14px" wire:loading wire:target="uploadMedia">progress_activity</span>
                            Upload
                        </button>
                    </div>
                </div>
                @error('uploadFiles') <p class="form-error" style="margin-top:8px;">{{ $message }}</p> @enderror
                @error('uploadFiles.*') <p class="form-error" style="margin-top:8px;">{{ $message }}</p> @enderror
            </form>
        </div>
    </div>

    {{-- Filter & Search --}}
    <div class="galeri-toolbar">
        <div class="search-bar">
            <span class="material-symbols-outlined">search</span>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari media..." />
        </div>
        <select wire:model.live="filterSitus" class="galeri-filter-select">
            <option value="">Semua Situs</option>
            @foreach($this->siteOptions as $site)
                <option value="{{ $site->id }}">{{ $site->nama_cagar_budaya }}</option>
            @endforeach
        </select>
    </div>

    {{-- Media Grid --}}
    <div class="galeri-grid">
        @forelse($this->galeriList as $item)
            <div class="galeri-card" wire:key="galeri-{{ $item->id }}">
                @if($item->file_type === 'video')
                    <div class="galeri-card-thumb" wire:click="openLightbox('{{ $item->id }}')">
                        <video src="{{ asset('storage/' . $item->file_path) }}" muted preload="metadata"></video>
                        <div class="galeri-card-video-badge">
                            <span class="material-symbols-outlined" style="font-size:16px;">play_arrow</span>
                        </div>
                    </div>
                @else
                    <div class="galeri-card-thumb" wire:click="openLightbox('{{ $item->id }}')">
                        <img src="{{ asset('storage/' . $item->file_path) }}" alt="{{ $item->judul }}" loading="lazy" />
                    </div>
                @endif

                {{-- Hover Overlay --}}
                <div class="galeri-card-overlay">
                    <button type="button" class="galeri-card-action" wire:click="openEdit('{{ $item->id }}')" title="Edit">
                        <span class="material-symbols-outlined" style="font-size:16px;">edit</span>
                    </button>
                    <button type="button" class="galeri-card-action danger" wire:click="confirmDelete('{{ $item->id }}', '{{ $item->judul }}')" title="Hapus">
                        <span class="material-symbols-outlined" style="font-size:16px;">delete</span>
                    </button>
                </div>

                <div class="galeri-card-info">
                    <h5>{{ $item->judul }}</h5>
                    <div class="galeri-card-meta">
                        @if($item->cagarBudaya)
                            <span class="galeri-card-tag">
                                <span class="material-symbols-outlined" style="font-size:12px;">location_on</span>
                                {{ Str::limit($item->cagarBudaya->nama_cagar_budaya, 20) }}
                            </span>
                        @endif
                        <span class="galeri-card-date">{{ $item->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="galeri-empty">
                <span class="material-symbols-outlined" style="font-size:56px;color:var(--text-muted);opacity:0.4;">photo_library</span>
                <p style="font-weight:600;color:var(--text-secondary);margin:8px 0 0;">
                    @if($search || $filterSitus) Tidak ada media yang cocok @else Belum ada media galeri @endif
                </p>
                <p style="font-size:0.82rem;color:var(--text-muted);margin:4px 0 0;">
                    @if($search || $filterSitus) Coba ubah filter pencarian. @else Upload foto atau video pertama Anda. @endif
                </p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($this->galeriList->hasPages())
        <div style="margin-top:20px;">
            <x-admin.pagination :paginator="$this->galeriList" />
        </div>
    @endif

    {{-- Google Drive-style Upload Widget --}}
    <div class="upload-widget" x-show="showUploadWidget" x-transition:enter="upload-widget-enter" x-transition:leave="upload-widget-leave" x-cloak>
        <div class="upload-widget-header" x-on:click="uploadMinimized = !uploadMinimized">
            <div style="display:flex;align-items:center;gap:8px;">
                <span class="material-symbols-outlined spin" style="font-size:18px;" x-show="uploadProgress < 100">progress_activity</span>
                <span class="material-symbols-outlined" style="font-size:18px;color:#10B981;" x-show="uploadProgress >= 100" x-cloak>check_circle</span>
                <span x-text="uploadProgress >= 100 ? 'Upload selesai' : 'Mengupload...'"></span>
            </div>
            <button class="upload-widget-toggle">
                <span class="material-symbols-outlined" style="font-size:18px;" x-text="uploadMinimized ? 'expand_less' : 'expand_more'"></span>
            </button>
        </div>
        <div class="upload-widget-body" x-show="!uploadMinimized" x-transition x-cloak>
            <div class="upload-widget-progress">
                <div class="upload-widget-progress-bar" x-bind:style="'width:' + uploadProgress + '%'"
                     x-bind:class="uploadProgress >= 100 ? 'complete' : ''"></div>
            </div>
            <div class="upload-widget-files">
                <template x-for="(name, i) in fileNames" :key="i">
                    <div class="upload-widget-file">
                        <span class="material-symbols-outlined" style="font-size:16px;color:var(--text-muted);">image</span>
                        <span class="upload-widget-file-name" x-text="name"></span>
                        <span class="material-symbols-outlined" style="font-size:14px;color:#10B981;" x-show="uploadProgress >= 100" x-cloak>check</span>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- Lightbox --}}
    @if($showLightbox)
        <div class="galeri-lightbox" wire:click.self="closeLightbox">
            <button type="button" class="galeri-lightbox-close" wire:click="closeLightbox">
                <span class="material-symbols-outlined">close</span>
            </button>
            <div class="galeri-lightbox-content">
                <img src="{{ $lightboxUrl }}" alt="{{ $lightboxTitle }}" />
                <div class="galeri-lightbox-caption">{{ $lightboxTitle }}</div>
            </div>
        </div>
    @endif

    {{-- Edit Modal --}}
    @if($showEditModal)
        <div class="modal-overlay" wire:click.self="closeEdit">
            <div class="modal-container" style="max-width:480px;">
                <div class="modal-header">
                    <div class="modal-header-info">
                        <div class="modal-icon gold">
                            <span class="material-symbols-outlined">edit</span>
                        </div>
                        <div>
                            <h3>Edit Media</h3>
                            <p>Perbarui informasi media galeri.</p>
                        </div>
                    </div>
                    <button type="button" class="modal-close-btn" wire:click="closeEdit">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <form wire:submit="updateMedia">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Judul Media</label>
                            <input type="text" wire:model="editJudul" placeholder="Judul media" />
                            @error('editJudul') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label>Tautkan ke Situs</label>
                            <select wire:model="editSitusId">
                                <option value="">Tidak ditautkan</option>
                                @foreach($this->siteOptions as $site)
                                    <option value="{{ $site->id }}">{{ $site->nama_cagar_budaya }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline" wire:click="closeEdit">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="material-symbols-outlined" style="font-size:18px">save</span>
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Delete Modal --}}
    <x-admin.modal-delete :show="$showDeleteModal" :name="$deleteName" title="Hapus Media"
        message="Apakah Anda yakin ingin menghapus media ini? File akan dihapus permanen."
        action="delete" cancel="cancelDelete" />

    {{-- Mobile FAB --}}
    <button class="galeri-fab" onclick="document.getElementById('galeri-upload-area').scrollIntoView({behavior:'smooth'}); setTimeout(() => document.getElementById('galeri-upload-trigger').click(), 400);">
        <span class="material-symbols-outlined">add_a_photo</span>
    </button>
</div>
