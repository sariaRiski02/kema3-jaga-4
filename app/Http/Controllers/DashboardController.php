<?php

namespace App\Http\Controllers;


use App\Http\Requests\ResidentRequest;
use App\Http\Requests\ResidentUpdateRequest;
use App\Imports\ResidentImport;
use App\Models\Family;
use App\Models\Resident;
use App\Services\ResidentService;
use App\Services\ResidentStatService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class DashboardController extends Controller
{
    protected ResidentStatService $residentStat;
    protected ResidentService $resident;
    public function __construct()
    {
        $this->residentStat = new ResidentStatService;
        $this->resident = new ResidentService; 
    }

    // Home Dashboard
    public function home()
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

    // List Resident
    public function listResident(){
        $residents = $this->residentStat->Objresident->latest()->paginate(15);

        return view('dashboard.list-resident', compact('residents'));
    }
    
    public function showResident(Resident $resident){
        $resident = $resident->load('family');
        $resident->initial = implode(array_map(function($name){
            return substr($name, 0, 1);
        }, explode(' ', $resident->name)));
        
        return view('dashboard.show-resident', compact('resident'));
    }

    public function addResident(){
        return view('dashboard.add-resident');
    }

    public function storeResident(ResidentRequest $request){
        $this->resident->store($request);
        return redirect()->route('dashboard.list-resident');
    }

    public function editResident(string $nik){
        $resident = Resident::where('nik', $nik)->firstOrFail();
        return view('dashboard.update-resident', compact('resident'));
    }

    public function updateResident(ResidentUpdateRequest $request, string $nik){
        
        $this->resident->update($request, $nik);
        return redirect()->route('dashboard.list-resident');
    }

    public function deleteResident(Resident $resident){
        if($resident->delete()){
            return redirect()->route('dashboard.list-resident');
        }
    }

    public function bulkDestroy(Request $request)
    {
        $validated = $request->validate([
            'niks' => ['required', 'array', 'min:1'],
            'niks.*' => ['string', 'exists:residents,nik'],
        ]);

        Resident::whereIn('nik', $validated['niks'])->delete();

        return response()->json(['success' => true]);
    }


    public function exportResident(Resident $resident){
        
       return Pdf::loadView('dashboard.export-resident', compact('resident'))
            ->setPaper('a4', 'portrait')
            ->setOption('margin-top', 3)
            ->setOption('margin-bottom', 3)
            ->setOption('margin-left', 3)
            ->setOption('margin-right', 3)
            ->download($resident->nik . '_data_warga.pdf');
        
    }

    public function importResident(){
        return view('dashboard.import-resident');
    }

    public function storeImportResident(Request $request){
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:50240']
        ]);
        $path = $request->file('file')->store('imports');
        Excel::queueImport(new ResidentImport(), $path);
        return redirect()->route('dashboard.add-resident')->with('status', 'loading');
    }

    

    public function downloadTemplate(){
        return response()->download(public_path('template_warga.xlsx'));
    }



    // Family Resident
    public function addFamily(){
        return view('dashboard.add-family');
    }

    public function listFamily(){
        $families = Family::latest()->paginate(15);
        return view('dashboard.list-family', compact('families'));
    }




}
