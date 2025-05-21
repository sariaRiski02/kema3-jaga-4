<?php

namespace Database\Seeders;

use App\Models\KepemilikanRumah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KepemilikanRumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KepemilikanRumah::factory()->count(50)->create();
    }
}
