<?php

namespace Database\Seeders;

use App\Models\PenggunaanBahanBakar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenggunaanBahanBakarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PenggunaanBahanBakar::factory()->count(50)->create();
    }
}
