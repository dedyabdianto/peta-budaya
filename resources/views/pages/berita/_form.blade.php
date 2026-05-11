{{-- Sidebar settings panel — shared between create & edit --}}
<div class="berita-form-sidebar">

    {{-- Thumbnail Upload --}}
    <div class="berita-form-section">
        <h4 class="berita-form-section-title">
            <span class="material-symbols-outlined" style="font-size:18px;">image</span>
            Thumbnail
        </h4>
        <div class="berita-thumb-upload"
             x-data="{
                dragOver: false,
                preview: @js($existingThumbnail ? asset('storage/' . $existingThumbnail) : null),
                handleDrop(e) {
                    this.dragOver = false;
                    if (e.dataTransfer.files.length) {
                        this.$refs.thumbInput.files = e.dataTransfer.files;
                        this.$refs.thumbInput.dispatchEvent(new Event('change', { bubbles: true }));
                        this.previewFile(e.dataTransfer.files[0]);
                    }
                },
                handleSelect(e) {
                    if (e.target.files.length) {
                        this.previewFile(e.target.files[0]);
                    }
                },
                previewFile(file) {
                    const reader = new FileReader();
                    reader.onload = (e) => this.preview = e.target.result;
                    reader.readAsDataURL(file);
                },
                removePreview() {
                    this.preview = null;
                    this.$refs.thumbInput.value = '';
                    @this.set('thumbnail', null);
                    @this.set('removeThumbnail', true);
                }
             }">
            <template x-if="preview">
                <div class="berita-thumb-preview">
                    <img :src="preview" alt="Thumbnail preview" />
                    <button type="button" class="berita-thumb-remove" x-on:click="removePreview()">
                        <span class="material-symbols-outlined" style="font-size:16px;">close</span>
                    </button>
                </div>
            </template>
            <template x-if="!preview">
                <div class="berita-thumb-dropzone"
                     :class="dragOver ? 'drag-active' : ''"
                     x-on:dragover.prevent="dragOver = true"
                     x-on:dragleave.prevent="dragOver = false"
                     x-on:drop.prevent="handleDrop($event)"
                     x-on:click="$refs.thumbInput.click()">
                    <span class="material-symbols-outlined" style="font-size:32px;color:var(--text-muted);">add_photo_alternate</span>
                    <p>Seret atau klik</p>
                    <span style="font-size:0.7rem;color:var(--text-muted);">JPG, PNG, WebP · Maks 2MB</span>
                </div>
            </template>
            <input type="file" x-ref="thumbInput" wire:model="thumbnail" accept="image/jpeg,image/png,image/webp"
                   style="display:none;" x-on:change="handleSelect($event)" />
            @error('thumbnail') <p class="form-error">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- Kategori --}}
    <div class="berita-form-section">
        <h4 class="berita-form-section-title">
            <span class="material-symbols-outlined" style="font-size:18px;">category</span>
            Kategori
        </h4>
        <select wire:model="kategoriBeritaId" class="berita-form-input">
            <option value="">Pilih Kategori</option>
            @foreach($this->kategoriOptions as $kat)
                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
            @endforeach
        </select>
        @error('kategoriBeritaId') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    {{-- Tags --}}
    <div class="berita-form-section">
        <h4 class="berita-form-section-title">
            <span class="material-symbols-outlined" style="font-size:18px;">sell</span>
            Tags
        </h4>
        <div class="berita-tags-input" x-data="{ newTag: '' }">
            <div class="berita-tags-list">
                @if(is_array($tags))
                    @foreach($tags as $i => $tag)
                        <span class="berita-tag-chip" wire:key="tag-{{ $i }}">
                            {{ $tag }}
                            <button type="button" wire:click="removeTag({{ $i }})">
                                <span class="material-symbols-outlined" style="font-size:12px;">close</span>
                            </button>
                        </span>
                    @endforeach
                @endif
            </div>
            <input type="text" x-model="newTag" placeholder="Ketik tag + Enter"
                   class="berita-form-input"
                   x-on:keydown.enter.prevent="if(newTag.trim()) { @this.call('addTag', newTag.trim()); newTag = ''; }" />
        </div>
    </div>

    {{-- Status --}}
    <div class="berita-form-section">
        <h4 class="berita-form-section-title">
            <span class="material-symbols-outlined" style="font-size:18px;">toggle_on</span>
            Status
        </h4>
        <div class="berita-status-options">
            <label class="berita-status-radio {{ $status === 'draft' ? 'active' : '' }}">
                <input type="radio" wire:model.live="status" value="draft" />
                <span class="material-symbols-outlined" style="font-size:16px;color:#9CA3AF;">edit_note</span>
                Draft
            </label>
            <label class="berita-status-radio {{ $status === 'published' ? 'active' : '' }}">
                <input type="radio" wire:model.live="status" value="published" />
                <span class="material-symbols-outlined" style="font-size:16px;color:#10B981;">check_circle</span>
                Published
            </label>
            <label class="berita-status-radio {{ $status === 'scheduled' ? 'active' : '' }}">
                <input type="radio" wire:model.live="status" value="scheduled" />
                <span class="material-symbols-outlined" style="font-size:16px;color:#F59E0B;">schedule</span>
                Scheduled
            </label>
        </div>
    </div>

    {{-- Jadwal Publish (visible only if scheduled) --}}
    @if($status === 'scheduled')
        <div class="berita-form-section" style="animation: fadeIn 0.2s ease;">
            <h4 class="berita-form-section-title">
                <span class="material-symbols-outlined" style="font-size:18px;">event</span>
                Jadwal Publish
            </h4>
            <input type="datetime-local" wire:model="publishedAt" class="berita-form-input" />
            @error('publishedAt') <p class="form-error">{{ $message }}</p> @enderror
        </div>
    @endif

    {{-- Berita Unggulan --}}
    <div class="berita-form-section">
        <label class="berita-featured-toggle">
            <input type="checkbox" wire:model="isFeatured" />
            <span class="material-symbols-outlined" style="font-size:18px;font-variation-settings:'FILL' 1;color:#D4AF37;">star</span>
            Tandai sebagai Berita Unggulan
        </label>
    </div>

    {{-- Excerpt --}}
    <div class="berita-form-section">
        <h4 class="berita-form-section-title">
            <span class="material-symbols-outlined" style="font-size:18px;">short_text</span>
            Ringkasan (Excerpt)
        </h4>
        <textarea wire:model="excerpt" class="berita-form-input" rows="3" placeholder="Ringkasan singkat artikel... (akan di-generate otomatis jika kosong)"></textarea>
        @error('excerpt') <p class="form-error">{{ $message }}</p> @enderror
    </div>

    {{-- SEO Section --}}
    <div class="berita-form-section" x-data="{ seoOpen: false }">
        <button type="button" class="berita-seo-toggle" x-on:click="seoOpen = !seoOpen">
            <div style="display:flex;align-items:center;gap:6px;">
                <span class="material-symbols-outlined" style="font-size:18px;">search</span>
                <span>Pengaturan SEO</span>
            </div>
            <span class="material-symbols-outlined" style="font-size:18px;" x-text="seoOpen ? 'expand_less' : 'expand_more'"></span>
        </button>
        <div x-show="seoOpen" x-transition x-cloak style="margin-top:10px;">
            <div class="form-group" style="margin-bottom:10px;">
                <label style="font-size:0.72rem;text-transform:none;letter-spacing:0;">SEO Title</label>
                <input type="text" wire:model="seoTitle" class="berita-form-input" placeholder="Judul untuk mesin pencari" />
            </div>
            <div class="form-group" style="margin-bottom:0;">
                <label style="font-size:0.72rem;text-transform:none;letter-spacing:0;">SEO Description</label>
                <textarea wire:model="seoDescription" class="berita-form-input" rows="2" placeholder="Deskripsi meta untuk SEO"></textarea>
            </div>
        </div>
    </div>
</div>
