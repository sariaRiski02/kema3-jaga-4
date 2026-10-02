<?php

namespace App\Livewire;

use App\Models\Resident;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class ResidentList extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedNiks = [];
    public $selectAll = false;

    protected $listeners = [
        'deleteResidentAction' => 'deleteResident',
        'confirmBulkDeleteAction' => 'bulkDeleteConfirmed',
    ];

    public function mount()
    {
        $this->search = request('search', '');
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function getResidentsProperty()
    {
        $query = Resident::query();

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('nik', 'like', "%{$this->search}%")
                    ->orWhere('name', 'like', "%{$this->search}%")
                    ->orWhere('gender', 'like', "%{$this->search}%");

                if (ctype_digit($this->search)) {
                    $age = (int) $this->search;
                    $today = Carbon::today();

                    $q->orWhere(function ($ageQuery) use ($age, $today) {
                        $ageQuery
                            ->whereDate('date_of_birth', '<=', $today->copy()->subYears($age))
                            ->whereDate('date_of_birth', '>', $today->copy()->subYears($age + 1));
                    });
                }
            });
        }

        return $query->latest()->paginate(15);
    }

    public function updatedSelectAll()
    {
        if ($this->selectAll) {
            $this->selectedNiks = $this->residents->pluck('nik')->toArray();
        } else {
            $this->selectedNiks = [];
        }
    }

    public function updatedSelectedNiks()
    {
        $this->updateSelectAll();
    }

    public function updateSelectAll()
    {
        $currentNiks = $this->residents->pluck('nik')->toArray();
        $this->selectAll = !empty($this->selectedNiks) && 
                          count(array_intersect($this->selectedNiks, $currentNiks)) === count($currentNiks);
    }

    public function deleteResident($nik)
    {
        try {
            $resident = Resident::findOrFail($nik);
            $name = $resident->name;
            $resident->delete();
            
            $this->selectedNiks = array_filter($this->selectedNiks, fn ($n) => $n !== $nik);
            $this->updateSelectAll();
            
            $this->dispatch('notify', ['type' => 'success', 'message' => "Data warga \"$name\" berhasil dihapus"]);
            $this->resetPage();
        } catch (\Exception $e) {
            $this->dispatch('notify', ['type' => 'error', 'message' => 'Gagal menghapus data']);
        }
    }

    public function bulkDeleteConfirmed($niks)
    {
        try {
            $count = count($niks);
            Resident::whereIn('nik', $niks)->delete();
            
            $this->selectedNiks = [];
            $this->selectAll = false;
            
            $this->dispatch('notify', ['type' => 'success', 'message' => "Berhasil menghapus $count data warga"]);
            $this->resetPage();
        } catch (\Exception $e) {
            $this->dispatch('notify', ['type' => 'error', 'message' => 'Gagal menghapus data']);
        }
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.resident-list', [
            'residents' => $this->residents,
        ]);
    }
}

