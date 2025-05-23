<?php

namespace App\Models;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KepemelikanTanah extends Model
{
    /** @use HasFactory<\Database\Factories\KepemelikanTanahFactory> */
    use HasFactory;

    protected $table = 'kepemelikan_tanah';
    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
