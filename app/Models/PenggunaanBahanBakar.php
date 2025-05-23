<?php

namespace App\Models;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenggunaanBahanBakar extends Model
{
    /** @use HasFactory<\Database\Factories\PenggunaanBahanBakarFactory> */
    use HasFactory;

    protected $table = 'penggunaan_bahan_bakar';
    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
