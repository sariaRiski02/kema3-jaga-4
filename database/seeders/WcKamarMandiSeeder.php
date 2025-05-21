<?php

namespace Database\Seeders;

use App\Models\WcKamarMandi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WcKamarMandiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WcKamarMandi::factory()->count(50)->create();
    }
}
