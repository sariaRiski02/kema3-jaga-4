<?php

namespace App\Exports;

use App\Models\Resident;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ResidentExport extends DefaultValueBinder implements FromCollection, WithMapping, WithHeadings,WithCustomValueBinder, WithColumnWidths, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Resident::all();
    }

    public function headings(): array
    {
        return [
            "NIK",
            "Nama",
            "Usia",
            "Jenis Kelamin",
            "Tempat Lahir",
            "Tanggal Lahir",
            "Tanggal Meninggal",
            "Alamat",
            "Pekerjaan",
            "Agama",
            "Status Perkawinan",
            "Pendidikan",
            "Status"
        ];
    }

    public function map($resident): array
    {
        return [
            (string) $resident->nik,
            ucwords($resident->name),
            $resident->age ? "{$resident->age->years} Tahun" : null,
            ucwords($resident->gender),
            ucwords($resident->place_of_birth),
            $resident->date_of_birth ? $resident->date_of_birth->format('d-m-Y') : null,
            $resident->date_of_death ? $resident->date_of_death->format('d-m-Y') : null,
            (string) $resident->address,
            ucwords($resident->occupation),
            ucwords($resident->religion),
            ucwords($resident->marital_status),
            ucwords($resident->education),
            $resident->date_of_death ? 'Meninggal' : 'Hidup',
        ];
    }

    


    public function bindValue(Cell $cell, $value)
    {
        if ($cell->getColumn() === 'A') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);
            return true;
        }

        return parent::bindValue($cell, $value);
    }
    

    public function columnWidths(): array
    {
        return [
            'A' => 20, // NIK
            'B' => 30, // Nama
            'C' => 15, // Usia
            'D' => 15, // Jenis Kelamin
            'E' => 20, // Tempat Lahir
            'F' => 20, // Tanggal Lahir
            'G' => 20, // Tanggal Meninggal
            'H' => 50, // Alamat
            'I' => 30, // Pekerjaan
            'J' => 20, // Agama
            'K' => 25, // Status Perkawinan
            'L' => 25, // Pendidikan
            'M' => 15, // Status
        ];
    }

     public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }
     // Font default untuk seluruh sheet
    public function defaultStyles(Style $defaultStyle)
    {
        return [
            'font' => [
                'name' => 'Roboto',
                'size' => 11,
            ],
        ];
    }
   
}
