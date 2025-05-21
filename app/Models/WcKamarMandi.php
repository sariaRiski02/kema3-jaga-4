<?php

namespace App\Models;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WcKamarMandi extends Model
{
    /** @use HasFactory<\Database\Factories\WcKamarMandiFactory> */
    use HasFactory;

    protected $table = 'wc_kamar_mandi';
    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
