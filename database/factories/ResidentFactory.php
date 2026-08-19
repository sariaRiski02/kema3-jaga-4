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
            'date_of_birth' => $this->faker->date(),
            'date_of_death' => null,
            'address' => $this->faker->address(),
            'family_relationship' => $this->faker->randomElement([
                'kepala keluarga', 
                'suami',
                'istri',
                'anak',
                'orang tua',
                'keponakan',
                'saudara',
                'sepupu',
                'mertua',
                'menantu',
                'cucu',
                'saudara',
                'lainnya lain',
            ]),
            'occupation' => $this->faker->randomElement(['PNS', 'Wiraswasta', 'Petani', 'Nelayan', 'Pedagang', 'Guru', 'Dokter', 'Perawat', 'Polisi', 'TNI', 'Lainnya']),
            'religion' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'gender' => $this->faker->randomElement(['laki-laki', 'perempuan']),
            'marital_status' => $this->faker->randomElement(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']),
            'education' => $this->faker->randomElement(['Tidak Sekolah', 'Belum Sekolah', 'SD/sederajat', 'SMP/sederajat', 'SMA/sederajat', 'SD', 'SMP', 'SMA', 'Diploma', 'Sarjana', 'Magister', 'Doktor']),


            // Assuming you have a Family model and you want to associate residents with families
            // You can create a family first and then associate it with the resident
            // For example, you can use Family::factory()->create()->id to get a family ID
            // Here, we'll just set it to null for now
            // You can modify this as per your requirements
            // If you want to associate with an existing family, you can fetch a random family ID from the database
            // For example: Family::inRandomOrder()->first()->id
            // But for now, we'll keep it simple and set it to null
            // You can change this later based on your needs
            // If you want to create a new family for each resident, you can do that as well
            // Just make sure to handle the relationships properly in your application logic
        ];
    }
}
