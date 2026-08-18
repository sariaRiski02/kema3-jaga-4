<?php

namespace Database\Seeders;

use App\Models\Kk;
use App\Models\Warga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $kk = Kk::factory()->create();

        $kepala = Warga::factory()
            ->kepalaKeluarga()
            ->create([
                'kk_id' => $kk->id,
            ]);

        $kk->update([
            'kepala_keluarga_id' => $kepala->id,
        ]);
    }
}
