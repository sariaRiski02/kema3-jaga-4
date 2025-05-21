<?php

namespace App\Models;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KepemilikanElektronik extends Model
{
    /** @use HasFactory<\Database\Factories\KepemilikanElektronikFactory> */
    use HasFactory;

    protected $table = 'kepemilikan_elektronik';
    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
