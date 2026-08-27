<?php

namespace Database\Seeders;

use App\Models\Family;
use App\Models\FamilyRelationship;
use App\Models\Resident;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $relationships = [
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
            ];
        foreach(Family::all() as $family){

            for($i=0; $i<rand(1,6); $i++){
                $resident = Resident::factory()->create([]);
                FamilyRelationship::factory()->create([
                   'family_id' => $family->id,
                   'resident_id' => $resident->id,
                   'family_relationship' => fake()->randomElement($relationships) 
                ]);
            }
        }
        

    }
}
