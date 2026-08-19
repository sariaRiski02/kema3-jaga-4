<?php

namespace Database\Seeders;



// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Family;
use App\Models\Resident;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Family::factory(10)->create()->each(function ($family) {
            $headOfFamily = Resident::factory()->create([
                'family_id' => $family->id,
                'family_relationship' => 'kepala keluarga',
            ]);
            $family->head_of_family = $headOfFamily->id;
            $family->save();

            // Create additional residents for the family
            Resident::factory(rand(1, 5))->create([
                'family_id' => $family->id,
                'family_relationship' => function () {
                    return $this->faker->randomElement([
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
                    ]);
                },
            ]);
        });

    }
}
