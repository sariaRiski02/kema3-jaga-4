<?php

namespace Database\Factories;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PenggunaanBahanBakar>
 */
class PenggunaanBahanBakarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'minyak_tanah' => $this->faker->boolean,
            'kayu_bakar' => $this->faker->boolean,
            'gas' => $this->faker->boolean,
            'solar' => $this->faker->boolean,
            'lainnya' => $this->faker->boolean,
            'warga_id' => Warga::inRandomOrder()->first()->id,
        ];
    }
}
