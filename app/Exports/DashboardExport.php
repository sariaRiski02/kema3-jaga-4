<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DashboardExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
{
    public function __construct(private readonly array $stats)
    {
    }

    public function headings(): array
    {
        return ['Bagian', 'Kategori', 'Jumlah'];
    }

    public function array(): array
    {
        $rows = [
            ['Ringkasan', 'Penduduk aktif', $this->stats['total_active']],
            ['Ringkasan', 'Total keluarga', $this->stats['total_families']],
            ['Ringkasan', 'Laki-laki', $this->stats['male']],
            ['Ringkasan', 'Perempuan', $this->stats['female']],
            ['Ringkasan', 'Masih hidup', $this->stats['alive']],
            ['Ringkasan', 'Meninggal', $this->stats['deceased']],
            ['Ringkasan', 'Belum terhubung keluarga', $this->stats['without_family']],
            ['Ringkasan', 'Seluruh riwayat data', $this->stats['total_recorded']],
        ];

        foreach ($this->stats['age_groups'] as $label => $count) {
            $rows[] = ['Kelompok umur', $label, $count];
        }

        foreach ($this->stats['religions'] as $label => $count) {
            $rows[] = ['Agama', $label, $count];
        }

        foreach ($this->stats['education']['sedang_sekolah'] as $label => $count) {
            $rows[] = ['Pendidikan - sedang bersekolah', $label, $count];
        }

        foreach ($this->stats['education']['sudah_lulus'] as $label => $count) {
            $rows[] = ['Pendidikan - sudah lulus', $label, $count];
        }

        foreach ($this->stats['marital_status'] as $label => $count) {
            $rows[] = ['Status perkawinan', $label, $count];
        }

        foreach ($this->stats['occupations'] as $label => $count) {
            $rows[] = ['Pekerjaan', $label, $count];
        }

        return $rows;
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '6D28D9']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
            ],
        ];
    }
}
