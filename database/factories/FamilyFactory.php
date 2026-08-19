<?php

namespace Database\Factories;

use App\Models\Family;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Family>
 */
class FamilyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'family_number' => $this->faker->unique()->numerify('FAM-#####'),
            'head_of_family' => null, // You can set this to a valid resident ID if needed
        ];
    }
}
