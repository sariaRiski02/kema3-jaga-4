<?php

namespace Database\Factories;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KepemilikanRumah>
 */
class KepemilikanRumahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status_rumah' => $this->faker->randomElement([
                'Milik Sendiri',
                'Sewa/Kontrak',
                'Rumah Dinas',
                'Menumpang',
                'Lainnya'
            ]),
            'tipe_rumah' => $this->faker->randomElement([
                'Permanen',
                'Semi Permanen',
                'Non Permanen',
                'Lainnya'
            ]),
            'warga_id' => Warga::inRandomOrder()->first()->id,
        ];
    }
}
