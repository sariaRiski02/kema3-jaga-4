<?php

namespace App\Http\Controllers;

use App\Exports\WargaExport;
use App\Models\Family;
use App\Services\ResidentStatService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class DashboardController extends Controller
{
    protected ResidentStatService $resident;
    public function __construct()
    {
        $this->resident = new ResidentStatService;
    }
    public function index()
    {

        $resident = $this->resident;
        $family = Family::all();
        return view(
            'dashboard.dashboard',
            compact(
                'resident',
                'family'
            )

        );
    }

    public function tambahData(){
        return view('dashboard.tambah-data');
    }


    public function listResident(){
        return view('dashboard.data-warga');
    }

    public function download_all()
    {
        return Excel::download(new WargaExport, 'data_warga.xlsx');
    }
}
