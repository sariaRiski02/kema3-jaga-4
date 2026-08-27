<?php

namespace App\Imports;

use App\Events\ImportCompleted;
use App\Models\Family;
use App\Models\FamilyRelationship;
use App\Models\Resident;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Validators\Failure;

class ResidentImport implements OnEachRow, WithHeadingRow, WithValidation, ShouldQueue, WithChunkReading, SkipsOnFailure,WithEvents
{
    use SkipsFailures;

    public function __construct(public ?int $userId = null) {}

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
        $lower = strtolower(trim($value));

        foreach($validOptions as $option){
            if($lower === $option){
                return $option;
            }
        }

        return $lower;
    }

    public function prepareForValidation($row, $index = null)
    {
        $row = array_map(fn($v) => is_string($v) ? trim($v) : $v, $row);

        $row['jenis_kelamin']     = $this->normalizeGender($row['jenis_kelamin'] ?? null);
        $row['agama']             = $this->normalizeFromList($row['agama'] ?? null, self::RELIGIONS);
        $row['status_perkawinan'] = $this->normalizeFromList($row['status_perkawinan'] ?? null, self::MARITAL_STATUSES);
        $row['status_dikeluarga'] = $this->normalizeFromList($row['status_dikeluarga'] ?? null, self::RELATIONSHIPS);

        return $row;
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
            'pendidikan'         => ['nullable', 'string', 'max:255'],
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
            'pendidikan.string' => 'Pendidikan harus berupa teks.',
            'pendidikan.max'    => 'Pendidikan maksimal 255 karakter.',

            // No. KK
            'no_kk.digits' => 'No. KK harus terdiri dari 16 digit angka.',
        ];
    }


    public function onRow(Row $row)
    {
        // 1. Tambahkan counter di cache setiap kali baris diproses
        $cacheKey = 'import_rows_' . ($this->userId ?? 'guest');
        Cache::increment($cacheKey);

        $row = $row->toArray();
        $data = $this->prepareForValidation($row);

        $resident = Resident::where('nik', $data['nik'])->first();

        if(!$resident){
            $resident  = Resident::create([
                'name' => $data['nama'],
                'nik' => $data['nik'],
                'gender' => $data['jenis_kelamin'],
                'date_of_birth' => $data['tanggal_lahir'],
                'date_of_death' => $data['tanggal_kematian'] ?? null,
                'address' => $data['alamat'] ?? null,
                'occupation' => $data['pekerjaan'] ?? null,
                'religion' => $data['agama'] ?? null,
                'marital_status' => $data['status_perkawinan'] ?? null,
                'education' => $data['pendidikan'] ?? null,
            ]);
        }

        $family = null;
        if (!empty($data['no_kk'])) {
            $family = Family::firstOrCreate(['family_number' => $data['no_kk']]);
        }

        $familyRelationship = null;
        if ($family) {
            $familyRelationship = FamilyRelationship::firstOrCreate([
                'family_id'   => $family->id,
                'resident_id' => $resident->id,
            ], [
                'family_relationship' => $data['status_dikeluarga'] ?? null,
            ]);
        }
        return (object) [$resident, $family, $familyRelationship];
    }

    public function chunkSize(): int{
        return 200;
    }

    public function registerEvents(): array
    {
        return [
            AfterImport::class => function(AfterImport $event) {
                $userId = $this->userId ?? 1;
                $cacheKey = 'import_rows_' . $userId;
                
                // 2. Ambil total baris dari cache, lalu hapus cache-nya agar bersih
                $totalRows = Cache::get($cacheKey, 0);
                Cache::forget($cacheKey);

                // 3. Broadcast event dengan data yang valid
                broadcast(new ImportCompleted(
                    userId: $userId,
                    totalRows: $totalRows,
                    failedRows: count($this->failures()),
                    errors: $this->failures()->toArray()
                ));
            }
        ];
    }
}
