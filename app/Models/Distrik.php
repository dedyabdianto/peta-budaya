<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Models\CagarBudaya;

class Distrik extends Model
{
   use HasUuids;
    
    protected $table = 'distrik';
    protected $primaryKey = 'id';

    protected $guarded = [];

    public function cagarBudaya()
    {
        return $this->hasMany(CagarBudaya::class, 'distrik_id');
    }
}
