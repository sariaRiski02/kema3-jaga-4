<?php

namespace Database\Seeders;

use App\Models\PenggunaanAir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenggunaanAirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PenggunaanAir::factory()->count(50)->create();
    }
}
