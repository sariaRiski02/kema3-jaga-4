<?php

namespace App\Models;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kendaraan extends Model
{
    /** @use HasFactory<\Database\Factories\KendaraanFactory> */
    use HasFactory;


    protected $table = 'kendaraan';
    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
