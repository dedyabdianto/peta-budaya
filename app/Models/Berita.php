<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasUuids;

    protected $table = 'beritas';

    protected $guarded = [];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tags' => 'array',
            'published_at' => 'datetime',
            'is_featured' => 'boolean',
            'views_count' => 'integer',
        ];
    }

    /**
     * Auto-generate unique slug from judul on creating.
     */
    protected static function booted(): void
    {
        static::creating(function (Berita $berita) {
            if (empty($berita->slug)) {
                $berita->slug = static::generateUniqueSlug($berita->judul);
            }
        });

        static::updating(function (Berita $berita) {
            if ($berita->isDirty('judul') && ! $berita->isDirty('slug')) {
                $berita->slug = static::generateUniqueSlug($berita->judul, $berita->id);
            }
        });
    }

    /**
     * Generate a unique slug, appending a numeric suffix if needed.
     */
    public static function generateUniqueSlug(string $title, ?string $excludeId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $counter = 1;

        while (static::query()
            ->where('slug', $slug)
            ->when($excludeId, fn (Builder $q) => $q->where('id', '!=', $excludeId))
            ->exists()
        ) {
            $slug = $original.'-'.$counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Estimated reading time in minutes.
     */
    protected function readingTime(): Attribute
    {
        return Attribute::get(function () {
            $wordCount = str_word_count(strip_tags($this->konten ?? ''));
            $minutes = max(1, (int) ceil($wordCount / 200));

            return $minutes;
        });
    }

    /**
     * Scope: only published articles.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope: only draft articles.
     */
    public function scopeDraft(Builder $query): Builder
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope: only scheduled articles.
     */
    public function scopeScheduled(Builder $query): Builder
    {
        return $query->where('status', 'scheduled')
            ->where('published_at', '>', now());
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo<KategoriBerita, $this>
     */
    public function kategoriBerita(): BelongsTo
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_berita_id');
    }
}
