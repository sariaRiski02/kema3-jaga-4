<?php

namespace App\Http\Controllers;


use App\Http\Requests\ResidentRequest;
use App\Imports\ResidentImport;
use App\Models\Family;
use App\Models\Resident;
use App\Services\ResidentService;
use App\Services\ResidentStatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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

    public function show(Resident $resident){
        $resident = $resident->load('family');
        $resident->initial = implode(array_map(function($name){
            return substr($name, 0, 1);
        }, explode(' ', $resident->name)));

        
        $headOfFamily = $resident->family?->resident->firstWhere('family_relationship', 'kepala keluarga');
        
        
        return view('dashboard.show-resident', compact('resident', 'headOfFamily'));
    }
    public function importData(Request $request){
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:50240']
        ]);
        $userId = auth()->id() ?? 1;
        // Reset counter cache untuk user ini sebelum import dimulai
        Cache::forget('import_rows_' . $userId);
        $path = $request->file('file')->store('imports');
        // Kirim userId ke constructor
        Excel::queueImport(new ResidentImport($userId), $path);
        return redirect()->route('add-resident')->with('status', 'loading');
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
