<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasUuids;

    protected $table = 'galeris';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public function cagarBudaya()
    {
        return $this->belongsTo(CagarBudaya::class, 'cagar_budaya_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getFileSizeFormattedAttribute(): string
    {
        $bytes = $this->file_size;
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 1).' MB';
        }
        if ($bytes >= 1024) {
            return round($bytes / 1024, 1).' KB';
        }

        return $bytes.' B';
    }
}
