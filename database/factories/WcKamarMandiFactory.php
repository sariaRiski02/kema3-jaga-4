<?php

namespace Database\Factories;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WcKamarMandi>
 */
class WcKamarMandiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ikut_lpm' => $this->faker->boolean,
            'warga_id' => Warga::inRandomOrder()->first()->id,
        ];
    }
}
