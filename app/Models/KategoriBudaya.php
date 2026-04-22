<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class KategoriBudaya extends Model
{
    use HasUuids;
    
    protected $table = 'kategori_budayas';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'nama_kategori',
        'icon_marker',
        'warna_badge',
        'deskripsi',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
