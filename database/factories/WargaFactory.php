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
        $jenis_kelamin = $this->faker->randomElement(['laki-laki', 'perempuan']);
        $tanggal_lahir = (int) $this->faker->date('d');
        $bulan_lahir = $this->faker->date('m');
        $tahun_lahir = $this->faker->date('y');
        $tanggal_lahir_nik = $jenis_kelamin === 'perempuan' ? $tanggal_lahir += 40 : $tanggal_lahir;

        $nik = '710601' . $tanggal_lahir_nik . $bulan_lahir . $tahun_lahir . $this->faker->numerify('####');

        return [
            'nama' => $this->faker->name,
            'nik' => $nik,
            'jenis_kelamin' => $jenis_kelamin,
            'tempat_lahir' => $this->faker->city,
            'tanggal_lahir' => $this->faker->dateTimeBetween('-85 years', '-0 years')->format('Y-m-d'),
            'tanggal_kematian' => $this->faker->optional(0.2)->date('Y-m-d'),
            'alamat' => $this->faker->address,
            'status_keluarga' => $this->faker->randomElement([
                'kepala keluarga',
                'istri',
                'anak',
                'orang tua',
                'mertua',
                'cucu',
                'menantu',
                'paman',
                'bibi',
                'pembantu',
                'lainnya'
            ]),
            'pekerjaan' => $this->faker->randomElement([
                'petani',
                'nelayan',
                'pedagang',
                'guru',
                'pegawai negeri',
                'karyawan swasta',
                'wiraswasta',
                'buruh',
                'pelajar',
                'mahasiswa',
                'ibu rumah tangga',
                'pensiunan',
                'tni',
                'polri',
                'dokter',
                'perawat',
                'sopir',
                'montir',
                'seniman',
                'pengangguran',
                'lainnya'
            ]),
            'pendidikan' => $this->faker->randomElement([
                'tidak sekolah',
                'paud',
                'tk',
                'sd/sederajat',
                'smp/sederajat',
                'sma/sederajat',
                'diploma',
                'sarjana',
                'pascasarjana',
                'lainnya'
            ]),
            'agama' => $this->faker->randomElement([
                'islam',
                'kristen',
                'katolik',
                'buddha',
                'hindu',
                'konghucu',
                'lainnya'
            ]),
            'status_perkawinan' => $this->faker->randomElement([
                'belum kawin',
                'kawin',
                'cerai hidup',
                'cerai mati'
            ]),
        ];
    }
}
