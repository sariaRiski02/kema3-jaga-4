<?php

namespace Database\Factories;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KepemilikanTernak>
 */
class KepemilikanTernakFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jenis_ternak' => $this->faker->randomElement([
                'sapi',
                'kambing',
                'domba',
                'ayam',
                'bebek',
                'kerbau',
                'kuda',
                'itik',
                'angsa',
                'kelinci',
                'lainnya'
            ]),
            'jumlah' => $this->faker->numerify('#'),
            'warga_id' => Warga::inRandomOrder()->first()->id,
        ];
    }
}
