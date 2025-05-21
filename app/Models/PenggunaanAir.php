<?php

namespace App\Models;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenggunaanAir extends Model
{
    /** @use HasFactory<\Database\Factories\PenggunaanAirFactory> */
    use HasFactory;

    protected $table = 'penggunaan_air';

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
