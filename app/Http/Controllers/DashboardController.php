<?php

namespace App\Http\Controllers;


use App\Http\Requests\ResidentRequest;
use App\Imports\ResidentImport;
use App\Models\Family;
use App\Services\ResidentService;
use App\Services\ResidentStatService;
use Illuminate\Http\Request;
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

    public function importData(Request $request){
        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv',
                'max:10240'
            ]
        ]);
        

        Excel::import(new ResidentImport, $request->file('file'));

        return back()->with('success', 'Data Warga Berhasil diimport');
        // $path = $request->file('file')->store('imports');
        
        
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

    public function downloadTemplate(){
        return response()->download(public_path('template_warga.xlsx'));
    }
}
