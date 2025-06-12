<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Warga;


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
        $pendidikan = $this->penduduk->pluck('pendidikan')->countBy();


        $lebel_pendidikan = $pendidikan->keys()->toArray();
        $value_pendidikan = $pendidikan->values()->toArray();


        return collect([
            'lebel_pendidikan' => $lebel_pendidikan,
            'value_pendidikan' => $value_pendidikan
        ]);
    }
}
