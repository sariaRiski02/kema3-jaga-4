<?php

namespace Database\Seeders;

use App\Models\Family;
use App\Models\FamilyRelationship;
use App\Models\Resident;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamilyRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Family::query()->each(function (Family $family) {
            $resident = Resident::factory()->create();

            FamilyRelationship::create([
                'family_id' => $family->id,
                'resident_id' => $resident->id,
                'family_relationship' => 'kepala keluarga',
            ]);
        });
    }
}
