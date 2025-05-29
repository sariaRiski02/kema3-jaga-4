<?php

namespace App\Http\Controllers;

use App\Models\Kk;
use App\Models\Warga;
use App\Services\statistik;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GuestController extends Controller
{

    protected $statistik;
    public function __construct()
    {
        $this->statistik = new statistik;
    }

    public function index()
    {

        // jumlah keluarga
        $kk = Kk::count();

        // jumlah penduduk
        $penduduk = $this->statistik->penduduk->count();

        // klasifikasi umur
        $klasifikasi_umur = $this->statistik->usia();

        // jenis kelamin
        $jenis_kelamin = $this->statistik->jenis_kelamin();
        $perempuan = $jenis_kelamin->get('perempuan');
        $laki_laki = $jenis_kelamin->get('laki_laki');

        // pekerjaan
        $pekerjaan = $this->statistik->pekerjaan();
        $value_pekerjaan = $pekerjaan->get('value_pekerjaan');
        $lebel_pekerjaan = $pekerjaan->get('lebel_pekerjaan');


        // pendidikan
        $pendidikan = $this->statistik->pendidikan();
        $lebel_pendidikan = $pendidikan->get('lebel_pendidikan');
        $value_pendidikan = $pendidikan->get('value_pendidikan');


        // usaha
        $usaha = $this->statistik->usaha();
        $lebel_usaha = $usaha->keys()->toArray();
        $value_usaha = $usaha->values()->toArray();


        // Bahan Bakar
        $bahan_bakar = $this->statistik->bahan_bakar();
        $lebel_bahan_bakar = $bahan_bakar->keys()->toArray();
        $value_bahan_bakar = $bahan_bakar->values()->toArray();


        // kendaraan
        $kendaraan = $this->statistik->kendaraan();
        $lebel_kendaraan = $kendaraan->keys()->toArray();
        $value_kendaraan = $kendaraan->values()->toArray();

        // elektronik
        $elektronik = $this->statistik->elektronik();
        $lebel_elektronik = $elektronik->keys()->toArray();
        $value_elektronik = $elektronik->values()->toArray();


        // ternak
        $ternak = $this->statistik->ternak();
        $lebel_ternak = $ternak->keys()->toArray();
        $value_ternak = $ternak->values()->toArray();

        // rumah
        $rumah = $this->statistik->rumah();
        $lebel_rumah = $rumah->keys()->toArray();
        $value_rumah = $rumah->values()->toArray();

        // tipe rumah
        $tipe_rumah = $this->statistik->tipe_rumah();
        $lebel_tipe_rumah = $tipe_rumah->keys()->toArray();
        $value_tipe_rumah = $tipe_rumah->values()->toArray();

        // tanah
        $tanah = $this->statistik->tanah();
        $lebel_tanah = $tanah->keys()->toArray();
        $value_tanah = $tanah->values()->toArray();

        return view('Guest', compact(
            'penduduk',
            'kk',
            'klasifikasi_umur',
            // jenis kelamin
            'laki_laki',
            'perempuan',
            // pekerjaan
            'lebel_pekerjaan',
            'value_pekerjaan',
            // pendidikan
            'lebel_pendidikan',
            'value_pendidikan',
            // usaha
            'lebel_usaha',
            'value_usaha',
            // bahan bakar
            'lebel_bahan_bakar',
            'value_bahan_bakar',
            // kendaraan
            'lebel_kendaraan',
            'value_kendaraan',
            // elektronik
            'lebel_elektronik',
            'value_elektronik',
            // ternak
            'lebel_ternak',
            'value_ternak',
            // rumah
            'lebel_rumah',
            'value_rumah',
            // tipe_rumah,
            'lebel_tipe_rumah',
            'value_tipe_rumah',
            // tanah
            'lebel_tanah',
            'value_tanah',

        ));
    }
}
