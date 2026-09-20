<?php

namespace App\Services;

use App\Models\Family;
use App\Models\Resident;
use Illuminate\Support\Collection;

class ResidentStatService
{
    /**
     * Create a new class instance.
     */
    public Resident $Objresident;
    public function __construct()
    {
        $this->Objresident = new Resident();
    }


    public function getGender($gender = ''){
        $gender = strtolower($gender);
        $residents = $this->Objresident->all();
         if(!$gender) {
            return $residents->groupBy('gender');
         }
         return $residents->where('gender', $gender);
    }

    public function dashboardSummary(): array
    {
        $residents = Resident::with('familyRelationship')->get();
        $activeResidents = $residents->whereNull('deleted_at');

        $ageGroups = collect([
            'Anak-anak (0-12 tahun)' => 0,
            'Remaja (13-17 tahun)' => 0,
            'Dewasa (18-59 tahun)' => 0,
            'Lansia (60+ tahun)' => 0,
            'Belum diketahui' => 0,
        ]);

        foreach ($activeResidents as $resident) {
            $age = $resident->age?->years;

            if ($age === null) {
                $ageGroups->put('Belum diketahui', $ageGroups->get('Belum diketahui') + 1);
            } elseif ($age <= 12) {
                $ageGroups->put('Anak-anak (0-12 tahun)', $ageGroups->get('Anak-anak (0-12 tahun)') + 1);
            } elseif ($age <= 17) {
                $ageGroups->put('Remaja (13-17 tahun)', $ageGroups->get('Remaja (13-17 tahun)') + 1);
            } elseif ($age <= 59) {
                $ageGroups->put('Dewasa (18-59 tahun)', $ageGroups->get('Dewasa (18-59 tahun)') + 1);
            } else {
                $ageGroups->put('Lansia (60+ tahun)', $ageGroups->get('Lansia (60+ tahun)') + 1);
            }
        }

        return [
            'total_active' => $activeResidents->count(),
            'total_recorded' => Resident::withTrashed()->count(),
            'total_families' => Family::count(),
            'male' => $activeResidents->where('gender', 'laki-laki')->count(),
            'female' => $activeResidents->where('gender', 'perempuan')->count(),
            'alive' => $activeResidents->whereNull('date_of_death')->count(),
            'deceased' => $activeResidents->whereNotNull('date_of_death')->count(),
            'without_family' => $activeResidents->filter(fn ($resident) => !$resident->familyRelationship)->count(),
            'age_groups' => $ageGroups->filter(fn ($count, $label) => $count > 0 || $label === 'Belum diketahui'),
            'religions' => $this->groupValues($activeResidents, 'religion'),
            'education' => $this->educationSummary($activeResidents),
            'marital_status' => $this->groupValues($activeResidents, 'marital_status'),
            'occupations' => $this->groupValues($activeResidents, 'occupation'),
        ];
    }

    private function educationSummary(Collection $residents): array
    {
        return [
            'sedang_sekolah' => $this->educationCounts(
                $residents->where('is_currently_studying', true)
            ),
            'sudah_lulus' => $this->educationCounts(
                $residents->where('is_currently_studying', false)
            ),
        ];
    }

    private function educationCounts(Collection $residents): Collection
    {
        return $residents
            ->map(fn ($resident) => filled($resident->education)
                ? ucwords($resident->education)
                : 'Belum diisi')
            ->countBy()
            ->sortDesc();
    }

    private function groupValues(Collection $residents, string $field): Collection
    {
        return $residents
            ->map(function ($resident) use ($field) {
                if (!filled($resident->{$field})) {
                    return 'Belum diisi';
                }

                if ($field === 'education') {
                    return $this->formatEducationLabel($resident->{$field});
                }

                return ucwords($resident->{$field});
            })
            ->countBy()
            ->sortDesc();
    }

    public function getGenderPercentage($gender = ''){
        $gender = strtolower($gender);
        $residents = $this->Objresident->all();
        $genderCount = $residents->where('gender', $gender)->count();
        $totalCount = $residents->count();
        return $totalCount > 0 ? number_format(($genderCount / $totalCount) * 100, 2) : 0;
    }

    public function count(){
        
        $residents = $this->Objresident->all();
        return $residents->count();
    }

    public function age_clasification(){
        $residents = $this->Objresident->all();
        
        $ageGroups = [
            '0-12' => 0, // anak-anak
            '13-17' => 0, // remaja
            '18-59' => 0, // dewasa 
            '60+' => 0,  // lansia
        ];



        foreach ($residents as $resident) {
            $age = $resident->age->years; // Assuming you have an age attribute in your Resident model
            if ($age >= 0 && $age <= 12) {
                $ageGroups['0-12']++;
            } elseif ($age >= 13 && $age <= 17) {
                $ageGroups['13-17']++;
            } elseif ($age >= 18 && $age <= 59) {
                $ageGroups['18-59']++;
            } elseif ($age >= 60) {
                $ageGroups['60+']++;
            }
        }
        return $ageGroups;
    }


    public function education_group(){
        
        $residents = $this->Objresident->all();
        $educationsOrder = [
            'tidak sekolah',
            'belum sekolah',
            'sd/sederajat',
            'smp/sederajat',
            'sma/sederajat',
            'sd',
            'smp',
            'sma',
            'diploma',
            'sarjana',
            'magister',
            'doktor',
        ];

        $education = $residents->countBy('education')->filter(function ($count) {
            return $count > 0;
        });

        $sorted = collect($educationsOrder)->mapWithKeys(function ($key) use ($education) {
            return [ucwords($key) => $education->get($key, 0)];
        });

        return $sorted->filter(function ($count) {
            return $count > 0;
        });
    
    }

    public function occupation_group(){
        $residents = $this->Objresident->all();
        $occupations = $residents->pluck('occupation')->unique()->filter();
        $counts = $residents->countBy('occupation');

        return $occupations->mapWithKeys(
            fn ($occupation) => [$occupation => $counts->get($occupation, 0)]
        )->filter(function($occ){
            return $occ > 0;
        });
    }

    public function getAll($trashed = false){
        return $trashed ? $this->Objresident->withTrashed() :  $this->Objresident->all();
    }

    
}
