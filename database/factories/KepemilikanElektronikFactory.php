<?php

namespace Database\Factories;

use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KepemilikanElektronik>
 */
class KepemilikanElektronikFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jenis_elektronik' => $this->faker->randomElement([
                'Televisi',
                'Kulkas',
                'Mesin Cuci',
                'AC',
                'Kipas Angin',
                'Setrika',
                'Microwave',
                'Rice Cooker',
                'Dispenser',
                'Komputer',
                'Laptop',
                'Speaker',
                'Lampu',
                'Handphone',
                'Tablet',
                'lainnya'
            ]),
            'jumlah' => $this->faker->numerify('#'),
            'warga_id' => Warga::inRandomOrder()->first()->id,
        ];
    }
}
