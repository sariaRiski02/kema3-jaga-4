<?php

namespace Database\Factories;

use App\Models\Resident;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Resident>
 */
class ResidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'nik' => $this->faker->unique()->numerify('################'),
            'place_of_birth' => $this->faker->city(),
            'date_of_birth' => $this->faker->dateTimeBetween('-90 years', 'now')->format('Y-m-d'),
            'date_of_death' => null,
            'address' => $this->faker->address(),
            'occupation' => $this->faker->randomElement(['pns', 'wiraswasta', 'petani', 'nelayan', 'pedagang', 'guru', 'dokter', 'perawat', 'polisi', 'tni', 'lainnya']),
            'religion' => $this->faker->randomElement(['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu']),
            'gender' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'marital_status' => $this->faker->randomElement(['belum kawin', 'kawin', 'cerai hidup', 'cerai mati']),
            'education' => $this->faker->randomElement(
                ['tidak sekolah', 'belum sekolah', 'sd/sederajat', 'smp/sederajat', 'sma/sederajat', 'sd', 'smp', 'sma', 'diploma', 'sarjana', 'magister', 'doktor', 'lainnya']
            ),
        ];
    }
}
