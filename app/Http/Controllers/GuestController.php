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

        ));
    }
}
