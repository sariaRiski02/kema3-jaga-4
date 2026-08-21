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
            'nik' => $request['nik'] ?? '',
            'name' => $request['name'] ?? '',
            'gender' => $request['gender'] ?? '',
            'place_of_birth' => $request['place_of_birth'] ?? '',
            'date_of_birth' => $request['date_of_birth'] ?? '',
            'date_of_death' => $request['date_of_death'] ?? '',
            'religion' => $request['religion'] ?? '',
            'address' => $request['address'] ?? '',
            'education' => $request['education'] ?? '',
            'family_relationship' => $request['family_relationship'] ?? '',
            'marital_status' => $request['marital_status'] ?? '',
            'occupation' => $request['occupation'] ?? ''
        ]);
    }

    


}
