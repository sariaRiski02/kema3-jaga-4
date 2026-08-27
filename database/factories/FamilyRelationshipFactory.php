<?php

namespace Database\Factories;

use App\Models\Family;
use App\Models\FamilyRelationship;
use App\Models\Resident;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FamilyRelationship>
 */
class FamilyRelationshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $family = Family::factory()->create();
        $resident = Resident::factory()->create();

        return [
            'family_id' => $family->id,
            'resident_id' => $resident->id,
            'family_relationship' => 'kepala keluarga'
        ];
    }
}
