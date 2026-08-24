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
            'address' => $request['address'] ?? null,
            'education' => $request['education'] ?? null,
            'occupation' => $request['occupation'] ?? null
        ]);
    }

    


}
