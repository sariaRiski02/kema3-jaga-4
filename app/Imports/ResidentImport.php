<?php

namespace App\Imports;

use App\Models\Family;
use App\Models\FamilyRelationship;
use App\Models\Resident;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Validators\Failure;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class ResidentImport implements OnEachRow, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    private int $importedRows = 0;

    public function importedRows(): int
    {
        return $this->importedRows;
    }

    private const RELATIONSHIPS = [
        'kepala keluarga',
        'suami',
        'istri',
        'anak',
        'orang tua',
        'keponakan',
        'saudara',
        'sepupu',
        'mertua',
        'menantu',
        'cucu',
        'lainnya',
    ];

    private const RELIGIONS = [
        'islam',
        'kristen',
        'katolik',
        'hindu',
        'buddha',
        'konghucu',
        'lainnya',
    ];

    private const MARITAL_STATUSES = [
        'belum kawin',
        'kawin',
        'cerai hidup',
        'cerai mati',
    ];

    private const EDUCATION_LEVELS = [
        'tidak sekolah',
        'belum sekolah',
        'sd/sederajat',
        'smp/sederajat',
        'sma/sederajat',
        'sd',
        'smp',
        'sma',
        'diploma',
        'sarjana',
        'magister',
        'doktor',
        'lainnya',
    ];

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */



    private function normalizeGender(?string $value): ?string {
        if(empty($value)) return $value;

        $value = strtolower(trim($value));

        return match (true){
                in_array($value, ['L','l', 'laki-laki', 'laki laki', 'pria']) => 'laki-laki',
                in_array($value, ['P', 'p', 'perempuan', 'wanita']) => 'perempuan',
                default => $value, // biarkan lolos, nanti gagal di rules() kalau memang tidak valid
            };
    }


    private function normalizeFromList(?string $value, array $validOptions): ?string {
        if(empty($value)) return $value;
        $lower = strtolower(trim(preg_replace('/\s+/', ' ', $value)));

        $canonical = static function (string $text): string {
            return str_replace([' ', '/', '-', '_'], '', strtolower(trim($text)));
        };

        $aliases = [
            'budha' => 'buddha',
            'smasmk' => 'sma/sederajat',
            'smk' => 'sma/sederajat',
        ];

        $canonicalValue = $canonical($lower);
        if (isset($aliases[$canonicalValue])) {
            return $aliases[$canonicalValue];
        }

        foreach($validOptions as $option){
            if($canonicalValue === $canonical($option)){
                return $option;
            }
        }

        return $lower;
    }

    private function normalizeDate($value): ?string
    {
        if (blank($value)) {
            return null;
        }

        if ($value instanceof \DateTimeInterface) {
            return Carbon::instance($value)->format('Y-m-d');
        }

        if (is_numeric($value) && (float) $value > 0) {
            try {
                return Carbon::instance(ExcelDate::excelToDateTimeObject($value))->format('Y-m-d');
            } catch (\Throwable) {
                return (string) $value;
            }
        }

        $value = trim((string) $value);

        foreach (['d-m-Y', 'd/m/Y', 'd.m.Y', 'Y-m-d'] as $format) {
            try {
                return Carbon::createFromFormat($format, $value)->format('Y-m-d');
            } catch (\Throwable) {
                continue;
            }
        }

        return $value;
    }

    public function prepareForValidation($row, $index = null)
    {
        $normalizedRow = [];

        foreach ($row as $key => $value) {
            $normalizedRow[strtolower(trim((string) $key))] = is_string($value) ? trim($value) : $value;
        }

        $normalizedRow['jenis_kelamin']     = $this->normalizeGender($normalizedRow['jenis_kelamin'] ?? null);
        $normalizedRow['tanggal_lahir']     = $this->normalizeDate($normalizedRow['tanggal_lahir'] ?? null);
        $normalizedRow['tanggal_kematian']  = $this->normalizeDate($normalizedRow['tanggal_kematian'] ?? null);
        $normalizedRow['agama']             = $this->normalizeFromList($normalizedRow['agama'] ?? null, self::RELIGIONS);
        $normalizedRow['status_perkawinan'] = $this->normalizeFromList($normalizedRow['status_perkawinan'] ?? null, self::MARITAL_STATUSES);
        $normalizedRow['status_dikeluarga'] = $this->normalizeFromList($normalizedRow['status_dikeluarga'] ?? null, self::RELATIONSHIPS);
        $normalizedRow['pendidikan']        = $this->normalizeFromList($normalizedRow['pendidikan'] ?? null, self::EDUCATION_LEVELS);
        $normalizedRow['sedang_bersekolah'] = $this->normalizeBoolean($normalizedRow['sedang_bersekolah'] ?? false);

        return $normalizedRow;
    }

    private function normalizeBoolean($value): bool
    {
        return in_array(strtolower(trim((string) $value)), ['1', 'ya', 'yes', 'true', 'iya'], true);
    }


    public function rules(): array{
         return [
            // WAJIB
            'nik'                => ['required', 'digits:16', 'unique:residents,nik'],
            'nama'               => ['required', 'string', 'max:255'],
            'jenis_kelamin'      => ['required', Rule::in(['laki-laki', 'perempuan'])],
            'tempat_lahir'       => ['required', 'string', 'max:255'],
            'tanggal_lahir'      => ['required', 'date', 'before_or_equal:today'],

            // OPSIONAL
            'tanggal_kematian'   => ['nullable', 'date', 'after:tanggal_lahir'],
            'alamat'             => ['nullable', 'string', 'max:500'],
            'status_dikeluarga'  => ['nullable', Rule::in(self::RELATIONSHIPS)],
            'pekerjaan'          => ['nullable', 'string', 'max:255'],
            'agama'              => ['nullable', Rule::in(self::RELIGIONS)],
            'status_perkawinan'  => ['nullable', Rule::in(self::MARITAL_STATUSES)],
            'pendidikan'         => ['nullable', Rule::in(self::EDUCATION_LEVELS)],
            'sedang_bersekolah'  => ['nullable', 'boolean'],
            'no_kk'              => ['nullable', 'digits:16'],
        ];
    }

    public function customValidationMessages()
    {
        return [
            // NIK
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits'   => 'NIK harus terdiri dari 16 digit angka.',
            'nik.unique'   => 'NIK :input sudah terdaftar di database.',

            // Nama
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nama.string'   => 'Nama lengkap harus berupa teks.',
            'nama.max'      => 'Nama lengkap maksimal 255 karakter.',

            // Jenis Kelamin
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.in'       => 'Jenis kelamin harus "Laki-laki" atau "Perempuan" (bebas huruf besar/kecil).',

            // Tempat Lahir
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tempat_lahir.string'   => 'Tempat lahir harus berupa teks.',
            'tempat_lahir.max'      => 'Tempat lahir maksimal 255 karakter.',

            // Tanggal Lahir
            'tanggal_lahir.required'         => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date'             => 'Format tanggal lahir tidak valid.',
            'tanggal_lahir.before_or_equal'  => 'Tanggal lahir tidak boleh di masa depan.',

            // Tanggal Kematian
            'tanggal_kematian.date'  => 'Format tanggal kematian tidak valid.',
            'tanggal_kematian.after' => 'Tanggal kematian harus setelah tanggal lahir.',

            // Alamat
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max'    => 'Alamat maksimal 500 karakter.',

            // Status di Keluarga
            'status_dikeluarga.in' => 'Status dalam keluarga harus salah satu dari: '
                . implode(', ', array_map('ucwords', self::RELATIONSHIPS)) . '.',

            // Pekerjaan
            'pekerjaan.string' => 'Pekerjaan harus berupa teks.',
            'pekerjaan.max'    => 'Pekerjaan maksimal 255 karakter.',

            // Agama
            'agama.in' => 'Agama harus salah satu dari: '
                . implode(', ', array_map('ucwords', self::RELIGIONS)) . '.',

            // Status Perkawinan
            'status_perkawinan.in' => 'Status perkawinan harus salah satu dari: Belum Kawin, Kawin, Cerai Hidup, atau Cerai Mati.',

            // Pendidikan
            'pendidikan.in' => 'Pendidikan harus salah satu dari: '
                . implode(', ', array_map('ucwords', self::EDUCATION_LEVELS)) . '.',

            // No. KK
            'no_kk.digits' => 'No. KK harus terdiri dari 16 digit angka.',
        ];
    }


    public function onRow(Row $row)
    {
        $data = $this->prepareForValidation($row->toArray());

        $nik = $data['nik'] ?? null;
        if (empty($nik)) {
            return null;
        }

        $resident = Resident::where('nik', $nik)->first();

        if (!$resident) {
            $education = $data['pendidikan'] ?? null;

            $resident = Resident::create([
                'name' => $data['nama'] ?? null,
                'nik' => $nik,
                'gender' => $data['jenis_kelamin'] ?? null,
                'place_of_birth' => $data['tempat_lahir'] ?? null,
                'date_of_birth' => $data['tanggal_lahir'] ?? null,
                'date_of_death' => $data['tanggal_kematian'] ?? null,
                'address' => $data['alamat'] ?? null,
                'occupation' => $data['pekerjaan'] ?? null,
                'religion' => $data['agama'] ?? null,
                'marital_status' => $data['status_perkawinan'] ?? null,
                'education' => $education,
                'is_currently_studying' => $data['sedang_bersekolah'] ?? false,
            ]);
        }

        $family = null;
        $noKk = $data['no_kk'] ?? null;
        if (!empty($noKk)) {
            $family = Family::firstOrCreate(['family_number' => $noKk]);
        }

        $familyRelationship = null;
        if ($family && !empty($data['status_dikeluarga'])) {
            $familyRelationship = FamilyRelationship::firstOrCreate([
                'family_id' => $family->id,
                'resident_id' => $resident->id,
            ], [
                'family_relationship' => $data['status_dikeluarga'],
            ]);
        }

        $this->importedRows++;

        return (object) [$resident, $family, $familyRelationship];
    }

}
