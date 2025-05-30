<?php

namespace App\Services;

use App\Models\Kk;
use App\Models\Warga;


class dashboard_statistik
{
    public function penduduk_aktif()
    {
        $warga = Warga::where('tanggal_kematian', '=', null)->get();
        return $warga->count();
    }

    public function semua_penduduk()
    {
        return Warga::all()->count();
    }

    public function jenis_kelamin()
    {
        $warga = Warga::where('tanggal_kematian', '=', null)->get();
        $warga = $warga->pluck('jenis_kelamin')->countBy();
        return $warga;
    }
    public function keluarga()
    {
        return Kk::all()->count();
    }
}
