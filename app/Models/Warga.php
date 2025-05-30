<?php

namespace App\Models;

use App\Models\Kk;
use App\Models\Usaha;
use App\Models\Kendaraan;
use App\Models\WcKamarMandi;
use App\Models\PenggunaanAir;
use App\Models\KepemelikanTanah;
use App\Models\KepemilikanRumah;
use App\Models\KepemilikanTernak;
use App\Models\PenggunaanBahanBakar;
use App\Models\KepemilikanElektronik;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warga extends Model
{
    /** @use HasFactory<\Database\Factories\WargaFactory> */
    use HasFactory;

    protected $table = 'warga';


    public function kk()
    {
        return $this->belongsTo(Kk::class);
    }

    public function usaha()
    {
        return $this->hasMany(Usaha::class);
    }

    public function penggunaan_bahan_bakar()
    {
        return $this->hasMany(PenggunaanBahanBakar::class);
    }

    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class);
    }

    public function penggunaan_air()
    {
        return $this->hasMany(PenggunaanAir::class);
    }

    public function kepemilikan_tanah()
    {
        return $this->hasMany(KepemelikanTanah::class);
    }

    public function wc_kamar_mandi()
    {
        return $this->hasOne(WcKamarMandi::class);
    }

    public function kepemilikan_rumah()
    {
        return $this->hasMany(KepemilikanRumah::class);
    }

    public function kepemilikan_ternak()
    {
        return $this->hasMany(KepemilikanTernak::class);
    }

    public function kepemilikan_elektronik()
    {
        return $this->hasMnay(KepemilikanElektronik::class);
    }
}
