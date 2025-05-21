<?php

namespace Database\Factories;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PenggunaanAir>
 */
class PenggunaanAirFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sumur' => $this->faker->boolean,
            'mata_air' => $this->faker->boolean,
            'lainnya' => $this->faker->boolean,
            'warga_id' => Warga::inRandomOrder()->first()->id,

        ];
    }
}
