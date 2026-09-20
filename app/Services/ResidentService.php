<?php

namespace App\Services;

use App\Models\Resident;

class ResidentService
{
    /**
     * Create a new class instance.
     */

    public Resident $residentObj;
    public function __construct()
    {
        $this->residentObj = new Resident;
    }

    public function store($request){
        
        Resident::create([
            'nik' => $request['nik'] ?? null,
            'name' => $request['name'] ?? null,
            'gender' => $request['gender'] ?? null,
            'place_of_birth' => $request['place_of_birth'] ?? null,
            'date_of_birth' => $request['date_of_birth'] ?? null,
            'date_of_death' => $request['date_of_death'] ?? null,
            'religion' => $request['religion'] ?? null,
            'marital_status' => $request['marital_status'] ?? null,
            'address' => $request['address'] ?? null,
            'education' => $request['education'] ?? null,
            'is_currently_studying' => (bool) ($request['is_currently_studying'] ?? false),
            'occupation' => $request['occupation'] ?? null
        ]);
    }


    public function update($request, $nik){
        
        $resident = Resident::where('nik', $nik)->first();
        
        if ($resident) {
            $resident->update([
                'nik' => $request['nik'] === $resident->nik ? $resident->nik : $request['nik'],
                'name' => $request['name'] ?? $resident->name,
                'gender' => $request['gender'] ?? $resident->gender,
                'place_of_birth' => $request['place_of_birth'] ?? $resident->place_of_birth,
                'date_of_birth' => $request['date_of_birth'] ?? $resident->date_of_birth,
                'date_of_death' => $request['date_of_death'] ?? $resident->date_of_death,
                'religion' => $request['religion'] ?? $resident->religion,
                'marital_status' => $request['marital_status'] ?? $resident->marital_status,
                'address' => $request['address'] ?? $resident->address,
                'education' => $request['education'] ?? $resident->education,
                'is_currently_studying' => (bool) ($request['is_currently_studying'] ?? false),
                'occupation' => $request['occupation'] ?? $resident->occupation
            ]);
        }
    }
}
