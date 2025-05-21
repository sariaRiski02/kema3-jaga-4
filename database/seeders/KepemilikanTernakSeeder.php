<?php

namespace Database\Seeders;

use App\Models\KepemilikanTernak;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KepemilikanTernakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KepemilikanTernak::factory()->count(50)->create();
    }
}
