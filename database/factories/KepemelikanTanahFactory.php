<?php

namespace Database\Factories;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KepemelikanTanah>
 */
class KepemelikanTanahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jenis_tanah' => $this->faker->randomElement([
                'Tanah Kosong',
                'Tanah Sawah',
                'Tanah Kebun',
                'Tanah Perumahan',
                'Tanah Tambak',
            ]),
            'luas' => $this->faker->randomFloat,
            'warga_id' => Warga::inRandomOrder()->first()->id

        ];
    }
}
