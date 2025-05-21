<?php

namespace Database\Seeders;

use App\Models\KepemilikanElektronik;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KepemilikanElektronikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KepemilikanElektronik::factory()->count(50)->create();
    }
}
