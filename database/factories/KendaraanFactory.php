<?php

namespace Database\Factories;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kendaraan>
 */
class KendaraanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bus/truk' => $this->faker->numerify('#'),
            'roda_4' => $this->faker->numerify('#'),
            'roda_2' => $this->faker->numerify('#'),
            'lainnya' => $this->faker->numerify('#'),
            'warga_id' => Warga::inRandomOrder()->first()->id
        ];
    }
}
