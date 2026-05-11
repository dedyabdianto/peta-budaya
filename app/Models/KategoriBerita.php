<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriBerita extends Model
{
    use HasUuids;

    protected $table = 'kategori_beritas';

    protected $guarded = [];

    /**
     * @return HasMany<Berita, $this>
     */
    public function beritas(): HasMany
    {
        return $this->hasMany(Berita::class, 'kategori_berita_id');
    }
}
