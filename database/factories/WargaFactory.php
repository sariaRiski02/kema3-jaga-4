<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warga>
 */
class WargaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // for nik
        $jenis_kelamin = $this->faker->randomElement(['Laki-Laki', 'Perempuan']);
        $tanggal_lahir = (int) $this->faker->date('d');
        $bulan_lahir = $this->faker->date('m');
        $tahun_lahir = $this->faker->date('y');
        $tanggal_lahir_nik = $jenis_kelamin === 'Perempuan' ? $tanggal_lahir += 40 : $tanggal_lahir;

        $nik = '710601' . $tanggal_lahir_nik . $bulan_lahir . $tahun_lahir . $this->faker->numerify('####');

        // 



        return [
            'nama' => $this->faker->name,
            'nik' => $nik,
            'jenis_kelamin' => $jenis_kelamin,
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->dateTimeBetween('-85 years', '-0 years')->format('Y-m-d'),
            'tanggal_kematian' => $this->faker->optional(0.2)->date('d-m-Y H:i'),
            'alamat' => $this->faker->address,
            'status_keluarga' => $this->faker->randomElement([
                'Kepala Keluarga',
                'Istri',
                'Anak',
                'Orang Tua',
                'Mertua',
                'Cucu',
                'Menantu',
                'Paman',
                'Bibi',
                'Pembantu',
                'Keponakan',
                'Sepupu',
                'Lainnya'
            ]), // enum
            'pekerjaan' => $this->faker->jobTitle,
            'agama' => $this->faker->randomElement([
                'Islam',
                'Kristen',
                'Buddha',
                'Hindu',
                'Konghuchu',
                'Lainnya'
            ]), // enum
            'status_perkawinan' => $this->faker->randomElement([
                'Belum Kawin',
                'Kawin',
                'Cerai Hidup',
                'Cerai Mati'
            ]) // enum
        ];
    }
}
