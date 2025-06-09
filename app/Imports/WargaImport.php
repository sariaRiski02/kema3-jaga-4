<?php

namespace App\Imports;

use App\Models\Warga;
use App\Models\Kk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WargaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Normalisasi ke lowercase untuk enum agar konsisten dengan DB
        $enumFields = [
            'jenis_kelamin',
            'status_keluarga',
            'agama',
            'status_perkawinan',
            'pendidikan'
        ];
        foreach ($enumFields as $field) {
            if (isset($row[$field])) {
                // Mapping khusus untuk agama: katolik -> kristen
                if ($field === 'agama' && strtolower(trim($row[$field])) === 'katolik') {
                    $row[$field] = 'kristen';
                } else {
                    $row[$field] = strtolower(trim($row[$field]));
                }
            }
        }
        // Cari atau buat KK
        $kk = Kk::firstOrCreate(['no_kk' => $row['no_kk']]);
        return new Warga([
            'nama' => $row['nama'],
            'nik' => $row['nik'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir' => $row['tanggal_lahir'],
            'tanggal_kematian' => $row['tanggal_kematian'] ?? null,
            'alamat' => $row['alamat'],
            'status_keluarga' => $row['status_keluarga'],
            'pekerjaan' => $row['pekerjaan'],
            'agama' => $row['agama'],
            'status_perkawinan' => $row['status_perkawinan'],
            'pendidikan' => $row['pendidikan'],
            'kk_id' => $kk->id,
        ]);
    }
}
