<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ResidentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
    * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'nik' => ['required', 'digits:16', 'unique:residents,nik'],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:laki-laki,perempuan'],
            'place_of_birth' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date', 'before_or_equal:today'],
            'religion' => ['nullable','in:islam,kristen,katolik,hindu,buddha,konghucu,lainnya'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'marital_status' => ['nullable', 'in:belum kawin,kawin,cerai hidup,cerai mati'],
            'family_number' => ['nullable', 'digits:16'],
            'family_relationship' => ['nullable', 'in:kepala keluarga,suami,istri,anak,orang tua,keponakan,saudara,sepupu,mertua,menantu,cucu,lainnya'],
            'date_of_death' => ['nullable', 'date', 'after_or_equal:date_of_birth'],
            'address' => ['nullable', 'string', 'max:255'],
            'education' => [
                'nullable',
                'in:tidak sekolah,sd,smp,sma,sd/sederajat,sma/sederajat,diploma,sarjana,magister,doktor,lainnya',
            ],
            'is_currently_studying' => ['boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'date_of_birth' => $this->normalizeDate($this->input('date_of_birth')),
            'date_of_death' => $this->normalizeDate($this->input('date_of_death')),
        ]);
    }

    private function normalizeDate(?string $value): ?string
    {
        if (blank($value)) {
            return null;
        }

        foreach (['d-m-Y', 'Y-m-d'] as $format) {
            try {
                return Carbon::createFromFormat($format, $value)->format('Y-m-d');
            } catch (\Throwable) {
                continue;
            }
        }

        return $value;
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'unique' => ':attribute sudah terdaftar.',
            'string' => ':attribute harus berupa teks.',
            'max' => ':attribute maksimal :max karakter.',
            'digits' => ':attribute harus terdiri dari :digits digit.',
            'date' => ':attribute harus berupa tanggal yang valid.',
            'before_or_equal' => ':attribute tidak boleh melebihi hari ini.',
            'after_or_equal' => ':attribute harus sama atau setelah tanggal lahir.',
            'in' => ':attribute yang dipilih tidak valid.',
        ];
    }

    public function attributes(): array
    {
        return [
            'nik' => 'NIK',
            'name' => 'nama lengkap',
            'gender' => 'jenis kelamin',
            'place_of_birth' => 'tempat lahir',
            'date_of_birth' => 'tanggal lahir',
            'religion' => 'agama',
            'occupation' => 'pekerjaan',
            'marital_status' => 'status perkawinan',
            'family_number' => 'nomor KK',
            'family_relationship' => 'status dalam keluarga',
            'date_of_death' => 'tanggal kematian',
            'address' => 'alamat',
            'education' => 'pendidikan terakhir',
        ];
    }
}
