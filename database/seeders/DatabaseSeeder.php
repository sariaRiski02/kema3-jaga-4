<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\KkSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UsahaSeeder;
use Database\Seeders\KendaraanSeeder;
use Database\Seeders\WcKamarMandiSeeder;
use Database\Seeders\PenggunaanAirSeeder;
use Database\Seeders\KepemelikanTanahSeeder;
use Database\Seeders\KepemilikanRumahSeeder;
use Database\Seeders\KepemilikanTernakSeeder;
use Database\Seeders\KepemilikanElektronikSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            KkSeeder::class,
            UsahaSeeder::class,
            KepemelikanTanahSeeder::class,
            KepemilikanTernakSeeder::class,
            KepemilikanElektronikSeeder::class,
            KepemilikanRumahSeeder::class,
            WcKamarMandiSeeder::class,
            PenggunaanAirSeeder::class,
            KendaraanSeeder::class,
            PenggunaanBahanBakarSeeder::class
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
