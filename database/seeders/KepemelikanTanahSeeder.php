<?php

namespace Database\Seeders;

use App\Models\KepemelikanTanah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KepemelikanTanahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KepemelikanTanah::factory()->count(50)->create();
    }
}
