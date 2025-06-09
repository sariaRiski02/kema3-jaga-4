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
        // Validasi tanggal lahir agar formatnya benar (Y-m-d atau d/m/Y)
        $tgl = $this->tanggal_lahir;
        if (!$tgl) return null;
        // Cek format: jika d/m/Y, konversi ke Y-m-d
        if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $tgl)) {
            [$d, $m, $y] = explode('/', $tgl);
            $tgl = "$y-$m-$d";
        }
        // Jika sudah Y-m-d, biarkan
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $tgl)) return null;
        if (!$this->tanggal_kematian) {
            return Carbon::parse($tgl)->age;
        }
        $tgl_kematian = $this->tanggal_kematian;
        if ($tgl_kematian && preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $tgl_kematian)) {
            [$d, $m, $y] = explode('/', $tgl_kematian);
            $tgl_kematian = "$y-$m-$d";
        }
        if ($tgl_kematian && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $tgl_kematian)) return null;
        $tanggal_lahir = Carbon::parse($tgl);
        $tanggal_kematian = Carbon::parse($tgl_kematian);
        $umur_hidup = $tanggal_lahir->diffInYears($tanggal_kematian);
        return 'Umur Hidup: ' . round($umur_hidup);
    }

    public function kk()
    {
        return $this->belongsTo(Kk::class);
    }
}
