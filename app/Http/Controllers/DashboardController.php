<?php

namespace App\Http\Controllers;

use App\Exports\WargaExport;
use App\Http\Requests\ResidentRequest;
use App\Models\Family;
use App\Services\ResidentService;
use App\Services\ResidentStatService;
use Maatwebsite\Excel\Facades\Excel;


class DashboardController extends Controller
{
    protected ResidentStatService $residentStat;
    protected ResidentService $resident;
    public function __construct()
    {
        $this->residentStat = new ResidentStatService;
        $this->resident = new ResidentService;
        
    }
    public function index()
    {
        $resident = $this->residentStat;
        $families = Family::all();
        return view(
            'dashboard.dashboard',
            compact(
                'resident',
                'families'
            )
        );
    }

    public function tambahData(){
        return view('dashboard.add-resident');
    }

    public function storeData(ResidentRequest $request){
        
        $this->resident->store($request);
        return redirect()->route('list-resident');
    }

    
    public function updateData(){
        return view('dashboard.update-resident');
    }


    public function listResident(){
        $residents = $this->residentStat->Objresident->latest()->paginate(15);
        return view('dashboard.list-resident', compact('residents'));
    }

    public function download_all()
    {
        return Excel::download(new WargaExport, 'data_warga.xlsx');
    }
}
