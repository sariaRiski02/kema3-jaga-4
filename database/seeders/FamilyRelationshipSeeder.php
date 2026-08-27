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
        FamilyRelationship::factory(10)->create();
    }
}
