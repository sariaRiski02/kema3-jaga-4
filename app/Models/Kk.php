<?php

namespace App\Models;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kk extends Model
{
    /** @use HasFactory<\Database\Factories\KkFactory> */
    use HasFactory;

    protected $table = "kk";
    public function warga()
    {
        return $this->hasMany(Warga::class);
    }
}
