<?php

namespace App\Models;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KepemilikanRumah extends Model
{
    /** @use HasFactory<\Database\Factories\KepemilikanRumahFactory> */
    use HasFactory;

    protected $table = 'kepemilikan_rumah';
    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
