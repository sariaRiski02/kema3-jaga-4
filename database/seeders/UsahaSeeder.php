<?php

namespace Database\Seeders;

use App\Models\Usaha;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usaha::factory()->count(20)->create();
    }
}
