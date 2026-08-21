<?php

namespace App\Imports;

use App\Models\Family;
use App\Models\Resident;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ResidentImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        $family  = Family::where('number_family',$row['no_kk'])->first();
        if(!$family){
            $family = Family::create(['family_number' => $row['no_kk']]);
        }

        $row = array_map('strtolower',$row);
       
        return new Resident([
            'name' => $row['nama'],
            'nik' => $row['nik'],
            'place_of_birth' => $row['tempat_lahir'],
            'date_of_birth' => $row['tanggal_lahir'],
            'date_of_death' => $row['tanggal_kematian'],
            'address' => $row['alamat'],
            'family_relationship' => $row['status_keluarga'],
            'occupation' => $row['pekerjaan'],
            'religion' => $row['agama'],
            'marital_status' => $row['status_perkawinan'],
            'education' => $row['pendidikan'],
            'family_id' => $family->id,
            'gender' => strtolower($row['jenis_kelamin']),
        ]);


    }
}
