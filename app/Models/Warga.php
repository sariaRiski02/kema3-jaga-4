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
    protected $appends = ['umur'];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function getUmurAttribute()
    {
        if (!$this->tanggal_kematian) {

            return Carbon::parse($this->tanggal_lahir)->age;
        }

        $tanggal_lahir = Carbon::parse($this->tanggal_lahir);
        $tanggal_kematian = Carbon::parse($this->tanggal_kematian);

        $umur_hidup = $tanggal_lahir->diffInYears($tanggal_kematian);
        return 'Umur Hidup: ' . round($umur_hidup);
    }

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
        return $this->hasOne(PenggunaanBahanBakar::class);
    }

    public function kendaraan()
    {
        return $this->hasOne(Kendaraan::class);
    }

    public function penggunaan_air()
    {
        return $this->hasOne(PenggunaanAir::class);
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
        return $this->hasMany(KepemilikanElektronik::class);
    }
}
