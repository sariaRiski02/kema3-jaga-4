<?php

namespace App\Http\Requests;

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
            'nik' => ['required', 'digits:16'],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:laki-laki,perempuan'],
            'place_of_birth' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date', 'before_or_equal:today'],
            'religion' => ['required', 'in:islam,kristen,katolik,hindu,buddha,konghucu,lainnya'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'marital_status' => ['nullable', 'in:belum kawin,kawin,cerai hidup,cerai mati'],
            'family_number' => ['nullable', 'digits:16'],
            'family_relationship' => ['nullable', 'in:kepala keluarga,istri,anak,orangtua,mertua,keponakan,cucu,saudara,lainnya'],
            'date_of_death' => ['nullable', 'date', 'after_or_equal:date_of_birth'],
            'address' => ['required', 'string', 'max:255'],
            'education' => [
                'required',
                'in:tidak sekolah,sd,smp,sma,sd/sederajat,sma/sederajat,diploma,sarjana,magister,doktor,lainnya',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
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
