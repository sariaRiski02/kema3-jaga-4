<?php

namespace App\Exports;

use App\Models\Family;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class FamilyExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithMapping, WithCustomValueBinder
{
    public function collection()
    {
        return Family::with('headFamily.resident')->get();
    }

    public function headings(): array
    {
        return [
            'Nomor KK',
            'Kepala Keluarga',
            'NIK Kepala Keluarga',
            'Jumlah Anggota',
        ];
    }

    public function map($family): array
    {
        return [
            (string) ($family->family_number ?? ''),
            $family->headFamily?->resident?->name ?? 'Belum ada',
            (string) ($family->headFamily?->resident?->nik ?? ''),
            $family->residents()->count(),
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if (in_array($cell->getColumn(), ['A', 'C'], true)) {
            $cell->setValueExplicit((string) $value, DataType::TYPE_STRING);
            return true;
        }

        return parent::bindValue($cell, $value);
    }
}
