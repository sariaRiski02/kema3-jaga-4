<?php

namespace App\Http\Controllers;

use App\Models\Kk;
use App\Models\Warga;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {


        // usia
        // ["0–12 (Anak)", "13–18 (Remaja)", "19–59 (Dewasa)", "60+ (Lansia)"],
        $penduduk = Warga::all()->filter(function ($warga) {
            return !$warga->tanggal_kematian;
        })->map(function ($warga) {
            $warga->usia = (int) Carbon::parse($warga->tanggal_lahir)->age;
            return $warga;
        });

        $anak = $penduduk->where('usia', '<=', 12)->count();
        $remaja = $penduduk->where('usia', '>=', 13)->where('usia', '<=', 18)->count();
        $dewasa = $penduduk->where('usia', '>=', 19)->where('usia', '<=', 59)->count();
        $lansia = $penduduk->where('usia', '>=', 60)->count();
        $klasifikasi_umur =  [$anak, $remaja, $dewasa, $lansia];

        $perempuan = $penduduk->where('jenis_kelamin', 'Perempuan')->count();
        $laki_laki = $penduduk->where('jenis_kelamin', 'Laki-Laki')->count();
        $penduduk = $penduduk->count();
        $kk = Kk::count();

        return view('Guest', compact(
            'penduduk',
            'laki_laki',
            'perempuan',
            'kk',
            'klasifikasi_umur'
        ));
    }
}
