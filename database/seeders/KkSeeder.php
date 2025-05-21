<?php

namespace Database\Seeders;

use App\Models\Kk;
use App\Models\Warga;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kk::factory()->count(50)->create()->each(function ($kk) {
            Warga::factory()->create([
                'kk_id' => $kk->id,
                'status_keluarga' => 'Kepala Keluarga',
            ]);

            Warga::factory()->count(rand(2, 5))->create([
                'kk_id' => $kk->id,
            ]);
        });
    }
}
