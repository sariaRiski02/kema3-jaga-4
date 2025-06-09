<?php

namespace App\Http\Controllers;

use App\Models\Kk;
use App\Services\statistik;
use App\Exports\WargaExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\dashboard_statistik;

class DashboardController extends Controller
{
    protected $dash_statistik;
    public function __construct()
    {
        $this->dash_statistik = new dashboard_statistik;
    }
    public function index()
    {
        $penduduk_aktif = $this->dash_statistik->penduduk_aktif();
        $semua_penduduk = $this->dash_statistik->semua_penduduk();
        $laki_laki = $this->dash_statistik->jenis_kelamin()->values()[0];
        $perempuan = $this->dash_statistik->jenis_kelamin()->values()[1];
        $keluarga = $this->dash_statistik->keluarga();

        return view(
            'dashboard',
            compact(
                'penduduk_aktif',
                'semua_penduduk',
                'laki_laki',
                'perempuan',
                'keluarga',
            )
        );
    }

    public function download_all()
    {
        return Excel::download(new WargaExport, 'data_warga.xlsx');
    }
}
