<?php

namespace Database\Seeders;



// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Family;
use App\Models\Resident;
use Database\Seeders\FamilyRelationshipSeeder;
use Database\Seeders\FamilySeeder;
use Database\Seeders\ResidentSeeder;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            FamilySeeder::class,
            FamilyRelationshipSeeder::class,
            ResidentSeeder::class,
        ]);

    }
}
