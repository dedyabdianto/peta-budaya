<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\KategoriBudaya;
use App\Models\Distrik;

class CagarBudaya extends Model
{
    use HasUuids;

    protected $table = 'cagar_budayas';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function kategoriBudaya()
    {
        return $this->belongsTo(KategoriBudaya::class, 'kategori_budaya_id');
    }

    public function distrik()
    {
        return $this->belongsTo(Distrik::class, 'distrik_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
