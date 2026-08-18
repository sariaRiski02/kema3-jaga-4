<?php

namespace Database\Factories;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warga>
 */
class WargaFactory extends Factory
{
    protected $model = Warga::class;

    public function definition(): array
    {
        $jenisKelamin = $this->faker->randomElement([
            'laki-laki',
            'perempuan',
        ]);

        // Generate tanggal lahir SATU kali
        $tanggalLahir = $this->faker->dateTimeBetween(
            '-85 years',
            '-1 day'
        );

        // Format tanggal untuk NIK
        $hari = (int) $tanggalLahir->format('d');
        $bulan = $tanggalLahir->format('m');
        $tahun = $tanggalLahir->format('y');

        // Perempuan: tanggal lahir + 40
        if ($jenisKelamin === 'perempuan') {
            $hari += 40;
        }

        $nik = '710601'
            . str_pad($hari, 2, '0', STR_PAD_LEFT)
            . $bulan
            . $tahun
            . $this->faker->unique()->numerify('####');

        return [
            'nama' => $this->faker->name(),

            'nik' => $nik,

            'jenis_kelamin' => $jenisKelamin,

            'tempat_lahir' => $this->faker->city(),

            'tanggal_lahir' => $tanggalLahir->format('Y-m-d'),

            'tanggal_kematian' => null,

            'alamat' => $this->faker->address(),

            'status_keluarga' => 'lainnya',

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
                'lainnya',
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
                'lainnya',
            ]),

            'agama' => $this->faker->randomElement([
                'islam',
                'kristen',
                'katolik',
                'buddha',
                'hindu',
                'konghucu',
                'lainnya',
            ]),

            'status_perkawinan' => $this->faker->randomElement([
                'belum kawin',
                'kawin',
                'cerai hidup',
                'cerai mati',
            ]),
        ];
    }

    /**
     * Kepala keluarga.
     */
    public function kepalaKeluarga(): static
    {
        return $this->state(fn () => [
            'jenis_kelamin' => 'laki-laki',
            'status_keluarga' => 'kepala keluarga',
            'status_perkawinan' => 'kawin',
        ]);
    }

    /**
     * Istri.
     */
    public function istri(): static
    {
        return $this->state(fn () => [
            'jenis_kelamin' => 'perempuan',
            'status_keluarga' => 'istri',
            'status_perkawinan' => 'kawin',
        ]);
    }

    /**
     * Anak.
     */
    public function anak(): static
    {
        return $this->state(fn () => [
            'status_keluarga' => 'anak',
            'status_perkawinan' => 'belum kawin',
        ]);
    }

    /**
     * Bayi.
     */
    public function bayi(): static
    {
        $tanggalLahir = $this->faker->dateTimeBetween(
            '-1 year',
            'now'
        );

        return $this->state(fn () => [
            'tanggal_lahir' => $tanggalLahir->format('Y-m-d'),
            'status_keluarga' => 'anak',
            'status_perkawinan' => 'belum kawin',
            'pekerjaan' => null,
            'pendidikan' => null,
        ]);
    }
}