<?php

namespace App\Services;

use App\Models\Resident;

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
            return $resident->groupBy('gender');
         }
         return $residents->where('gender', $gender);
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
            $age = $resident->age; // Assuming you have an age attribute in your Resident model

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
        $education = [
            'Tidak Sekolah',
            'Belum Sekolah',
            'SD/sederajat',
            'SMP/sederajat',
            'SMA/sederajat',
            'SD',
            'SMP',
            'SMA',
            'Diploma',
            'Sarjana',
            'Magister',
            'Doktor',
        ];

        $counts = $residents->countBy('education');

        return collect($education)->mapWithKeys(
            fn ($level) => [$level => $counts->get($level, 0)]
        )->filter(function($edu){
            return $edu > 0;
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
        return $trashed ?  $this->Objresident->all() : $this->Objresident->withTrashed();
    }

    
}
