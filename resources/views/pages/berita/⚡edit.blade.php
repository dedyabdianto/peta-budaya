<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

new #[Layout('layouts.admin')] #[Title('Edit Berita')] class extends Component
{
    use WithFileUploads;

    public Berita $berita;

    public string $judul = '';
    public string $slug = '';
    public string $konten = '';
    public string $excerpt = '';
    public ?string $kategoriBeritaId = null;
    public array $tags = [];
    public string $status = 'draft';
    public ?string $publishedAt = null;
    public bool $isFeatured = false;
    public string $seoTitle = '';
    public string $seoDescription = '';
    public $thumbnail;
    public bool $removeThumbnail = false;
    public ?string $existingThumbnail = null;

    // Upload widget
    public bool $isUploading = false;
    public array $uploadResults = [];

    public function mount(Berita $berita)
    {
        $this->berita = $berita;
        $this->judul = $berita->judul;
        $this->slug = $berita->slug;
        $this->konten = $berita->konten ?? '';
        $this->excerpt = $berita->excerpt ?? '';
        $this->kategoriBeritaId = $berita->kategori_berita_id;
        $this->tags = $berita->tags ?? [];
        $this->status = $berita->status;
        $this->publishedAt = $berita->published_at?->format('Y-m-d\TH:i');
        $this->isFeatured = $berita->is_featured;
        $this->seoTitle = $berita->seo_title ?? '';
        $this->seoDescription = $berita->seo_description ?? '';
        $this->existingThumbnail = $berita->thumbnail;
    }

    // Quick-add kategori modal
    public string $newKategoriNama = '';
    public string $newKategoriWarna = '#1A362D';

    #[Computed]
    public function kategoriOptions()
    {
        return KategoriBerita::orderBy('nama_kategori')->get();
    }

    public function saveKategoriBerita()
    {
        $this->validate([
            'newKategoriNama' => 'required|string|max:255|unique:kategori_beritas,nama_kategori',
        ]);

        $kategori = KategoriBerita::create([
            'nama_kategori' => $this->newKategoriNama,
            'warna' => $this->newKategoriWarna ?: '#1A362D',
        ]);

        // Auto-select the new kategori
        $this->kategoriBeritaId = $kategori->id;

        // Reset modal fields
        $this->newKategoriNama = '';
        $this->newKategoriWarna = '#1A362D';

        // Clear cached computed property so dropdown refreshes
        unset($this->kategoriOptions);

        // Dispatch browser event to close modal
        $this->dispatch('kategori-berita-saved');
    }

    public function updatedJudul()
    {
        $this->slug = Berita::generateUniqueSlug($this->judul, $this->berita->id);
    }

    public function addTag(string $tag)
    {
        $tag = trim($tag);
        if ($tag && ! in_array($tag, $this->tags)) {
            $this->tags[] = $tag;
        }
    }

    public function removeTag(int $index)
    {
        unset($this->tags[$index]);
        $this->tags = array_values($this->tags);
    }

    public function saveDraft()
    {
        $this->status = 'draft';
        $this->save();
    }

    public function publish()
    {
        $this->status = 'published';
        $this->save();
    }

    public function save()
    {
        $this->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string|min:10',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'kategoriBeritaId' => 'nullable|exists:kategori_beritas,id',
            'status' => 'required|in:draft,published,scheduled',
            'publishedAt' => $this->status === 'scheduled' ? 'required|date|after:now' : 'nullable|date',
            'excerpt' => 'nullable|string|max:500',
            'seoTitle' => 'nullable|string|max:255',
            'seoDescription' => 'nullable|string|max:500',
        ]);

        $this->isUploading = true;

        // Handle thumbnail
        $thumbnailPath = $this->berita->thumbnail;
        if ($this->removeThumbnail && ! $this->thumbnail) {
            if ($thumbnailPath && Storage::disk('public')->exists($thumbnailPath)) {
                Storage::disk('public')->delete($thumbnailPath);
            }
            $thumbnailPath = null;
        }
        if ($this->thumbnail) {
            // Delete old thumbnail
            if ($this->berita->thumbnail && Storage::disk('public')->exists($this->berita->thumbnail)) {
                Storage::disk('public')->delete($this->berita->thumbnail);
            }
            $thumbnailPath = $this->thumbnail->store('berita/thumbnails', 'public');
        }

        // Auto-generate excerpt if empty
        $excerpt = $this->excerpt;
        if (empty($excerpt) && $this->konten) {
            $excerpt = Str::limit(strip_tags($this->konten), 200);
        }

        $publishedAt = match ($this->status) {
            'published' => $this->berita->published_at ?? now(),
            'scheduled' => $this->publishedAt,
            default => null,
        };

        $this->berita->update([
            'kategori_berita_id' => $this->kategoriBeritaId ?: null,
            'judul' => $this->judul,
            'slug' => $this->slug ?: Berita::generateUniqueSlug($this->judul, $this->berita->id),
            'konten' => $this->konten,
            'excerpt' => $excerpt,
            'thumbnail' => $thumbnailPath,
            'tags' => ! empty($this->tags) ? $this->tags : null,
            'status' => $this->status,
            'published_at' => $publishedAt,
            'is_featured' => $this->isFeatured,
            'seo_title' => $this->seoTitle ?: null,
            'seo_description' => $this->seoDescription ?: null,
        ]);

        $this->isUploading = false;
        $this->uploadResults = [['name' => $this->judul, 'status' => 'success']];

        session()->flash('success', 'Berita berhasil diperbarui.');

        $this->redirect(route('berita.index'), navigate: true);
    }

    public function render()
    {
        return $this->view(['title' => 'Edit Berita']);
    }
};
?>

<div x-data="{
    uploadProgress: 0,
    showUploadWidget: false,
    uploadMinimized: false,
}"
x-on:livewire-upload-start="showUploadWidget = true; uploadProgress = 0"
x-on:livewire-upload-finish="uploadProgress = 100"
x-on:livewire-upload-progress="uploadProgress = $event.detail.progress">

    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-actions">
            <div>
                <a href="{{ route('berita.index') }}" wire:navigate class="berita-back-link">
                    <span class="material-symbols-outlined" style="font-size:18px;">arrow_back</span>
                    Kembali ke Daftar
                </a>
                <h1 style="margin-top:4px;">Edit Berita</h1>
            </div>
            <div class="berita-form-actions">
                <button type="button" class="btn btn-outline" wire:click="saveDraft" wire:loading.attr="disabled">
                    <span class="material-symbols-outlined" style="font-size:18px" wire:loading.remove wire:target="saveDraft">save</span>
                    <span class="material-symbols-outlined spin" style="font-size:18px" wire:loading wire:target="saveDraft">progress_activity</span>
                    Simpan Draft
                </button>
                <button type="button" class="btn btn-primary" wire:click="publish" wire:loading.attr="disabled">
                    <span class="material-symbols-outlined" style="font-size:18px" wire:loading.remove wire:target="publish">publish</span>
                    <span class="material-symbols-outlined spin" style="font-size:18px" wire:loading wire:target="publish">progress_activity</span>
                    Publikasikan
                </button>
            </div>
        </div>
    </div>

    <x-admin.flash-alert />

    {{-- Main Form Layout --}}
    <form wire:submit="save" class="berita-form-layout">
        {{-- Left: Editor Column --}}
        <div class="berita-form-editor">
            {{-- Judul --}}
            <div class="form-group">
                <input type="text" wire:model.live.debounce.500ms="judul"
                       class="berita-judul-input" placeholder="Masukkan judul berita yang menarik..." />
                @error('judul') <p class="form-error">{{ $message }}</p> @enderror
                @if($slug)
                    <div class="berita-slug-preview">
                        <span class="material-symbols-outlined" style="font-size:14px;">link</span>
                        /berita/<strong>{{ $slug }}</strong>
                    </div>
                @endif
            </div>

            {{-- Quill Editor --}}
            <div class="form-group" style="flex:1;display:flex;flex-direction:column;">
                <label style="margin-bottom:8px;">Konten Artikel <span style="color:#DC2626;">*</span></label>
                <div wire:ignore>
                    <div id="quill-editor">{!! $konten !!}</div>
                </div>
                @error('konten') <p class="form-error">{{ $message }}</p> @enderror
            </div>
        </div>

        {{-- Right: Sidebar Settings --}}
        @include('pages.berita._form')
    </form>

    {{-- Google Drive-style Upload Widget --}}
    <div class="upload-widget" x-show="showUploadWidget" x-transition:enter="upload-widget-enter" x-transition:leave="upload-widget-leave" x-cloak>
        <div class="upload-widget-header" x-on:click="uploadMinimized = !uploadMinimized">
            <div style="display:flex;align-items:center;gap:8px;">
                <span class="material-symbols-outlined spin" style="font-size:18px;" x-show="uploadProgress < 100">progress_activity</span>
                <span class="material-symbols-outlined" style="font-size:18px;color:#10B981;" x-show="uploadProgress >= 100" x-cloak>check_circle</span>
                <span x-text="uploadProgress >= 100 ? 'Upload selesai' : 'Mengupload thumbnail...'"></span>
            </div>
            <button type="button" class="upload-widget-toggle">
                <span class="material-symbols-outlined" style="font-size:18px;" x-text="uploadMinimized ? 'expand_less' : 'expand_more'"></span>
            </button>
        </div>
        <div class="upload-widget-body" x-show="!uploadMinimized" x-transition x-cloak>
            <div class="upload-widget-progress">
                <div class="upload-widget-progress-bar" x-bind:style="'width:' + uploadProgress + '%'"
                     x-bind:class="uploadProgress >= 100 ? 'complete' : ''"></div>
            </div>
        </div>
    </div>
</div>

@script
<script>
    // Wait for Quill to be available
    const initQuill = () => {
        if (typeof Quill === 'undefined') {
            setTimeout(initQuill, 200);
            return;
        }

        // Image upload handler for Quill
        function imageHandler() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            input.onchange = async () => {
                const file = input.files[0];
                if (!file) return;

                const formData = new FormData();
                formData.append('file', file);

                try {
                    const res = await fetch('{{ route("berita.upload-image") }}', {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    });
                    const data = await res.json();
                    const range = quill.getSelection(true);
                    quill.insertEmbed(range.index, 'image', data.location);
                    quill.setSelection(range.index + 1);
                } catch (err) {
                    console.error('Image upload failed:', err);
                }
            };
        }

        const quill = new Quill('#quill-editor', {
            theme: 'snow',
            placeholder: 'Mulai menulis konten artikel di sini...',
            modules: {
                toolbar: {
                    container: [
                        [{ 'header': [1, 2, 3, 4, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'align': [] }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['blockquote', 'code-block'],
                        ['link', 'image', 'video'],
                        [{ 'indent': '-1'}, { 'indent': '+1' }],
                        ['clean']
                    ],
                    handlers: {
                        image: imageHandler
                    }
                }
            }
        });

        // Sync Quill content to Livewire
        quill.on('text-change', () => {
            const html = quill.root.innerHTML;
            @this.set('konten', html === '<p><br></p>' ? '' : html);
        });
    };

    initQuill();
</script>
@endscript
