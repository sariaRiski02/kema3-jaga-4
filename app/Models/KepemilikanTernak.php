<?php

namespace App\Models;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KepemilikanTernak extends Model
{
    /** @use HasFactory<\Database\Factories\KepemilikanTernakFactory> */
    use HasFactory;

    protected $table = 'kepemilikan_ternak';
    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
