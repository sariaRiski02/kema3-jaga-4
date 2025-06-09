<?php

namespace App\Exports;

use App\Models\Warga;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WargaExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Pilih kolom yang ingin diexport, urutkan sesuai heading
        return Warga::join('kk', 'warga.kk_id', '=', 'kk.id')->select([
            'nama',
            'nik',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'tanggal_kematian',
            'alamat',
            'status_keluarga',
            'pekerjaan',
            'agama',
            'status_perkawinan',
            'pendidikan',
            'kk.no_kk'
        ])->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIK',
            'Jenis Kelamin',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Tanggal Kematian',
            'Alamat',
            'Status Keluarga',
            'Pekerjaan',
            'Agama',
            'Status Perkawinan',
            'Pendidikan',
            'ID KK'
        ];
    }
}
