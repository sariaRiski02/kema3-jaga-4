<?php

namespace Database\Factories;

use App\Models\Usaha;
use App\Models\Warga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usaha>
 */
class UsahaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'warga_id' => Warga::inRandomOrder()->first()->id,
            'jenis' => $this->faker->randomElement([
                'Toko Kelontong',
                'Warung Makan',
                'Bengkel Motor',
                'Salon Kecantikan',
                'Laundry',
                'Fotokopi',
                'Kafe',
                'Apotek',
                'Percetakan',
                'Peternakan',
                'Pertanian',
                'Konter Pulsa',
                'Minimarket',
                'Jasa Pengiriman',
                'Rental Mobil',
                'Penyewaan Alat',
                'Kios Buah',
                'Kios Sayur',
                'Warnet',
                'Butik'
            ]),
            'jumlah' => $this->faker->numerify('#'),
        ];
    }
}
