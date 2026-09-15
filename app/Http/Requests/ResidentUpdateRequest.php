<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ResidentUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nik' => ['digits:16'],
            'name' => ['string', 'max:255'],
            'gender' => ['in:laki-laki,perempuan'],
            'place_of_birth' => ['string', 'max:255'],
            'date_of_birth' => ['date', 'before_or_equal:today'],
            'religion' => ['nullable','in:islam,kristen,katolik,hindu,buddha,konghucu,lainnya'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'marital_status' => ['nullable', 'in:belum kawin,kawin,cerai hidup,cerai mati'],
            'family_number' => ['nullable', 'digits:16'],
            'family_relationship' => ['nullable', 'in:kepala keluarga,istri,anak,orangtua,mertua,keponakan,cucu,saudara,lainnya'],
            'date_of_death' => ['nullable', 'date', 'after_or_equal:date_of_birth'],
            'address' => ['nullable', 'string', 'max:255'],
            'education' => [
                'nullable',
                'in:tidak sekolah,sd,smp,sma,sd/sederajat,sma/sederajat,diploma,sarjana,magister,doktor,lainnya',
            ],
        ];
    }
}
