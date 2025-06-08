<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Usaha;
use App\Models\Warga;
use App\Models\Kendaraan;
use App\Models\KepemelikanTanah;
use App\Models\KepemilikanTernak;
use Illuminate\Support\Facades\DB;
use App\Models\PenggunaanBahanBakar;
use App\Models\KepemilikanElektronik;
use App\Models\KepemilikanRumah;

class statistik
{

    public $penduduk;

    public function __construct()
    {
        $penduduk = Warga::all()->filter(function ($warga) {
            return !$warga->tanggal_kematian;
        })->map(function ($warga) {
            $warga->usia = (int) Carbon::parse($warga->tanggal_lahir)->age;
            return $warga;
        });

        $this->penduduk = $penduduk;
    }

    public function usia()
    {
        // usia
        // ["0–12 (Anak)", "13–18 (Remaja)", "19–59 (Dewasa)", "60+ (Lansia)"],


        $anak = $this->penduduk->where('usia', '<=', 12)->count();
        $remaja = $this->penduduk->where('usia', '>=', 13)->where('usia', '<=', 18)->count();
        $dewasa = $this->penduduk->where('usia', '>=', 19)->where('usia', '<=', 59)->count();
        $lansia = $this->penduduk->where('usia', '>=', 60)->count();
        $klasifikasi_umur =  [$anak, $remaja, $dewasa, $lansia];

        return $klasifikasi_umur;
    }

    public function jenis_kelamin()
    {
        //  jenis kelamin
        $perempuan = $this->penduduk->where('jenis_kelamin', 'Perempuan')->count();
        $laki_laki = $this->penduduk->where('jenis_kelamin', 'Laki-Laki')->count();
        $penduduk = $this->penduduk->count();

        return collect([
            'perempuan' => $perempuan,
            'laki_laki' => $laki_laki,
        ]);
    }

    public function pekerjaan()
    {

        // pekerjaan
        $pekerjaan_warga = $this->penduduk->pluck('pekerjaan')->countBy()->sortDesc();

        // ambil 4 teratas
        $count = 4;
        $upCount = $pekerjaan_warga->take($count);

        // mengambil value untuk ditampilkan
        $pekerjaan = $upCount->toArray();

        // menghitung jumlah sisa dari pekerjaan yang di ambil
        $sisa_pekerjaan = $pekerjaan_warga
            ->slice(- ($pekerjaan_warga->count() - $count));
        $lainnya = $sisa_pekerjaan->sum();

        $pekerjaan['lainnya'] = $lainnya;


        $value_pekerjaan = $pekerjaan;
        $lebel_pekerjaan = collect($value_pekerjaan)->keys()->toArray();

        return collect([
            'value_pekerjaan' => $value_pekerjaan,
            'lebel_pekerjaan' => $lebel_pekerjaan,
        ]);
    }

    public function pendidikan()
    {
        $item = $this->penduduk->pluck('pendidikan')->countBy();
        $pendidikan = collect([
            'Tidak Sekolah'    => $item['Tidak Sekolah'] ?? 0,
            'PAUD'             => $item['PAUD'] ?? 0,
            'TK'               => $item['TK'] ?? 0,
            'SD/Sederajat'     => $item['SD/Sederajat'] ?? 0,
            'SMP/Sederajat'    => $item['SMP/Sederajat'] ?? 0,
            'SMA/Sederajat'    => $item['SMA/Sederajat'] ?? 0,
            'Diploma'          => $item['Diploma'] ?? 0,
            'Sarjana'          => $item['Sarjana'] ?? 0,
            'Pascasarjana'     => $item['Pascasarjana'] ?? 0,
            'Lainnya'          => $item['Lainnya'] ?? 0,
        ]);

        $lebel_pendidikan = $pendidikan->keys()->toArray();
        $value_pendidikan = $pendidikan->values()->toArray();


        return collect([
            'lebel_pendidikan' => $lebel_pendidikan,
            'value_pendidikan' => $value_pendidikan
        ]);
    }
}
