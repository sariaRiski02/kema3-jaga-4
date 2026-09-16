<?php

namespace App\Http\Controllers;


use App\Exports\ResidentExport;
use App\Http\Requests\ResidentRequest;
use App\Http\Requests\ResidentUpdateRequest;
use App\Imports\ResidentImport;
use App\Models\Family;
use App\Models\Resident;
use App\Services\ResidentService;
use App\Services\ResidentStatService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

    public function exportAllResident()
    {
        return Excel::download(new ResidentExport, 'data_warga.xlsx');
        
    }

    // List Resident
    public function listResident(Request $request){
        $search = trim((string) $request->input('search', ''));
        $query = $this->residentStat->Objresident->newQuery();

        if ($search !== '') {
            $query->where(function ($residentQuery) use ($search) {
                $residentQuery
                    ->where('nik', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('gender', 'like', "%{$search}%");

                if (ctype_digit($search)) {
                    $age = (int) $search;
                    $today = Carbon::today();

                    $residentQuery->orWhere(function ($ageQuery) use ($age, $today) {
                        $ageQuery
                            ->whereDate('date_of_birth', '<=', $today->copy()->subYears($age))
                            ->whereDate('date_of_birth', '>', $today->copy()->subYears($age + 1));
                    });
                }
            });
        }

        $residents = $query->latest()->paginate(15)->withQueryString();

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
